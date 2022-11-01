<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Qutdue;
use  Config;
class QutdueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.qutdue.index');
    }

    public function store(Request $request)
        {
        
           /* $this->validate($request, [
                'order_no' => 'required|min:6',
            ]);*/
            $order_no = $request->post('order_no');
           

            $sql = "select * from demand_repl_review where order_no ='$order_no' ";

            $order_details =  DB::connection('odbcmfg')->select($sql);

            if (!$order_details) {
                return redirect()->back()->withErrors(['error' => 'order Number is not found in Sybase Database']);
            }
            var_dump($order_details[0]);
            $order_data  = array();
            $order_data['order_no'] = $order_details[0]['order_no'];
            $order_data['old_qty_due']  = $order_details[0]['qty_due'];
            $order_data['userid']  = $request->user()->id;

            $order =  Qutdue::create($order_data);

            if ($order) {
                return redirect()->route(ADMIN . '.qutdue.edit', $order->id)->withSuccess("order number is successfully verified");
            } else {
                return redirect()->back()->withErrors(['error' => 'Unable to save Verfied order details']);
            }
            
    }

    public function edit($id)
    {

        $item = Qutdue::findOrFail($id);

        return view('admin.qutdue.edit', compact('item'));
    }

}