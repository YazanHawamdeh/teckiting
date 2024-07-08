<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teckit;
use App\Models\Types;
use App\Models\TypeTeckit;



use Carbon\Carbon;

class Normaluser extends Controller
{

            



public function viewUpload(){
    $types = Types::all();

    return view('user.upload',compact('types'));
}

    
// public function teckit_details_user($id){

//     $teckit = Teckit::find($id);

//     return view('user.detailsTeckitUser',compact('teckit'));
// }




// public function completedTeckitDetailsUser($id){
//     $id=Auth::user()->id;
//     $teckit=Teckit::where('user_id','=',$id)->get();
//     // $teckit = Teckit::find($id);
//     return view('user.completedTeckitDetailsUser',compact('teckit'));
// }


// public function onWorkTeckit(){

//     $id = Auth::user()->id;
//     $teckit = Teckit::where('user_id', $id)
//                      ->where('status', 'processing')
//                      ->get();
//     // $teckit=Teckit::where('status','=','processing')->get();

//     return view('user.onWorkTeckit',compact('teckit'));
// }


// public function DoneTeckitsUser() {
//     $id = Auth::user()->id;
//     $teckit = Teckit::where('user_id', $id)
//                      ->where('status', 'completed')
//                      ->get();

//     return view('user.DoneTeckits', compact('teckit'));
// }

// public function cancelAndRejectTeckitsUser(){
//     $id = Auth::user()->id;
//     $teckit = Teckit::where('user_id', $id)
//                      ->where('status', 'rejected')
//                      ->get();

//     // $teckit=Teckit::where('status','=','rejected')->get();

//     return view('user.cancelAndRejectTeckitsUser',compact('teckit'));
// }

// public function rejectedTeckitsDetailsUser($id){

//     $teckit = Teckit::find($id);
    

//     return view('user.rejectedTeckitsDetailsUser',compact('teckit'));
// }



public function updateStatus(Request $request)
{
    $teckit = Teckit::find($request->teckitId);
    if ($teckit) {
        $teckit->status = $request->status;
        $teckit->save();
        return response()->json(['success' => true]);
    } else {
        return response()->json(['success' => false]);
    }
}





}
