<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // You can put your authorization logic here
        // For now, we'll allow all authenticated users to create notifications
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'type' => ['required', 'in:marketing,invoices,system'],
            'short_text' => ['required', 'string', 'max:255'],
            'expiration' => ['nullable', 'numeric', 'min:1'],
            'read' => ['boolean'],
            'users' => ['nullable', 'array'],
            'users.*' => ['exists:users,id'], // Validate each selected user ID
        ];
    }
}
