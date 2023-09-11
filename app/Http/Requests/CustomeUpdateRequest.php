<?php

namespace App\Http\Requests;

use App\Rules\MobilePhoneRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

class CustomeUpdateRequest extends FormRequest
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
            'firstname' => 'sometimes|max:255',
            'lastname' => 'sometimes|max:255',
            'date_of_birth' => [
                'sometimes',
                'date',
                Rule::unique('customers')
                    ->where(function ($query) {
                        return $query
                            ->where('firstname', $this->input('firstname'))
                            ->where('lastname', $this->input('lastname'));
                    })
                    ->ignore($this->route('customer')),
            ],
            'phone_number' => ['sometimes', new MobilePhoneRule],
            'email' => 'sometimes|email|unique:customers,email,' . $this->route('customer'),
            'bank_account_number' => 'sometimes',
        ];
    }
}
