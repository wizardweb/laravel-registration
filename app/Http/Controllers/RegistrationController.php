<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegistrationThankYou;
use App\Models\User;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users') // Ensure email is unique in the users table
            ],
            'telephone' => 'required|string|max:20',
            'address1' => 'required|string|max:255',
            'address2' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'stateprovince' => 'required|string|max:255',
            'zipcode' => 'required|string|max:20',
            'username' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users') // Ensure username is unique in the users table
            ],
            'password' => 'required|string|min:3|confirmed',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        };

            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->address1 = $request->address1;
            $user->address2 = $request->address2;
            $user->city = $request->city;
            $user->stateprovince = $request->stateprovince;
            $user->zipcode = $request->zipcode;
            $user->username = $request->username;
            $user->password = bcrypt($request->password); // Hash the password

            // Save the user to the database
            $user->save();


        Mail::to($request->email)->send(new RegistrationThankYou($request->name));

        
        // Redirect to the thank you page
 
         
        // Redirect to a success page or display a success message
         return redirect()->route('thankyou', ['name' => $request->name]);
    }
}
