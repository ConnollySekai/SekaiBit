<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ListingRegistrationRequest extends FormRequest
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
        if ($this->input('currentStep') === 1) {
            return [
                'businessName' => ['required', 'string', 'max:255', 'unique:listings,business_name'],
                'websiteUrl' => ['required', 'max:255', 'regex:/^((http|https):\/\/)?(www\.)?([-a-z0-9]+\.)+[-a-z0-9]+(\/[-a-z0-9]+)*$/', 'unique:listings,website_url'],
                'contactEmail' => ['nullable','email', 'max:255','unique:listings,contact_email'],
                'acceptsBitcoin' => ['accepted']
            ];
        } else {
            return [
                'productsServices' => ['required', 'string', 'max:255'],
                'searchTags' => ['required',"array","min:1","max:5"],
                'city' => ['required_if:hasPhysicalStore,true'],
                'country' => ['required_if:hasPhysicalStore,true'],
            ];
        }
    }
}
