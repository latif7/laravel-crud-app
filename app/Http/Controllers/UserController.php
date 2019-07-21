<?php

namespace App\Http\Controllers;

use App\Enum\RolesEnum;
use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = RolesEnum::getValues();
        $data['users'] = User::with('createdBy', 'updatedBy')->paginate(25);
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
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->role = $request->input('role');
            $user->password = bcrypt($request->input('password'));
            $user->status = ($request->status == 'on') ? 'Active':'Inactive';
            $user->created_by = auth()->user()->id;
            $status = $user->save();

            if ($status) {
                session()->flash('success',true);
                session()->flash('message',"User created successfully!");
            } else {
                session()->flash('success',false);
                session()->flash('message',"Saved Failed. Something went wrong!");
            }

        } catch (\Exception $exception) {
            dd($exception->getMessage());
            session()->flash('success',false);
            session()->flash('message',"Saved Failed. Something went wrong!");
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
            $data['user'] = User::findOrFail($id);
        } catch (\Exception $exception) {
            abort(404);
        }
        return view('users.edit_user', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $rules = [
                'name' => 'required|max:50',
                'email'=>['required','max:50', Rule::unique('users')->ignore($id)],
            ];

            if ($request->filled('password')) {
                $rules['password'] = 'required|min:8|max:50|confirmed';
                $rules['password_confirmation'] = 'required|min:8|max:50';
            }

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {

                $user = User::findOrFail($id);

                if ($user->id == auth()->user()->id) {
                    session()->flash('success',false);
                    session()->flash('message',"Sorry, You cannot update your information by yourself.");
                    return redirect()->back();
                }

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
                    session()->flash('success',true);
                    session()->flash('message',"User Updated successfully!");
                } else {
                    session()->flash('success',false);
                    session()->flash('message',"Saved Failed. Something went wrong!");
                }
            }

        } catch (\Exception $exception) {
            session()->flash('success',false);
            session()->flash('message',"Saved Failed. Something went wrong!");
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
                session()->flash('success', false);
                session()->flash('message', "Old password does not match!");
                return redirect()->back();
            }

            $status = User::where('id', auth()->user()->id)->update(['password' => bcrypt($request->password)]);

            if ($status) {
                session()->flash('success',true);
                session()->flash('message',"Password Changed Successfully!");
            } else {
                session()->flash('success',false);
                session()->flash('message',"Failed. Something went wrong!");
            }

        } catch (\Exception $exception) {
            session()->flash('success',false);
            session()->flash('message',"Saved Failed. Something went wrong!");
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
