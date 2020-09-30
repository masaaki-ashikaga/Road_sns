<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
            'name' => 'required|max:50',
            'text' => 'required|max:50',
            'brand_image' => 'image',
        ];
    }

    public function messages()
    {
        return[
            'name.required' => 'ブランド名を入力してください',
            'name.max' => '50文字以内で入力してください',
            'text.required' => 'ブランド紹介を入力してください',
            'text.max' => '50文字以内で入力してください',
            'brand_image.image' => '画像を選択してください',
        ];
    }
}
