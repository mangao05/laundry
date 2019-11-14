<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Customer;
use App\Service;
use App\Transaction;
use App\TransactionDetails;

class TransactionController extends Controller
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
        $transaction = Transaction::orderBy('id', 'DESC')->take(1)->first(['transaction_number', 'status']);
        if($transaction){
            if($transaction->status == 'on_going'){
                return $transaction->transaction_number;
            }else if($transaction->status == 'finish' || $transaction->status == 'void' || $transaction->status == 'cancel'){
                $number = $transaction->transaction_number + 1;
                return  str_pad($number, 4, '0', STR_PAD_LEFT);
            }else{
                return  str_pad(1, 4, '0', STR_PAD_LEFT);
            }
        }else{
            return  str_pad(1, 4, '0', STR_PAD_LEFT);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $job_order = explode('_', $request->transaction_number);
        $transaction_number =  $job_order[1];
        $invID = str_pad($transaction_number, 4, '0', STR_PAD_LEFT);
        $service = Service::find($request->service_id);

        $this->validate($request,[
            'cname' => 'required',
            'cnumber' => 'required|string|max:12',
            'address1' => 'required|string|max:255',
            'address2' => 'required|string|max:255',
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric'
        ]);

        $customer = Customer::updateOrCreate(
            ['name' => $request->cname],
            [
                'contact_number' => $request->cnumber,
                'address1' => $request->address1,
                'address2' => $request->address2
            ]
        );

        if($request->mode == "Deliver"){
            $transaction = $customer->transactions()->updateOrCreate(
                ['transaction_number' => $invID , 'customer_id' => $customer->id ],
                ['mode' => $request->mode, 'status' => 'on_going']
            );
        }else{
            $transaction = $customer->transactions()->updateOrCreate(
                ['transaction_number' => $invID , 'customer_id' => $customer->id ],
                ['mode' => $request->mode, 'pickup_date' => $request->cpickDate, 'status' => 'on_going']
            );
        }

        $details = $transaction->transaction_details()->firstOrCreate([]);
        $items = $details->transaction_items()->create([
            'service_id' => $request->service_id,
            'item' => $request->item_name,
            'price' => $request->price * $request->qty_kilo,
            'qty' => $request->qty_kilo
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type, $id)
    {
        $value = explode('_', $id);
        $number = $value[1];
        $transaction = Transaction::where('transaction_number', $number)->first();

        if(!empty($transaction) || !is_null($transaction)){
            $transaction->update([
                'status' => $type
            ]);
            return "Success";
        }else{
            return "Error";
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function transaction_number($number){
        $transaction = explode('_', $number);
        $transaction_number = $transaction[1];
        $transaction_details=  Transaction::where('transaction_number', $transaction_number)->with('customers')->first();
        if(is_null($transaction_details)){
            return "Error";
        }else{
            return $transaction_details->customers;
        }
    }

    public function fetch_branch(){
        return auth()->user();
    }


    public function saveTransaction(Request $request){
       
        $transaction = Transaction::create([
            'transaction_number' => $request->transaction_number,
            'customer_id' => $request->customer_id,
            'mode' => 'pickup',
            'points_used' => 0,
            'status' => 'ongoing'
        ]);

        $transactiondetails = $transaction->transaction_details()->create();
        foreach($request->services as $service){
            $transactiondetails->transaction_items()->create([
                'service_id' => $service['service_id'],
                'item' =>  $service['service'],
                'qty' =>  $service['quantity'],
                'price' =>  $service['price']
            ]);
        }
    }

    
}
