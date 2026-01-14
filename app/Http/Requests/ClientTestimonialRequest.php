<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ClientTestimonialRequest extends FormRequest
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
        $id = $this->input('id');   
        return [
            'id'=>"bail|required_if:action,update,enable,disable|nullable|exists:client_testimonials,id",
            'status' =>"bail|required_if:action,update,insert|nullable",
            'client_name' =>"bail|required_if:action,update,insert|nullable",
            'video_link' => [
            'bail',
            'required_if:action,insert',
            'nullable',
            'regex:/^(https?\:\/\/)?(www\.)?youtube\.com\/(watch\?v=|embed\/)[\w-]+(\S+)?$/'
             ],  
            'position' => [
                    'bail',
                    'required_if:action,update,insert',
                    'nullable',
                    'numeric',
                    Rule::unique('client_testimonials', 'position')->ignore($id),
                ],
        
        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
                'data' => null,
            ], 422)
        );
    }
}
