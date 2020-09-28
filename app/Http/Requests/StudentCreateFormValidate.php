<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateFormValidate extends FormRequest
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
          'name'=>'required|regex:/^[a-zA-Z][a-zA-Z\s]*$/',
          'email'=>'required|email:filter|unique:students,email',
          'cell'=>'required|starts_with:0|digits:11',
          'gender'=>'required',
          'monthly_donation'=>'required',
        ];
    }
    public function messages()
    {
        return [
          'name.required'=>'Please Provide a Student Name Here',
          'name.regex'=>'Please Provide VALID Human Name Here',
          'email.required'=>"Please Provide a Student's Email-Address Here",
          'email.email'=>"Please Provide a VALID Email Address Here",
          'email.unique'=>'The Email Address has been Already Used by other student',
          'cell.required'=>"Please Give The student's Contact Details",
          'cell.starts_with'=>"Phone Number Starts with 0 , you know it right ?",
          'gender.required'=>"Please Choose a Gender Here",
          'monthly_donation.required'=>'Put a Donation Amount Here, if not possible please give 0',
        ];
    }
}
