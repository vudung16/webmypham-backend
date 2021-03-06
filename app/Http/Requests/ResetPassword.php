<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ResetPassword extends FormRequest
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
        return [
                'password'=>'required||min:8|max:32',
                'retype' => 'required|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.max' => 'Mật khẩu phải có ít hơn 32 kí tự',
            'password.min' => 'Mật khẩu phải có nhiều hơn 8 kí tự',
            'retype.same' => 'Mật khẩu nhập lại chưa khớp'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'message' => $error,
            'status' => false,
        ], 200));
    }
}
