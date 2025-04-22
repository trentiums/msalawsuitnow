<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Http;
use Closure;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [

            'first_name' => [
                'required',
                'string'
            ],
            'last_name' => [
                'required',
                'string'
            ],

            'bot' => [
                'required',
                'string',
                'in:bot'
            ],
            'bot_capture' => [
                'nullable',
            ],
            'phone' => [
                'required',
                'numeric',
                'digits:10'
            ],
            'email' => [
                'required',
                'email'
            ],
            'accept_terms' => [
                'required',
                'string',
                'in:Yes,No'
            ],
            'xxTrustedFormCertUrl' => [
                'required'
            ],
            'xxTrustedFormToken' => [
                'required'
            ],
            'xxTrustedFormPingUrl' => [
                'required'
            ],
            'g-recaptcha-response' => [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $response = Http::withOptions([
                        'verify' => false // Disable SSL certificate verification
                    ])->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret' => config('settings.captcha_secret_key'),
                        'response' => $value,
                    ]);
                }
            ],
        ];
    }
}
