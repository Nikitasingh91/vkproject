<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VerticalRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "id" => "nullable|exists:verticals,id",
            "action" => "required|in:insert,update,enable,disable",

            "vertical_name" => "required",
            "vertical_image" => "nullable|image",

            // DIFFERENTIATORS SHOULD BE NULLABLE (optional)
            "differentiators" => "nullable|array",
            "differentiators.*" => "nullable|string"
        ];
    }
}