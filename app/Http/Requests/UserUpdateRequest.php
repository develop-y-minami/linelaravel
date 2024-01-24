<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use App\Rules\HalfSize;

/**
 * UserUpdateRequest
 * 
 * 担当者情報更新リクエスト
 * 
 */
class UserUpdateRequest extends FormRequest
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
        $userTypeId = \ArrayFacade::getArrayValue($input, 'userTypeId');
        $serviceProviderId = \ArrayFacade::getArrayValue($input, 'serviceProviderId');

        // アカウントIDの重複判定ルールを設定
        $accountIdUniqueRule;
        if (\AppFacade::isOperator($userTypeId))
        {
            $accountIdUniqueRule = Rule::unique('users', 'account_id', 'id')->ignore($id)->whereNull('service_provider_id');
        }
        else
        {
            $accountIdUniqueRule = Rule::unique('users', 'account_id', 'id')->ignore($id)->where('service_provider_id', $serviceProviderId);
        }

        return [
            'userTypeId' => ['required', 'integer'],
            'serviceProviderId' => ['required_if:userTypeId,'.\UserType::SERVICE_PROVIDER, 'nullable', 'integer'],
            'userAccountTypeId' => ['required', 'integer'],
            'accountId' => ['required', 'string', 'max:'.\Length::USER_ACCOUNT_ID, new HalfSize(), $accountIdUniqueRule],
            'name' => ['required', 'string', 'max:'.\Length::USER_NAME],
            'email' => ['nullable', 'string', 'email', 'max:'.\Length::USER_EMAIL],
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
            'name' => '担当者名',
        ];
    }

    /**
     * messages
     * 
     * @return array 
     */
    public function messages()
    {
        return [
            'serviceProviderId.required_if' => 'サービス提供者を選択してください',
        ];
    }
}