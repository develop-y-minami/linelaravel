<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

/**
 * UserRegisterRequest
 * 
 */
class UserRegisterRequest extends FormRequest
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
        $serviceProviderId = \ArrayFacade::getArrayValue($input, 'serviceProviderId');

        return [
            'serviceProviderId' => ['required', 'string', 'max:'.\Length::SERVICE_PROVIDER_PROVIDER_ID],
            'accountId' => ['required', 'string', 'max:'.\Length::USER_ACCOUNT_ID, Rule::unique('users', 'account_id')->where('service_provider_id', $serviceProviderId)],
            'name' => ['required', 'string', 'max:'.\Length::USER_NAME],
            'email' => ['required', 'string', 'email', 'max:'.\Length::USER_EMAIL],
            'password' => ['required', 'max:'.\Length::USER_PASSWORD, Password::min(8), 'confirmed'],
            'password_confirmation' => ['required'],
        ];
    }
}