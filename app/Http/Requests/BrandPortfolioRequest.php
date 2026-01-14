<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class BrandPortfolioRequest extends FormRequest
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
            'id'=>"bail|required_if:action,update,enable,disable|nullable|exists:brand_portfolios,id",
            'status' =>"bail|required_if:action,update,insert|nullable",
            'title' =>['bail','required_if:action,update,insert','nullable',Rule::unique('brand_portfolios', 'title')->ignore($id)],
            'icon' =>"bail|required_if:action,insert|nullable|image|max:2048",
            'banner_image' =>"bail|required_if:action,insert|nullable|image",
            'description' =>"bail|required_if:action,insert|nullable",
            'position' => [
                    'bail',
                    'required_if:action,update,insert',
                    'nullable',
                    'numeric',
                    Rule::unique('brand_portfolios', 'position')->ignore($id),
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
