<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'province' => 'required',
            'district' => 'required',
            'ward' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập Họ Tên',
            'phone.required' => 'Bạn chưa nhập Số điện thoại',
            'email.required' => 'Bạn chưa nhập Email',
            'province.required' => 'Bạn chưa chọn Tỉnh/Thành Phố',
            'district.required' => 'Bạn chưa chọn Quận/Huyện',
            'ward.required' => 'Bạn chưa chọn Phường/Xã'
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
