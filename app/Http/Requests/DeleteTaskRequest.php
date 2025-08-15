<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Models\Task;

class DeleteTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // سنضيف Auth لاحقًا
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'integer',
                'exists:tasks,id', // التحقق من أن id موجود في جدول tasks
            ],
        ];
    }

    /**
     * Get custom error messages for validation.
     */
    public function messages(): array
    {
        return [
            'id.required' => 'معرف المهمة مطلوب.',
            'id.integer' => 'معرف المهمة يجب أن يكون رقمًا صحيحًا.',
            'id.exists' => 'المهمة غير موجودة.',
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

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('id'), // استخراج id من المسار
        ]);
    }
}
