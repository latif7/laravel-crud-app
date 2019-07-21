<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        $method = $this->getMethod();

        if ($method == "POST") {
            $rules = [
                'name' => 'required|max:50',
                'email' => 'required|email|unique:users,email|max:50',
                'role' => 'required',
                'password' => 'required|min:8|max:50|confirmed',
                'password_confirmation' => 'required|min:8|max:50',
            ];
        } elseif ($method == "PUT") {
            $rules = [
                'name' => 'required|max:50',
                'email' => ['required','email','max:50', Rule::unique('users')->ignore($this->segment(2))],
                'role' => 'required',
            ];

            if ($this->request->filled('password')) {
                $rules['password'] = 'required|min:8|max:50|confirmed';
                $rules['password_confirmation'] = 'required|min:8|max:50';
            }
        }

        return $rules;
    }
}
