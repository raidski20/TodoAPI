<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskRequest extends FormRequest
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
    public function rules()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => [
                'required',
                Rule::in(['in_progress', 'finished'])
            ]
        ];

        if($this->isMethod('post') && $this->route()->getName() === 'task.store') 
            $rules = $rules + $this->store();

        return $rules;
    }


    private function store(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
        ];
    }
}
