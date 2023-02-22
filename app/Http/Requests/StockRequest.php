<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StockRequest extends FormRequest
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
            'condition' => 'required',
            // 'serial_number' => 'unique:stocks,serial_number,' . . ',id',
                'serial_number' => [Rule::unique('stocks')->ignore($this->id)],
        ];
    }

    public function messages()
    {
        return [
            'condition.required' => '状態の入力は必須です。',
            'serial_number.unique' => '同じシリアルナンバーは登録できません。',
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
