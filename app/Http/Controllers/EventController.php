<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use THelpers;
use Constant;
use Alert;

class EventController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     * @author Pavan Sengar
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = THelpers::tokenGeneration('search');
        $data_arr = [
            'start_date' => $request->start,
            'end_date' =>$request->end
        ];
        
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => url(Constant::API_URL),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => json_encode($data_arr),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Accept: application/json",
                "x-api-key: ".$token['token'],
            ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return $response;
    }
    /**
     * Store a newly created resource in storage.
     * @author Pavan Sengar
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $validator=validator::make($request->all(),[
                'title'=>'required',
                'start'=>'required',
                'end'=>'required',
                'allDay'=>'required',
                'color'=>'required',
                'textColor'=>'required'
            ], [
                'title.required' => 'Title is required',
                'start.required' => 'Start date is required',
                'end.required' => 'End date is required',
                'allDay.required' => 'All Day is required'
            ]);

            if($validator->fails()){
                Alert::error('Error!',$validator->messages()->first());
                return redirect()->back();
            }else{
                if(empty($request->event_id)){
                    Event::create($request->all());
                    Alert::success('Success','Event created successfully');
                    return redirect()->back();
                }else{
                    Event::where('id',$request->event_id)->update([
                        'title'=>$request->title,
                        'start'=>$request->start,
                        'end'=>$request->end,
                        'allDay'=>$request->allDay,
                        'color'=>$request->color,
                        'textColor'=>$request->textColor
                    ]);
                    Alert::success('Success','Event updated successfully');
                    return redirect()->back();
                }
            }
        }catch (Exception $e){
            Alert::error('Error!');
            return redirect()->back();
        }
    }
}
