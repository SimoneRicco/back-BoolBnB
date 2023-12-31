<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    
    public function rules(): array
    {
        return [
            'name' => ['string', 'max:255'],
            'lastname'  => ['string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'birth_date'  => ['date'],
            'image'    => ['nullable', 'image', 'max:10240'],
        ];
    }
}

