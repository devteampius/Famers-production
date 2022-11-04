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
        $items = Qutdue::paginate(6);

        return view('admin.qutdue.index', compact('items'));
    }


    public function show()
    {
     
    }

    public function store(Request $request)
        {
        
            $this->validate($request, [
                'order_no' => 'required|min:6',
            ]);
            $order_no = $request->post('order_no');
           

            $sql = "select * from demand_repl_review where order_no ='$order_no' ";

            $order_details =  DB::connection('odbcmfg')->select($sql);

            if (!$order_details) {
                return redirect()->back()->withErrors(['error' => 'order Number is not found in Sybase Database']);
            }
           
            $order_data  = array();
            $order_data['order_no'] = $order_details[0]['order_no'];
            $order_data['old_qty_due']  = $order_details[0]['qty_due'];
            $order_data['userid']  = $request->user()->id;
            $order_data['db_status']  = 'verify';

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

    public function update(Request $request, $id)
    {

        $item = Qutdue::findOrFail($id);

        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Not Verified order number']);
        }

        if ($item->db_status == 'verify') {
            $this->validate($request, [
                'rl_qty_due' => 'required',
                
            ]);

            $rl_qty_due = $request->input('rl_qty_due');
            

            $sql = "begin tran
  
        
            update demand_repl_review
            set qty_due = " . $rl_qty_due . "
            where order_no = '$item->order_no'
            
            
            select * from demand_repl_review where order_no = '$item->order_no'
              
        
        
        rollback  tran
        ";


        $order_details =  DB::connection('odbcmfg')->select($sql);

            if (!$order_details) {
                return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
            }



            $order_data  = array();
            $order_data['$order_no'] = $order_details[0]['order_no'];

            $item->rl_qty_due  = $order_details[0]['qty_due'];
            

            $item->db_status  = 'rollback';


            
            $update =  $item->update();

            if ($update) {

                return redirect()->route(ADMIN . '.qutdue.edit', $item->id)->withSuccess("Rollback Tran Run Successfully");
            } else {
                return redirect()->route(ADMIN . '.qutdue.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
            }
        }

        else if ($item->db_status == 'rollback') {
            $this->validate($request, [
                'cm_qty_due' => 'required',
                
            ]);

            $cm_qty_due = $request->input('cm_qty_due');
            
            $sql = "begin tran
  
        
            update demand_repl_review
            set qty_due = " . $cm_qty_due . "
            where order_no = '$item->order_no'
            
            
            select * from demand_repl_review where order_no = '$item->order_no'
              
        
        
        commit  tran
        ";

        $order_details =  DB::connection('odbcmfg')->select($sql);

        if (!$order_details) {
            return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
        }

        $order_data  = array();
        $order_data['order_no'] = $order_details[0]['order_no'];

        $item->cm_qty_due  = $order_details[0]['qty_due'];
       

        $item->db_status  = 'commit';

        $update =  $item->update();

        if ($update) {

            return redirect()->route(ADMIN . '.qutdue.edit', $item->id)->withSuccess("Commit Tran Run Successfully");
        } else {
            return redirect()->route(ADMIN . '.qutdue.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
        }
    }
    else
    {
        return redirect()->route(ADMIN.'.qutdue.index')->withErrors(['error' => 'Invalid Operation']);   
    }

        }

    }
