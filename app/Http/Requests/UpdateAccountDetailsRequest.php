<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class UpdateAccountDetailsRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$this->user()->id,
            'password' => 'nullable|min:6|max:255|string|confirmed',
            'old_pass' => 'required_with:password|max:255',
            'phone' => 'nullable|string|max:255|max:13'
        ];
    }

    public function persist(){
        if(($oldPass = $this->old_pass) && $this->password) {
            if (Hash::check($oldPass, $this->user()->password)) {
                $this->updateAccDetails($withPass = true);
            } else {
                session()->flash('error', __('front.old_password_incorrect'));
                return back();
            }
        }else{
            $this->updateAccDetails($withPass = false);
        }

        session()->flash('success', __('front.account_details_updated'));
        return redirect()->route('profile.index');
    }

    /**
     * Update account details
     * @param $withPass
     */
    public function updateAccDetails($withPass){
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $withPass ? Hash::make($this->password) : $this->user()->password,
            'phone' => $this->phone
        ];

        $this->user()->update($data);

        $this->user()->profile->update(['phone' => $data['phone']]);
    }
}
