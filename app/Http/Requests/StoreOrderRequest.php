<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
    public $phone;
    public $email;
    public function rules()
    {
        if(auth()->check()){
            if(empty($this->phone) )
            {
                $this->phone = auth()->user()->phone;
            }
            if(empty($this->email) )
            {
                $this->email = auth()->user()->email;
            }
        }
        return [
            'email' => ['reqiured', 'email:rfc,dns'],
            'phone' => ['required']
        ];
    }
}
