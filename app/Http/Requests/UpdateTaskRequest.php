<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTaskRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'sometimes|string|min:3|max:255',
            'description' => 'sometimes|nullable|string|max:1000',
            'is_completed' => 'sometimes|boolean',
        ];
    }

    /**
     * Get custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'title.string' => 'عنوان المهمة يجب أن يكون نصًا.',
            'title.min' => 'عنوان المهمة يجب أن يحتوي على 3 أحرف على الأقل.',
            'title.max' => 'عنوان المهمة يجب ألا يتجاوز 255 حرفًا.',
            'description.string' => 'وصف المهمة يجب أن يكون نصًا.',
            'description.max' => 'وصف المهمة يجب ألا يتجاوز 1000 حرف.',
            'is_completed.boolean' => 'حالة المهمة يجب أن تكون صحيحة أو خاطئة (true/false).',
        ];
    }

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'خطأ في التحقق من البيانات',
            'errors' => $validator->errors(),
        ], 422));
    }
}
