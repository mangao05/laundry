<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware('auth:api');
    }

    public function index()
    {
        return User::where('user_type','!=','Administrator')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email',
            'password' => 'required|Min:6',
            'type' => 'required',
            'branch'=>'required',
        ]);

        $full_name =  $request->input('fname').' '.$request->input('lname');

        $user = new User;
        $user->name =  $full_name;
        $user->email = $request->input('email');
        $user->password = \Hash::make($request->input('password'));
        $user->user_type = $request->input('type');
        $user->branch = $request->input('branch');
        $user->save();

        return $user;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return User::whereId($id)->first();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $full_name =  $request->input('fname').' '.$request->input('lname');

        $user = User::find($id);
        $user->name =  $full_name;
        $user->email = $request->input('email');
        $user->password = \Hash::make($request->input('password'));
        $user->user_type = $request->input('type');
        $user->update();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrfail($id);
        $user->delete();
    }

    public function getUserId($id,$status){
        if($status == 'Activate'){
            $update_status  = DB::table('users')->where('id',$id)->update(['status'=>'Deactivated']);
            return 'Deactivated' ;
        }else{
            $update_status  = DB::table('users')->where('id',$id)->update(['status'=>'Activate']);
            return 'Activated';
        }

    }
    public function username(){
        return \Auth::user();
    }


}
