<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;

class ServicesController extends Controller
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
        // return auth('api')->user();
        return Service::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request->type == 'kilo'){
            $this->validate($request, [
                'service' => 'required',
                'type' => 'required',
                'minimum' => 'required',
                'price' => 'required'
            ]);
        }else{
            $this->validate($request, [
                'service' => 'required',
                'type' => 'required',
                'price' => 'required'
            ]);
            $request['minimum'] = null;
        }

        $service = Service::create($request->only('service', 'type', 'price', 'minimum'));

        if($service){
            return $service;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        return $service;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Service $service)
    {
        // return $service;
        // $service->service = $request->get('service');
        // $service->price = $request->get('price');
        $updateService = $service->update($request->only(['service', 'price', 'minimum', 'type']));

        if($updateService === true){
            return "Successfully Updated";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = Service::findOrfail($id);
        $service->delete();
    }

    public function dailyServices(){
        return Service::latest()->take(2)->get();
    }

    public function fetchServices(){
        return $service = Service::all();

        // return response()->json($service);
    }
    public function getServiceById($id){
        return Service::find($id);
    }
}
