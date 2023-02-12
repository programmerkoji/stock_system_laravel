<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', Rule::unique('products')->ignore($this->id)],
            'price' => ['required'],
            'number' => ['required', Rule::unique('products')->ignore($this->id)],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'カテゴリ名は必須です。',
            'name.unique' => '同じカテゴリ名は登録できません。',
            'price.unique' => '金額は必須です。',
            'number.required' => '製品番号は必須です。',
            'number.unique' => '同じ製品番号は登録できません。',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json([
                'errors' => $validator->errors(),
            ],
            400);
        throw new HttpResponseException($res);
    }
}
