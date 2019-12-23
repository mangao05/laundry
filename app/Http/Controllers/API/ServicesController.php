<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use App\Transaction;

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
       if(isset($_GET['filter'])){

           $transaction_no = Transaction::latest()->first();
           
           if(isset($transaction_no->transaction_number)){
                $transaction_no = $transaction_no->transaction_number;
           }else{
                $transaction_no = 0;
           }

           return response()->json([
                'countService' => Service::where('type', $_GET['filter'])->count(),
                'service' => Service::where('type', $_GET['filter'])->latest()->paginate(6),
                'transaction_number' => $transaction_no + 1
           ]);
       }
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
                'price' => 'required',
             
            ]);
        }else{
            $this->validate($request, [
                'service' => 'required',
                'type' => 'required',
                'price' => 'required',
            
            ]);
            $request['minimum'] = null;
        }
     


        if($request->image == null){
            $request['icon'] = 'default.png';
        }else{
            $imageData = $request->image;
            $fileName = \Carbon\Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
            $img = \Image::make($imageData)->fit(251, 251);
            $img->save(public_path('serviceIcon/').$fileName);
            $request['icon'] = $fileName;
           
        }
            $service = Service::create($request->only('service', 'type', 'price', 'minimum', 'icon'));
            return $service;
      
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
        return Service::latest()->take(4)->get();
    }

    public function fetchServices(){
        return $service = Service::all();

        // return response()->json($service);
    }
    public function getServiceById($id){
        return Service::find($id);
    }
    
}
