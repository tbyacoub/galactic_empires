<?php

namespace App\Http\Requests;

use App\Mail;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class MailApiRequest extends FormRequest
{

    protected $redirect = '/mail';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Mail $mail, User $user)
    {
        return $user->id == $mail->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'checked' => 'required|min:1',
        ];
    }
}
