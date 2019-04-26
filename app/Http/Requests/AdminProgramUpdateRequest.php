<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminProgramUpdateRequest extends FormRequest {

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
            'title' => ['required', 'max:150', Rule::unique('programs')->ignore($program_id, 'id')],
            'slug' => ['required', Rule::unique('programs')->ignore($program_id, 'id')],
            'title_alt' => 'max:150',
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
