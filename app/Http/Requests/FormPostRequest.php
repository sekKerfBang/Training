<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class FormPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => ['required', 'min:8'],
            "slug" => ["required","regex:/^[0-9a-z\-]+$/", Rule::unique("posts", "slug")->ignore($this->route("post"))],
            "content" => ["required", 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags' => ['array', 'exists:tags,id', 'required' ],
            'image'=> ['image','max:2000'],
        ];
    }

    protected function prepareForValidation() {
        $this ->merge([
            "slug" => $this->input('slug') ?: \Str::slug($this->input('title')),]);
    }
}
