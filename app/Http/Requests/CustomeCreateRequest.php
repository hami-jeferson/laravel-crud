<?php

namespace App\Http\Requests;

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
            'first_name'=>'required|max:255',
            'last_name'=>'required|max:255',
            'date_of_birth' => [
                'required',
                'date',
                Rule::unique('customers')->where(function ($query) use ($request) {
                    return $query
                        ->where('first_name', $request->input('first_name'))
                        ->where('last_name', $request->input('last_name'));
                }),
            ],
            'phone_number'=>['required', new MobilePhoneRule],
            'email'=>'required|email|unique:customers',
            'bank_account_number'=>'required'
        ];
    }
}
