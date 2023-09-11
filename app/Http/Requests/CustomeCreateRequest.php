<?php

namespace App\Http\Requests;

use App\Rules\IntegerStringRule;
use App\Rules\MobilePhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CustomeCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'firstname'=>'required|max:255',
            'lastname'=>'required|max:255',
            'date_of_birth' => [
                'required',
                'date',
                Rule::unique('customers')->where(function ($query) {
                    return $query
                        ->where('firstname', $this->input('firstname'))
                        ->where('lastname', $this->input('lastname'));
                }),
            ],
            'phone_number'=>['required', new MobilePhoneRule],
            'email'=>'required|email|unique:customers',
            'bank_account_number'=>'required'
//            'bank_account_number'=>[
//                'required',
//                new IntegerStringRule,
//                'max_digits:24',
//                'min_digits:24'
//            ]
        ];
    }
}
