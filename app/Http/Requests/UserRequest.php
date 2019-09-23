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
        $rules = [
            'role_id' => 'required',
            'name' => 'required',
            'lastName' => 'required',
            'dateBirth' => 'required',
            'phone' => 'required',
            'password' => 'required|min:6|confirmed'
        ];

        if ($this->request->has("this_update"))
        {
            $rules["email"] = 'required|email|unique:users,email,'.$this->request->all()["id"];
            $rules["password"] = 'nullable|min:6|confirmed';
        }
        else
        {
            $rules["email"] = 'required|email|unique:users';
            $rules["password"] = 'required|min:6|confirmed';
        }


        return $rules;
    }

    public function messages()
    {
        return [
            'role_id.required' => 'el campo rol es obligatorio',
            'name.required' => 'el campo nombre es obligatorio',
            'lastName.required' => 'el campo apellido es obligatorio',
            'dateBirth.required' => 'el campo fecha de nacimiento es obligatorio',
            'phone.required' => 'el campo telefono es obligatorio',
            'email.required' => 'el campo correo es obligatorio',
            'email.unique' => 'El correo ya se encuentra registrado',
            'password.required' => 'el campo contraseña es obligatorio',
            'password.min' => 'La contraseñadebe tener minimo 6 caracteres',
            'confirmed' => 'Las contraseñas no coinciden',
        ];
    }
}
