<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\LineNoticeSttings;

/**
 * LineUserSettingRequest
 * 
 */
class LineUserSettingRequest extends FormRequest
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
            'userId' => ['required', 'integer'],
            'noticeSetting' => ['required', 'boolean'],
            'lineNoticeSttings' => ['nullable', 'array', new LineNoticeSttings(\ArrayFacade::getArrayValue($input, 'noticeSetting'))]
        ];
    }
}