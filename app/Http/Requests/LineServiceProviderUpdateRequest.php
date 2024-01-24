<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * LineServiceProviderUpdateRequest
 * 
 * LINEサービス提供者情報更新リクエスト
 * 
 */
class LineServiceProviderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // リクエストデータ取得
        $input = $this->all();

        return [
            'ids' => ['required', 'array'],
            'ids.*' => ['integer'],
            'serviceProviderId' => ['nullable', 'integer'],
        ];
    }
}