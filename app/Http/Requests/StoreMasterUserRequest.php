<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class StoreMasterUserRequest extends FormRequest
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
            'nama' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'username' => 'required|string|unique:users',
            'password' => 'required|string',
            'idProyek' => 'nullable|string',
            'idKaryawan' => 'nullable|string|unique:users',
            'role' => 'nullable|string',
            'idDepartment' => 'nullable|string',
            'statusUser' => 'required',
        ];
    }
}
