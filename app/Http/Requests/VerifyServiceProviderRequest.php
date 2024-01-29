<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

/**
 * VerifyServiceProviderRequest
 * 
 * サービス提供者情報.提供者ID確認リクエスト
 * 
 */
class VerifyServiceProviderRequest extends FormRequest
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
            'providerId' => [
                'required',
                'string',
                Rule::exists('service_providers', 'provider_id')->where(function($query)
                {
                    // 現在日付を取得
                    $today = Carbon::today()->toDateString();

                    // サービス利用期間内であるか確認
                    $query->where('use_start_date', '<=', $today);
                    $query->where(function($query) use ($today)
                    {
                        $query->where('use_end_date', '>=', $today);
                        $query->orWhereNull('use_end_date');
                    });
                    $query->whereUseStopFlg(\ServiceProviderUseStopFlg::USE['value']);
                })
            ],
        ];
    }
}