<?php

namespace App\Request\Auth;

use App\Model\User;
use Hyperf\Validation\Request\FormRequest;

class SignInRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => ['email','required'],
            'password' => ['string', 'required'],
        ];
    }

    public function getUser(): ?User
    {
        return User::findByEmail($this->input('email'));
    }
}
