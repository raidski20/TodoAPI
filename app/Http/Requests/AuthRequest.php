<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthRequest extends FormRequest
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
        $rules = [];

        if($this->isMethod('post') && $this->route()->getName() === 'register') 
            $rules = $this->register();
        elseif($this->isMethod('post') && $this->route()->getName() === 'login') 
            $rules = $this->login();

        return $rules;
    }

    private function register(): array
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed'
        ];
    }

    private function login(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string'
        ];
    }
}
