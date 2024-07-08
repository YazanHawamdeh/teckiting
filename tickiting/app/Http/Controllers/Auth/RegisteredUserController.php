<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Models\Types;
use App\Models\UserTypes;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $types = Types::all();

        return view('admin.register', compact('types'))->with('message','User Added successfully');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'usertype' => ['required', 'string', 'max:255'],

        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype'=>  $request->usertype,

            
        ]);


        $usertype=$request->usertype;
        
        
        if ($usertype=="tecknetion") {
            $typeIds = $request->input('type_ids'); // Directly use the array

            // Insert records into the pivot table
            foreach($typeIds as $typeId) {
                UserTypes::create([
                    'user_id' => $user->id, // Assuming the pivot table has teckit_id column
                    'type_id' => $typeId,       // Assuming the pivot table has type_id column
                ]);
            }      
          }

        


        // event(new Registered($user));

        // Auth::login($user);

        return redirect()->back()->with('message','User Added successfully');
    }
}

// 'authtypes'