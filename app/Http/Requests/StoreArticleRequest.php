<?php

namespace App\Http\Requests;

use App\Rules\GetUniqueTitlePerAuthor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreArticleRequest extends FormRequest
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
            'title' => ['required', 'min:5', new GetUniqueTitlePerAuthor(Request::user()->id)],
            'content' => ['required'],
            'metadata' => ['required', 'array'],
            'status' => 'required|in:draft,published'
        ];
    }
}
