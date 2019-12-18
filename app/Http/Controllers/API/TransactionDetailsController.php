<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transaction;
use App\TransactionItem;
use DB;
use Carbon\Carbon;
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
        if($type =='all'){
            return Transaction::with('customers')->paginate(10);
        }else{
            return Transaction::with('customers')->where('status', $type)->latest()->paginate(10);
        }
       
    }

    public function dashboardStatus(){
        $all = Transaction::all()->count();
        $for_PickUp =  Transaction::where('status', 'for_PickUp')->count();
        $finish =  Transaction::where('status', 'finish')->count();
        return response()->json([
            'all' => $all,
            'for_PickUp' => $for_PickUp,
            'finish' => $finish,
        ]);
    }

    public function Sale(){
        // Carbon
    

        $data = Transaction::select('created_at')
        ->get()
        ->groupBy(function($date) {
            return Carbon::parse($date->created_at)->isoFormat('MMMM');
        })->map(function($rows){
            return [
                'count' => $rows->count()
            ];
        });
        // $data =
        return  $data;
             
        
    }
    public function gettingdate($date,$type) {
        $getDate = Transaction::with('customers')
        ->where('created_at', 'LIKE', '%' . $date . '%')
        ->where('status', $type)
        ->latest()
        ->paginate(10);
        return $getDate;
    }
}