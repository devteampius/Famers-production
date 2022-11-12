<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use App\VoucherUpdates;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = voucherUpdates::paginate(6);

        return view('admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            'vou_number' => 'required|min:5',
        ]);

        $vou_number = $request->post('vou_number');

        $sql = "select * from voucher where vou_no  = $vou_number";

        $vou_details =  DB::connection('odbcfin')->select($sql);

        if (!$vou_details) {
            return redirect()->back()->withErrors(['error' => 'Voucher Number is not found in Sybase Database']);
        }



        $vou_data  = array();
        $vou_data['vou_number'] = $vou_details[0]['vou_no'];
        $vou_data['old_paid_status']  = $vou_details[0]['vou_status'];
        $vou_data['old_paid_amt']  = $vou_details[0]['vou_paid_amt'];
        $vou_data['old_paid_date']  = $vou_details[0]['vou_pay_dt'];

        $vou_data['db_status']  = 'verify';


        $vou_data['userid']  = $request->user()->id;


        $vou =  VoucherUpdates::create($vou_data);

        if ($vou) {
            return redirect()->route(ADMIN . '.categories.edit', $vou->id)->withSuccess("Voucher is successfully verified");
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to save Verfied Voucher details']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
     
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $item = VoucherUpdates::findOrFail($id);

        return view('admin.categories.edit', compact('item'));
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

        $item = VoucherUpdates::findOrFail($id);

        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Not Verified Voucher']);
        }

        if ($item->db_status == 'verify') {
            $this->validate($request, [
                'rl_paid_status' => 'required',
                'rl_paid_date' => 'required',
            ]);

            $rl_paid_date = $request->input('rl_paid_date');
            $rl_paid_status = $request->input('rl_paid_status');
          

            $sql = "begin tran
  
        
        update voucher 
        set vou_paid_amt = vou_inv_amt,
        vou_pay_dt = '" . $rl_paid_date . "',
        vou_status = '" . $rl_paid_status . "'
        where vou_no = $item->vou_number   
        
        
        select * from voucher where vou_no  = $item->vou_number    
        
        
        rollback  tran
        ";

            $vou_details =  DB::connection('odbcfin')->select($sql);

            if (!$vou_details) {
                return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
            }

           

            $vou_data  = array();
            $vou_data['vou_number'] = $vou_details[0]['vou_no'];

            $item->rl_paid_status  = $vou_details[0]['vou_status'];
            $item->rl_paid_amt  = $vou_details[0]['vou_paid_amt'];
            $item->rl_paid_date  = $vou_details[0]['vou_pay_dt'];

            $item->db_status  = 'rollback';

        
// var_dump($item);
// exit;

            $update =  $item->update();

            

            if ($update) {

                return redirect()->route(ADMIN . '.categories.edit', $item->id)->withSuccess("Rollback Tran Run Successfully");
            } else {
                return redirect()->route(ADMIN . '.categories.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
            }
        }


        else if ($item->db_status == 'rollback') {
           

        //      $cm_paid_date = $request->input('cm_paid_date');
        //    $cm_paid_status = $request->input('cm_paid_status');
         $cm_paid_date = $item->rl_paid_date;
         $cm_paid_status = $item->rl_paid_status;
        
         
    //   var_dump($cm_paid_date);
    //       exit;
           
          $sql = "begin tran
  
        
        update voucher 
        set vou_paid_amt = vou_inv_amt,
        vou_pay_dt = '" . $cm_paid_date . "',
        vou_status = '" . $cm_paid_status . "'
        where vou_no = $item->vou_number   
        
        
        select * from voucher where vou_no  = $item->vou_number    
        
        
        commit  tran
        ";
    

            $vou_details =  DB::connection('odbcfin')->select($sql);

            if (!$vou_details) {
                return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
            }



            $vou_data  = array();
            $vou_data['vou_number'] = $vou_details[0]['vou_no'];

            $item->cm_paid_status  = $vou_details[0]['vou_status'];
            $item->cm_paid_amt  = $vou_details[0]['vou_paid_amt'];
            $item->cm_paid_date  = $vou_details[0]['vou_pay_dt'];

            $item->db_status  = 'commit';


            // var_dump($item);
            // exit;

            $update =  $item->update();

            if ($update) {

                return redirect()->route(ADMIN . '.categories.edit', $item->id)->withSuccess("Commit Tran Run Successfully");
            } else {
                return redirect()->route(ADMIN . '.categories.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
            }
        }
        else
        {
            return redirect()->route(ADMIN.'.categories.index')->withErrors(['error' => 'Invalid Operation']);   
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
        Category::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }
}
