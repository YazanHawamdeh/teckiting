<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teckit;
use App\Models\Types;
use App\Models\TypeTeckit;
use App\Models\UserTypes;



use Carbon\Carbon;
// use App\Http\Controllers\Types;


class Home extends Controller
{

public function index() {

    $usertype=Auth::user()->usertype;

    $name = Auth::user()->name;

    $id = Auth::user()->id;
    $user = Auth::user();



    // $userTypeIds = UserTypes::where('user_id', $user)->pluck('type_id');

    $userTypeIds = $user->types->pluck('type_id')->toArray();

    // echo json_encode($userTypeIds);
    if ( $usertype=="admin") {
        return view('admin.dashboard');

    }  elseif ( $usertype=="tecknetion"){

        $teckitcountOnWork=Teckit::where('status','=','processing')->count();
        $teckitcountRejected=Teckit::where('status','=','rejected')->orWhere('status', '=', 'canceled')->count();
        $teckitcountDone=Teckit::where('status','=','completed')->count();
        $teckit = Teckit::where('status','=','pinding')->whereHas('types2', function ($query) use ($userTypeIds) {
            $query->whereIn('type_id', $userTypeIds);
        })
        ->get();
        // dd($teckit );



        $teckitcount=Teckit::all()->count();



        return view('home.profileUserTeckit',compact('teckit','teckitcount','teckitcountOnWork','teckitcountRejected','teckitcountDone','name'));

    }else{


        $id = Auth::user()->id;
        $teckit = Teckit::where('user_id', $id)
        ->where('status', 'pinding')
        ->get();

        $teckitcount=Teckit::where('user_id', $id)->count();
        $teckitcountOnWork=Teckit::where('user_id', $id)->where('status','=','processing')->count();
        $teckitcountRejected=Teckit::where('user_id', $id)->where('status','=','rejected')->orWhere('status', '=', 'canceled')->count();
        $teckitcountDone=Teckit::where('user_id', $id)->where('status','=','completed')->count();

        return view('home.profileUserTeckit',compact('teckit','teckitcount','teckitcountOnWork','teckitcountRejected','teckitcountDone','name'));

    }
}

public function teckit_details($id){
    $teckit = Teckit::find($id);
    return view('home.detailsTeckit',compact('teckit'));
}

public function teckitDetailsSolved($id){

    $teckit = Teckit::find($id);
    return view('home.teckitDetailsSolved',compact('teckit'));
}

// public function completedTeckitDetails($id){
//     $teckit = Teckit::find($id);
//     return view('home.detailsTeckit',compact('teckit'));
// }

public function onWorkTeckit(){

    
    $id = Auth::user()->id;
    $usertype=Auth::user()->usertype;


    if( $usertype=="user"){
        $teckit=Teckit::where('user_id', $id)->where('status','=','processing')->get();

    }else $teckit=Teckit::where('status','=','processing')->get();


    // $usertype=Auth::user()->usertype;
    // $teckit=Teckit::where('status','=','processing')->get();

        return view('home.onWorkTeckit',compact('teckit'));


}

public function DoneTeckits(){

    $id = Auth::user()->id;
    $usertype=Auth::user()->usertype;


    if( $usertype=="user"){
        $teckit=Teckit::where('user_id', $id)->where('status','=','completed')->get();

    }else $teckit=Teckit::where('status','=','completed')->get();
    


    return view('home.DoneTeckits',compact('teckit'));
}

public function cancelAndRejectTeckits(){

    $id = Auth::user()->id;
    $usertype=Auth::user()->usertype;


    if( $usertype=="user"){
        $teckit=Teckit::where('user_id', $id)->where('status','=','rejected')->orWhere('status', '=', 'canceled')->where('user_id', $id)->get();

    }else $teckit=Teckit::where('status','=','rejected')->orWhere('status', '=', 'canceled')->get();

    return view('home.cancelAndRejectTeckits',compact('teckit'));
}

public function rejectedTeckitsDetails($id){

    $teckit = Teckit::find($id);

    return view('home.rejectedTeckitsDetails',compact('teckit'));
}



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



public function submitSolution(Request $request) {
    $request->validate([
        'teckitId' => 'required|exists:teckits,id',
        'solution' => 'required|string',
    ]);

    $teckit = Teckit::find($request->teckitId);
    $teckit->solution = $request->solution;
    $teckit->status = 'completed'; // Optionally update status if needed
    $teckit->save();

    return response()->json(['success' => true]);
}


public function submitRejected(Request $request)
{
    $request->validate([
        'teckitId' => 'required|integer',
        'rejectReason' => 'required|string',
    ]);

    // Find the teckit and update its status and rejection reason
    $teckit = Teckit::find($request->teckitId);
    $usertype = Auth::user()->usertype;

    // Debugging statements
    if (!$teckit) {
        return response()->json(['success' => false, 'message' => 'Teckit not found.']);
    }

    if ($usertype == 'tecknetion') {
        $teckit->status = 'rejected';
        $teckit->rejectReason = $request->rejectReason;
        $teckit->save();
        return response()->json(['success' => true]);
    } elseif ($usertype == 'user') {
        $teckit->status = 'canceled';
        $teckit->rejectReason = $request->rejectReason;
        $teckit->save();
        return response()->json(['success' => true]);
    } else {
        // Additional debug info
        return response()->json(['success' => false, 'message' => 'User type not recognized.', 'usertype' => $usertype]);
    }
}





public function acceptTeckit($id)
{
    $teckit = Teckit::findOrFail($id);
    $teckit->status = 'processing';
    $teckit->tecknetion_id = Auth::id(); // Save the user who accepted the teckit
    $teckit->save();
    return redirect()->back()->with('message', 'Teckit accepted successfully');
}

public function rejectTeckit($id)
{


    $usertype = Auth::user()->usertype;
    $teckit = Teckit::findOrFail($id);

    
    if ($usertype == 'tecknetion') {
        $teckit->status = 'rejected';
        $teckit->tecknetion_id = Auth::id(); // Save the user who rejected the teckit
        $teckit->save();
    } elseif ($usertype == 'user') {
        $teckit->status = 'canceled';
        $teckit->tecknetion_id = Auth::id(); // Save the user who rejected the teckit
        $teckit->save();
    } 


    return redirect()->back()->with('message', 'Teckit rejected successfully');
}

public function completeTeckit($id)
{
    $teckit = Teckit::findOrFail($id);
    $teckit->status = 'completed';
    $teckit->tecknetion_id = Auth::id(); // Save the user who rejected the teckit
    $teckit->save();

    return redirect()->back()->with('message', 'Teckit completed successfully');
}


}
