<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teckit;
use App\Models\Types;
use App\Models\User;
use App\Models\TeckitImage;
use App\Models\TypeTeckit;
use App\Models\UserTypes;




use Carbon\Carbon;

class Admin extends Controller
{

// ================================================================== store type


public function add_type(Request $request){

    $type=new Types;

    $type->title=$request->input('title');
        $type->save();
    
        // Return the view
        return redirect()->back()->with('message','type Added successfully');

    
}


// ================================================================== view type

public function view_type() {
    return view('admin.type');
}



// ================================================================== view teckit



public function create()
{
    $types = Types::all();
    return view('admin.teckit', compact('types'));
}


// ================================================================== store teckit
public function store(Request $request)
{
    $usertype=Auth::user()->usertype;
    $user = Auth::user();

    if ( $usertype=='tecknetion' ) {
        $teckit->tecknetion_id = $user->id;
    }

    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'type_ids' => 'required|array',
        'type_ids.*' => 'exists:types,id',
        'images.*' => 'file|mimes:jpeg,png,jpg,gif,mp4,mov,avi',
    ]);

    $teckit = Teckit::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'user_id' => $user->id, // Set the user_id directly here
    ]);

    $typeIds = $request->input('type_ids'); // Directly use the array

    // Insert records into the pivot table
    foreach ($typeIds as $typeId) {
        TypeTeckit::create([
            'teckit_id' => $teckit->id,
            'type_id' => $typeId,
        ]);
    }

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = $image->getClientOriginalName();
            $image->storeAs('public/images', $imageName);
            // You might need to adjust the storage path according to your setup
            TeckitImage::create([
                'teckit_id' => $teckit->id,
                'image_url' => 'storage/images/' . $imageName,
            ]);
        }
    }

    return redirect()->back()->with('message', 'Teckit added successfully');
}


// ================================================================== users show


public function view_users()
{
    $users = User::all();
    return view('admin.view_users', compact('users'));
}


// ================================================================== delete user


public function delete_User($id) {

    $user=User::find($id);
    $user->delete();
    return redirect()->back()->with('message','user deleted successfully');

    }





// ================================================================== update user



    
    public function update_user($id){
        $user=User::find($id);

        $types=Types::all();


        return view('admin.update_user',compact('user','types'));
    }

    
    public function update_user_confirm(Request $request,$id){

        $user=User::find($id);
        $user->name=$request->name;
        $user->email=$request->email;


        // $user->type=$request->type;
        $user->usertype=$request->usertype;


        $user->save();
        return redirect()->back()->with('message','user updated successfully');

    }



    // ================================================================== teckits show


public function view_teckits()
{
    $teckits = Teckit::all();
    return view('admin.view_teckits', compact('teckits'));
}


}
