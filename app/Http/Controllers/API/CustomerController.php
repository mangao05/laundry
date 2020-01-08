<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return Customer::latest()->paginate(20);
        return Customer::all();
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
            'cname' => 'required',
        ]);

         Customer::updateOrCreate(
            ['name' => $request->cname],
            [
                'contact_number' => $request->cnumber,
                'address1' => $request->caddress,
                'address2' => $request->caddress
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Customer::find($id);
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
        $this->validate($request, [
            'cname' => 'required'
        ]);
        Customer::find($id)->update([
            'name' => $request->cname,
            'contact_number' => $request->cnumber,
            'address1' => $request->caddress,
            'address2' => $request->caddress
        ]);

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::find($id)->delete();
    }
    public function trashCustomer(){
        return \DB::table('customers')
        ->whereNotNull('deleted_at')
        ->get();
    }
}
