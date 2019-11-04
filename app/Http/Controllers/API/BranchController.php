<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Branch;
class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Branch::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'branch_code' => 'required',
            'address' =>'required'
        ]);

        $branch = new Branch;
        $branch->branch_code = $request->input('branch_code');
        $branch->branch_address = $request->input('address');
        $branch->save();

        return $branch;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Branch::whereId($id)->first();
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
            'branch_code' => 'required',
            'address' =>'required'
        ]);

        $branch = Branch::findOrfail($id);
        $branch->branch_code = $request->input('branch_code');
        $branch->branch_address = $request->input('address');
        $branch->update();

        return $branch;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Branch = Branch::findOrfail($id);
        $Branch->delete();
    }
}
