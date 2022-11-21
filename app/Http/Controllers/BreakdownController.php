<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Breakdown;
use Illuminate\Support\Facades\DB; 
use  Config;



class BreakdownController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.breakdown.index');
    }



    public function store(Request $request)
    {
    
        $this->validate($request, [
            'from_dt' => 'required|min:5',
            'to_dt' => 'required|min:5',
        ]);
        $from_dt = $request->post('from_dt');
        $to_dt = $request->post('to_dt');
       

        $sql = "pi_new_customers_ords_sch_116 '$from_dt','$to_dt'
         ";
        //    var_dump($sql);
        //     exit;
        $breakdown_details =  DB::connection('odbcdist')->select($sql);

        //   var_dump($breakdown_details);
        //   exit;
        

        if (!$breakdown_details) {
            return redirect()->back()->withErrors(['error' => 'Data is not found in Sybase Database']);
        }

        echo '<pre>';print_r($breakdown_details);
         die();
       
        $breakdown_data  = array();
        $breakdown_data['from_dt'] = $breakdown_details[0]['from_dt'];
        $breakdown_data['to_dt']  = $breakdown_details[0]['to_dt'];
        $breakdown_data['userid']  = $request->user()->id;
        $breakdown_data['db_status']  = 'entered';

        $breakdown =  Breakdown::create($breakdown_data);
        // var_dump($breakdown);
        // exit;

        if ($breakdown) {
            return redirect()->route(ADMIN . '.breakdown.edit', $breakdown->id)->withSuccess("Dates are successfully verified");
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to save Verfied Dates']);
        }
        
}

public function edit($id)
    {

        $item = Breakdown::findOrFail($id);

        return view('admin.breakdown.edit', compact('item'));
    }





}
