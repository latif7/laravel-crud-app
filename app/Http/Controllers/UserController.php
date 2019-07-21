<?php

namespace App\Http\Controllers;

use App\Enum\RolesEnum;
use App\Http\Requests\UserRequest;
use App\Mail\SendUserLoginDetails;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    private $model;
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = RolesEnum::getValues();
        $data['users'] = $this->model->with('createdBy', 'updatedBy')->paginate(25);
        return view('users.index', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {

        try {

            $this->model->name = $request->input('name');
            $this->model->email = $request->input('email');
            $this->model->role = $request->input('role');
            $this->model->password = bcrypt($request->input('password'));
            $this->model->status = ($request->status == 'on') ? 'Active':'Inactive';
            $this->model->created_by = auth()->user()->id;
            $status = $this->model->save();

            if ($status) {
                //send mail
                try {
                    Mail::to($this->model->email)->bcc('abc@example.com')->send(new SendUserLoginDetails($this->model));
                } catch (\Exception $e) {
                    Log::error('Mail sending Error:'. $e->getMessage());
                }
                session()->flash('successMessage',"User created successfully!");
            } else {
                session()->flash('errorMessage',"Saved Failed. Something went wrong!");
            }

        } catch (\Exception $exception) {
            session()->flash('errorMessage',"Saved Failed. Something went wrong!");
            Log::error('User Create Error:'. $exception->getMessage());
        }

        return redirect()->back();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data['roles'] = RolesEnum::getValues();
            $data['user'] = $this->model->findOrFail($id);
        } catch (\Exception $exception) {
            abort(404);
        }
        return view('users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        try {
            $user = $this->model->findOrFail($id);

            if ($user->id == auth()->user()->id) {
                session()->flash('errorMessage',"Sorry, You cannot update your information by yourself.");
            } else {

                $user->name = $request->input('name');
                $user->email = $request->input('email');
                $user->role = $request->input('role');

                if($request->filled('password')){
                    $user->password = bcrypt(trim($request->password));
                }

                $user->status = ($request->status=='on') ? 'Active':'Inactive';
                $user->updated_by = auth()->user()->id;
                $status = $user->save();

                if ($status) {
                    session()->flash('successMessage',"User Updated successfully!");
                } else {
                    session()->flash('errorMessage',"Saved Failed. Something went wrong!");
                }
            }
            
        } catch (\Exception $exception) {
            session()->flash('errorMessage',"Saved Failed. Something went wrong!");
            Log::error('User Update Error:'. $exception->getMessage());
        }
        return redirect()->back();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function changePassword()
    {
        return view('users.change_password');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updatePassword(Request $request)
    {

        try {

            $validator = Validator::make($request->all(), [
                'old_password' => 'required|min:8',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8'
            ]);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!Hash::check($request->old_password, auth()->user()->password)) {
                session()->flash('errorMessage', "Old password does not match!");
            } else {
                
                $status = $this->model->where('id', auth()->user()->id)->update(['password' => bcrypt($request->password)]);

                if ($status) {
                    session()->flash('successMessage',"Password Changed Successfully!");
                } else {
                    session()->flash('errorMessage',"Failed. Something went wrong!");
                }
            }

        } catch (\Exception $exception) {
            session()->flash('errorMessage',"Saved Failed. Something went wrong!");
            Log::error('User Password Change Error:'. $exception->getMessage());
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
