<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\HalfSize;

/**
 * ServiceProviderRegisterRequest
 * 
 */
class ServiceProviderRegisterRequest extends FormRequest
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
            'providerId' => ['required', 'string', 'max:'.\Length::SERVICE_PROVIDER_PROVIDER_ID, new HalfSize(), 'unique:service_providers,provider_id'],
            'name' => ['required', 'string', 'max:'.\Length::SERVICE_PROVIDER_NAME],
            'useStartDateTime' => ['required', 'date'],
            'useEndDateTime' => ['nullable', 'date', 'after:useStartDateTime'],
        ];
    }
    
    /**
     * attributes
     * 
     * @return array 
     */
    public function attributes()
    {
        return [
            'name' => '提供者名',
        ];
    }
}