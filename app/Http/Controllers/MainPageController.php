<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
    //

    function save(Request $request)
    {

        //dd($request->all());
        if ($request->all())
        {
            DB::table('event_table')->truncate();
            $data=[];
            foreach($request->date_object as $key=> $d)
            {


                $data = ['date_'=> $d['date'],'day'=>$d['day']];
                if ($d['hasEvent']=='true')
                {   
                    $data['event_desc'] = trim($request->event);
                    
                }   

                if ($d['hasEvent']=='false')
                {   
                    $data['event_desc'] = '';
                }   

                DB::table('event_table')->insert($data);
                
            }

            $min_date = DB::table('event_table')->select('date_')->orderBy('date_','ASC')->first();
            $max_date = DB::table('event_table')->select('date_')->orderBy('date_','DESC')->first();
            $data['from2'] = $min_date ?  $min_date->date_ : '0000-00-00';
            $data['to2'] = $max_date ? $max_date->date_ : '0000-00-00';

            // variable for display date range title
            $data['from'] = $min_date ?  date('F Y', strtotime($min_date->date_)) : null;
            $data['to'] = $max_date ? date('F Y', strtotime($max_date->date_)) : null;
            if ($data['from']==$data['to'] && $data['from']!=null && $data['to']!=null)
            {
                $data['to'] = null;
            }
            
            return response()->json(['status'=>1,'message'=>'success','data'=>$data]);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'failed: no parameter']);
        }
    }

    function event()
    {
        $event = DB::table('event_table')->get();

        if (count($event)>0)
        {
            return response()->json(['status'=>1,'message'=>'success.','event'=>$event]);
        }
        else
        {
            return response()->json(['status'=>0,'message'=>'failed: no data found!']);

        }

    }
}
