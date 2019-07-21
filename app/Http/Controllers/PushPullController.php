<?php

namespace App\Http\Controllers;

use App\Models\PullLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use lib\DB;

class PushPullController extends Controller
{
    private $whiteListIp = [
        "127.0.0.1",
        "127.0.1.0"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        dd('sdfa');
            try {

                $validator = Validator::make($request->all(), [
                    "msisdn" => "required",
                    "sms" => "required"
                ]);

                if (!$validator->fails()) {

                    $smsParts = $this->getSmsParts($request->input('sms'));

                    $pullLog = new PullLog();
                    $pullLog->c_phone = $request->input('msisdn');
                    $pullLog->account_number = isset($smsParts[1]) ? $smsParts[1] : '';
                    $pullLog->name = isset($smsParts[2]) ? $smsParts[2] : '';
                    $pullLog->r_phone = isset($smsParts[3]) ? $smsParts[3] : '';
                    $pullLog->product = isset($smsParts[4]) ? $smsParts[4] : '';

                    $isValidReferredPhone = $this->checkBnMobile($pullLog->r_phone);
                    $status = ($isValidReferredPhone && (count($smsParts) >= 5) && (strtolower($smsParts[0]) == "refr") && strlen($pullLog->account_number) <= 16);
                    $pullLog->request_data = json_encode($request->all());

                    if ($status) {
                        $response = "Thanks from Standard Chartared Bank.";
                    } elseif (!$isValidReferredPhone) {
                        $response = "Invalid mobile number.";
                    } elseif(strlen($pullLog->account_number) > 16) {
                        $response = "Invalid account number.";
                    } elseif(count($smsParts) < 5 || strtolower($smsParts[0]) != "refr") {
                        $response = "Invalid request pattern.";
                    }

                    $pullLog->status = $status;
                    $pullLog->response = $response;
                    $pullLog->save();

                    echo $response;

                } else {
                    Log::info("Validation Error: ". json_encode($request->all()));
                }

            } catch (\Exception $exception) {
                Log::error("Pull Logs Processing Error: " . $exception->getMessage() . ", Request data :" . json_encode($request->all()));
            }
    }

    /**
     * @param $sms
     * @return array
     */
    private function getSmsParts($sms)
    {
        $smsParts = explode(' ', $sms);
        $smsParts = array_values(array_filter($smsParts));
        return $smsParts;
    }

    /**
     * @param $mobile
     * @return boolean
     */
    public function checkBnMobile($mobile)
    {
        return preg_match('/(^(\+88|0088|88)?(01){1}[3456789]{1}(\d){8})$/', $mobile);
    }


    /**
     * @param $sms
     * @return array
     */
    private function checkRequestIp($ip)
    {
        return in_array($ip, $this->whiteListIp);
    }
}
