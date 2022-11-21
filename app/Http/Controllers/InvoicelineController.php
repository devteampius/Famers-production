<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Invoiceline;


class InvoicelineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.invoiceline.index');
    }



    public function store(Request $request)
    {
    
        $this->validate($request, [
            'from_invoice_dt' => 'required|min:5',
            'to_invoice_dt' => 'required|min:5',
        ]);
        $from_invoice_dt = $request->post('from_invoice_dt');
        $to_invoice_dt = $request->post('to_invoice_dt');
    

        $sql = "select count(*) from billing_det
        where invoice_dt >= '$from_invoice_dt' and invoice_dt <= '$to_invoice_dt'
         ";
            //   var_dump($sql);
            //   exit;
        $invoice_details =  DB::connection('odbcdist')->select($sql);
        //     var_dump($invoice_details);
        //   exit;

        if (!$invoice_details) {
            return redirect()->back()->withErrors(['error' => 'Data is not found in Sybase Database']);
        }
        // echo '<pre>';print_r($invoice_details);
        // die();

        $invoice_data  = array();
        $invoice_data['from_invoice_dt'] = $invoice_details[0]['invoice_dt >'];
        $invoice_data['to_invoice_dt']  = $invoice_details[0]['invoice_dt <'];
        $invoice_data['userid']  = $request->user()->id;
        $invoice_data['db_status']  = 'entered';

        $invoice =  Invoiceline::create($invoice_data);
        var_dump($invoice);
        exit;

        if ($invoice) {
            return redirect()->route(ADMIN . '.invoiceline.edit', $invoice->id)->withSuccess("Dates are successfully verified");
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to save Verfied Dates']);
        }
        
}


public function edit($id)
    {

        $item = Invoiceline::findOrFail($id);

        return view('admin.invoiceline.edit', compact('item'));
    }




}