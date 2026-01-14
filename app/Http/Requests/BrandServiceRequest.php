<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BrandServiceRequest extends FormRequest
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
            'id'=>"bail|required_if:action,update,enable,disable|nullable|exists:brand_services,id",
            'status' =>"bail|required_if:action,update,insert|nullable",
            'title' =>"bail|required_if:action,update,insert|nullable",
            'description' =>"bail|required_if:action,update,insert|nullable",
            'brand_id' =>"bail|required_if:action,update,insert|nullable",
            'files' => 'nullable|mimes:pdf',
            
            // 'files.*' => 'mimes:pdf',
            'image' =>"bail|nullable|image",
            'video_link' => [
            'bail',
            'nullable',
            'regex:/^(https?\:\/\/)?(www\.)?youtube\.com\/(watch\?v=|embed\/)[\w-]+(\S+)?$/'
             ],  
            'position' => [
                    'bail',
                    'required_if:action,update,insert',
                    'nullable',
                    'numeric',
                    Rule::unique('brand_services', 'position')->ignore($id),
                ],
        
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $action = $this->input('action');
            $hasImage = $this->hasFile('image');
            $hasVideo = filled($this->input('video_link'));

            if (in_array($action, ['insert']) && !$hasImage && !$hasVideo) {
                $validator->errors()->add('image', 'Either image or video link is required.');
                $validator->errors()->add('video_link', 'Either image or video link is required.');
            }
        });
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
