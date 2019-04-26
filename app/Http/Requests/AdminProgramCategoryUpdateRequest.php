<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminProgramCategoryUpdateRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        extract($_REQUEST);
        return [
            'title' => ['required', 'max:150', Rule::unique('program_categories')->ignore($category_id, 'id')],
            'slug' => ['required', Rule::unique('program_categories')->ignore($category_id, 'id')],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages() {
        return [
            'slug.unique' => 'Meta URL must be unique.',
        ];
    }

}
