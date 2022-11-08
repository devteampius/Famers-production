<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pcuserupdate;
use Illuminate\Support\Facades\DB; 
use  Config;



class PcuserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('admin.pcuser.index');
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|min:2',
        ]);

        $user_id = $request->post('user_id');

        $sql = "select * from pc_user_def where user_id  = '$user_id' ";
        $user_details =  DB::connection('odbcmfg','odbcdist','odbcsfa')->select($sql);
        
        if (!$user_details) {
            return redirect()->back()->withErrors(['error' => 'user id is not found in Sybase Database']);
        }
        
        $user_data  = array();
        $user_data['user_id'] = $user_details[0]['user_id'];
        $user_data['old_first_name']  = $user_details[0]['first_name'];
        $user_data['old_goes_by_name']  = $user_details[0]['goes_by_name'];
        $user_data['old_last_name']  = $user_details[0]['last_name'];
        
        $user_data['db_status']  = 'verify';


        $user_data['userid']  = $request->user()->id;

        
        $user =  Pcuserupdate::create($user_data);

        if ($user) {
            return redirect()->route(ADMIN . '.pcuser.edit', $user->id)->withSuccess("user id is successfully verified");
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to save Verfied user id details']);
        }
       
    }

    public function edit($id)
    {
        

        $item = Pcuserupdate::findOrFail($id);

        return view('admin.pcuser.edit', compact('item'));
    }




    public function update(Request $request, $id)
    {

        $item = Pcuserupdate::findOrFail($id);

        if (!$item) {
            return redirect()->back()->withErrors(['error' => 'Not Verified User id']);
        }

        
        if ($item->db_status == 'verify') {
            $this->validate($request, [
                'rl_first_name' => 'required',
                'rl_goes_by_name' => 'required',
                'rl_last_name' => 'required',
            ]);

            $rl_first_name = $request->input('rl_first_name');
            $rl_goes_by_name = $request->input('rl_goes_by_name');
            $rl_last_name = $request->input('rl_last_name');

            $sql = "begin tran

            select * from pc_user_def
                   where user_id='$item->user_id'


                   update pc_user_def
                   set first_name = '" . $rl_first_name . "',
                   goes_by_name = '". $rl_goes_by_name . "',
                   last_name = '" . $rl_last_name . "'
                   where user_id='$item->user_id'



                    select * from pc_user_def
                    where user_id='$item->user_id'


       rollback tran
       ";


$user_details =  DB::connection('odbcdist','odbcmfg','odbcsfa')->select($sql);

var_dump($user_details[0]);
exit;

if (!$user_details) {
    return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
}


$user_data  = array();
$user_data['user_id'] = $user_details[0]['user_id'];

$item->rl_first_name  = $user_details[0]['first_name'];
$item->rl_goes_by_name  = $user_details[0]['goes_by_name'];
$item->rl_last_name  = $user_details[0]['last_name'];

$item->db_status  = 'rollback';

// var_dump($item);
// exit;

$update =  $item->update();

            if ($update) {

                return redirect()->route(ADMIN . '.pcuser.edit', $item->id)->withSuccess("Rollback Tran Run Successfully");
            } else {
                return redirect()->route(ADMIN . '.pcuser.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
            }
        }

        else if ($item->db_status == 'rollback') {
            $this->validate($request, [
                'cm_first_name' => 'required',
                'cm_goes_by_name' => 'required',
                'cm_last_name' => 'required',
            ]);

            $cm_first_name = $request->input('cm_first_name');
            $cm_goes_by_name = $request->input('cm_goes_by_name');
            $cm_last_name = $request->input('cm_last_name');


            $sql = "begin tran

            select * from pc_user_def
            where user_id='$item->user_id'


            update pc_user_def
            set first_name='" . $cm_first_name . "',
            goes_by_name ='".$cm_goes_by_name. "',
            last_name='" .$cm_last_name. "'
            where user_id='$item->user_id'



             select * from pc_user_def
             where user_id='$item->user_id'


commit tran
";


$user_details =  DB::connection('odbcdist','odbcmfg','odbcsfa')->select($sql);

if (!$user_details) {
    return redirect()->back()->withErrors(['error' => 'Unable to get Updated Rollback']);
}



$user_data  = array();
$user_data['user_id'] = $user_details[0]['user_id'];

$item->cm_first_name  = $user_details[0]['first_name'];
$item->cm_goes_by_name  = $user_details[0]['goes_by_name'];
$item->cm_last_name  = $user_details[0]['last_name'];

$item->db_status  = 'commit';


$update =  $item->update();

            if ($update) {

                return redirect()->route(ADMIN . '.pcuser.edit', $item->id)->withSuccess("Commit Tran Run Successfully");
            } else {
                return redirect()->route(ADMIN . '.pcuser.edit', $item->id)->withErrors(['error' => 'Unable to run Rollback Tran']);
            }
        }
        else
        {
            return redirect()->route(ADMIN.'.pcuser.index')->withErrors(['error' => 'Invalid Operation']);   
        }

    }

        }
    
