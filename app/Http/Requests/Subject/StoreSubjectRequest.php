<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name'=>'required|unique:subjects'
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Vui lòng điền tên môn học',
            'name.unique'=>"Môn $this->name đã tồn tại!",
        ];
    }
}
