<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServicesRequest extends FormRequest
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
     * @return array
     */
    public function rules()
{
    return [
        "id" => "bail|required_if:action,update,enable,disable|nullable|exists:services,id",
        "action" => "bail|required|in:insert,update,enable,disable",
        "heading_top" => "bail|required|string|max:500",  // Usually service name is required
        "heading_middle" => "bail|nullable|string",
        "heading_bottom" => "bail|nullable|string|max:500",
        "banner_image" => "bail|file|image|required_if:action,insert",
        "gallery_images.*" => "bail|file|image|nullable",
        "slide_status" => "required_if:action,insert,update|in:live,disabled",
        "slide_sorting" => "required_if:action,insert,update|numeric|gt:0",
    ];
}

}
