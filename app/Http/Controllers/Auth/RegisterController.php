<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        // dd($data);
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'gender' => ['required', 'in:male,female'], // Validation for gender
            'hobby' => ['required', 'array', 'min:3'], // Minimum 3 hobbies as an array
            'hobby.*' => ['string', 'distinct'], // Each hobby must be unique
            'instagram' => ['required', 'regex:/^https?:\/\/(www\.)?instagram\.com\/[a-zA-Z0-9._]+$/'], // Instagram link validation
            'phone_number' => ['required', 'digits_between:10,15'], // Mobile number must be digits only
            'fee_for_register' => ['required', 'integer'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'criteria' => ['nullable', 'string', 'max:255'], // Optional validation for criteria
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // dd($data);
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'gender' => $data['gender'],
            'hobby' => json_encode($data['hobby']), // Store hobbies as JSON
            'instagram' => $data['instagram'],
            'phone_number' => $data['phone_number'],
            'criteria' => $data['criteria'], // Optional field
            'fee_for_register' => $data['fee_for_register'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
