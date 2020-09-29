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
        return [
            'account_name' => 'required|max:50',
            'name' => 'required|max:50',
            'text' => 'max:100',
        ];
    }

    public function messages()
    {
        return[
            'account_name.required' => 'アカウント名を入力してください',
            'account_name.max' => '50文字以内で入力してください',
            'name.required' => '名前を入力してください。',
            'name.max' => '50文字以内で入力してください',
            'text.max' => '自己紹介は100文字以内で入力してください',
        ];
    }
}
