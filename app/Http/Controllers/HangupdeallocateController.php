<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class HangupdeallocateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.hangupdeallocate.index');
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
    }




































}