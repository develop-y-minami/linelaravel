<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * ServiceProviderUpdateRequest
 * 
 */
class ServiceProviderUpdateRequest extends FormRequest
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
        $id = \ArrayFacade::getArrayValue($input, 'id');

        return [
            'providerId' => ['required', 'string', 'max:'.\Length::SERVICE_PROVIDER_PROVIDER_ID, 'unique:service_providers,provider_id,'.$id.',id'],
            'name' => ['required', 'string', 'max:'.\Length::SERVICE_PROVIDER_NAME],
            'useStartDateTime' => ['required', 'date'],
            'useEndDateTime' => ['nullable', 'date', 'after:useStartDateTime'],
            'useStop' => ['nullable', 'bool'],
        ];
    }

    /**
     * エラーメッセージを取得
     *
     * @return array
     */
    public function messages()
    {
        return [
            'providerId.required' => '提供者IDを入力してください',
            'providerId.unique' => '既に存在する提供者IDです',
            'name.required' => '提供者名を入力してください',
            'useStartDateTime.required' => '利用開始日を入力してください',
            'useEndDateTime.after' => '利用終了日には利用開始日より後の日付を入力してください',
        ];
    }
}