<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PartnerRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company' => ['required'],
            'work_field' => ['string'],
            'company_size' => ['integer'],
            'phone' => ['required','string'],
            'email' => ['required', 'email'],
            'address' => ['required','string']
        ];
    }
}
