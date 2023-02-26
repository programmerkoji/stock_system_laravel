<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'email' => ['required', Rule::unique('users')->ignore($this->user)],
            'password' => ['required', 'min:4']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '名前の入力は必須です。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => 'メールアドレスの形式で登録してください。',
            'email.unique' => 'メールアドレスはすでに登録されています。',
            'password.min' => '4文字以上で登録してください。',
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
