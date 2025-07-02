<?php

namespace App\Http\Requests\Course;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
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
            'name'=>'required',
            'photo'=>'nullable|mimes:png,jpg,jpeg,webp',
            'price'=>'required|numeric|min:0',
        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'Vui lòng điền tên khóa học',
            'price.required'=>'Vui lòng nhập giá khóa học',
            'price.min'=>'Giá khóa học không được âm',
            'price.numeric' => 'Giá khóa học phải là một số',
        ];
    }
}
