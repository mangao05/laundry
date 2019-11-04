<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionItem;

class TransactionDetailsController extends Controller
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
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $number = explode('_', $id);
        $transaction_number = $number[1];
        $transaction = Transaction::where('transaction_number', $transaction_number)->with([ 
            'customers.customer_points', 
            'transaction_details' => function($query){
                return $query->with(['transaction_items' => function($query){
                    return $query->with('service')->whereNull('status')   ;
                }
                ]);
            }
        ])->first();
        if(is_null($transaction) || empty($transaction)){
            return "Error";
        }else{
            return $transaction;

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

    public function removeITem($id){
        $transaction = TransactionItem::find($id)->update([
            'status' => 'removed'
        ]);

        if($transaction){
            return "Successful";
        }
    }

    public function transactionType($type){
        return Transaction::with('customers')->where('status', $type)->latest()->paginate(10);
    }
}