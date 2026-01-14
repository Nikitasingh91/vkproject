<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientTestimonialRequest;
use App\Models\ClientTestimonial;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ClientTestimonialController extends Controller
{
    use CommonFunctions;

    public function viewClientTestimonial(){
        return view("Dashboard.Pages.clientTestimonial");
    }

    public function getClientTestimonial(){
            $query = ClientTestimonial::select(
               'id','video_link','client_name','status','position'
            );
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{ClientTestimonial::ID}.')" class="btn btn-danger btn-sm">Disable</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{ClientTestimonial::ID}.')" class="btn btn-primary btn-sm">Enable </a>';
                if($row->status == 0){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        
        
    }

    public function saveClientTestimonial(ClientTestimonialRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertClientTestimonial($request);
                    break;
                case "update":
                    $return = $this->updateClientTestimonial($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisablePortfolio($request);
                    break;
                default:
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertClientTestimonial(ClientTestimonialRequest $request){ 
        
            $clientTestimonial = new ClientTestimonial();
            $clientTestimonial->video_link = $request->video_link;
            $clientTestimonial->status = $request->status;  
            $clientTestimonial->client_name = $request->client_name;           
            $clientTestimonial->position = $request->position;
            $clientTestimonial->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        return $return;
    }

    public function ClientTestimonialImageUpload(ClientTestimonialRequest $request){
        $maxId = ClientTestimonial::max(ClientTestimonial::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"icon","/images/ClientTestimonial/","slide_$maxId");
    }

    
    public function updateClientTestimonial(ClientTestimonialRequest $request){
        $check = ClientTestimonial::where([ClientTestimonial::ID=>$request->input(ClientTestimonial::ID)])->first();

        if($check){
            
            $check->position = $request->position;
            $check->video_link = $request->video_link;
            $check->client_name = $request->client_name;           
            $check->status = $request->status;
            $check->save();
            $this->forgetSlides();
            $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    public function enableDisablePortfolio(ClientTestimonialRequest $request){
        $check = ClientTestimonial::find($request->input(ClientTestimonial::ID));
        if($check){
            if($request->input("action")=="enable"){
                $check->status = "1";
                $return = ["status"=>true,"message"=>"Enabled successfully.","data"=>""];
            }else{
                $check->status = "0";
                $return = ["status"=>true,"message"=>"Disabled successfully.","data"=>""];
            }
            $this->forgetSlides();
            $check->save();
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>""];
        }
        return $return;
    }
}
