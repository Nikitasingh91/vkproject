<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OverViewRequest;
use App\Models\OverView;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class OverViewController extends Controller
{
    use CommonFunctions;

    public function viewOverView(){
        return view("Dashboard.Pages.manageOverView");
    }

    public function getOverView(){
            $query = OverView::select(
               'id','image','status','title' ,'video_link'
            );
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{OverView::ID}.')" class="btn btn-danger btn-sm">Disable</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{OverView::ID}.')" class="btn btn-primary btn-sm">Enable </a>';
                if($row->status == 0){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        
        
    }

    public function saveOverView(OverViewRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertOverView($request);
                    break;
                case "update":
                    $return = $this->updateOverView($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisableOverView($request);
                    break;
                default:
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertOverView(OverViewRequest $request){ 
        $imageUpload = $this->OverViewImageUpload($request);
        
        if($imageUpload['status'])
        {
            $overView = new OverView();
            $overView->image = $imageUpload['data'];
            $overView->status = $request->status;  
            $overView->title = $request->title;  
            $overView->video_link = $request->video_link;  
            $overView->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        }else{
            $return = $imageUpload;
        }
        return $return;
    }

    public function OverViewImageUpload(OverViewRequest $request){
        $maxId = OverView::max(OverView::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"image","/images/overView/","slide_$maxId");
    }

    
    public function updateOverView(OverViewRequest $request){
        $check = OverView::where([OverView::ID=>$request->input(OverView::ID)])->first();

        if($check){
            if($request->hasFile('image') ){
                $imageUpload =$this->OverViewImageUpload($request);
                
                if($imageUpload["status"]){
                    $check->image = $imageUpload["data"];                                                         
                }
            }
            $check->status = $request->status;
            $check->video_link = $request->video_link;
            $check->title = $request->title;
            $check->save();
            $this->forgetSlides();
            $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    public function enableDisableOverView(OverViewRequest $request){
        $check = OverView::find($request->input(OverView::ID));
        if($check){
            if($request->input("action")=="enable"){
                $check->status = 1;
                $return = ["status"=>true,"message"=>"Enabled successfully.","data"=>""];
            }else{
                $check->status = 0;
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
