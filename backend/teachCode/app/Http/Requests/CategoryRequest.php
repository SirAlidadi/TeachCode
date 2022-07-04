<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = isset($this->category) ? ',' . $this->category->id : '';
        return [
            'name' => ['required'],
            'slug' => ['required', 'alpha_dash', 'unique:categories,slug' . $id]
        ];
    }
}
