<?php

namespace App\Actions\Fortify;
// use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    



    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required'],
            'email' => [
                'required',
                'email',
            ],
            
             'password' => ['required'],
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }

}