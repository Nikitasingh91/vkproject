<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeProductsRequest;
use App\Models\HomeProductsModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class HomeProductsController extends Controller
{
    use CommonFunctions;
    //

    public function homeDestinationsSlider(){
        return view("Dashboard.Pages.homeProducts");
    }

    public function homeDestinationsData(){
        $query = HomeProductsModel::select(HomeProductsModel::IMAGE,
        HomeProductsModel::ID,
        HomeProductsModel::HEADING_TOP,
        HomeProductsModel::HEADING_BOTTOM,
        HomeProductsModel::HEADING_MIDDLE,
        HomeProductsModel::SLIDE_SORTING,
        HomeProductsModel::SLIDE_STATUS);
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{HomeProductsModel::ID}.')" class="btn btn-danger btn-sm">Disable Slide</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{HomeProductsModel::ID}.')" class="btn btn-primary btn-sm">Enable Slide</a>';
                if($row->{HomeProductsModel::SLIDE_STATUS}==HomeProductsModel::SLIDE_STATUS_DISABLED){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function homeDestinationsSaveSlide(HomeProductsRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertSlide($request);
                    break;
                case "update":
                    $return = $this->updateSlide($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisableSlide($request);
                    break;
                default:
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertSlide(HomeProductsRequest $request){
        $imageUpload = $this->slideImageUpload($request);
        if($imageUpload["status"]){
            $HomeProductsModel = new HomeProductsModel();
            $HomeProductsModel->{HomeProductsModel::IMAGE} = $imageUpload["data"];
            $HomeProductsModel->{HomeProductsModel::HEADING_TOP} = $request->input(HomeProductsModel::HEADING_TOP);
            $HomeProductsModel->{HomeProductsModel::HEADING_MIDDLE} = $request->input(HomeProductsModel::HEADING_MIDDLE);
            $HomeProductsModel->{HomeProductsModel::HEADING_BOTTOM} = $request->input(HomeProductsModel::HEADING_BOTTOM);
            $HomeProductsModel->{HomeProductsModel::SLIDE_STATUS} = $request->input(HomeProductsModel::SLIDE_STATUS);
            $HomeProductsModel->{HomeProductsModel::SLIDE_SORTING} = $request->input(HomeProductsModel::SLIDE_SORTING);           
            $HomeProductsModel->{HomeProductsModel::STATUS} = 1;
            $HomeProductsModel->{HomeProductsModel::CREATED_BY} = Auth::user()->id;
            $HomeProductsModel->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        }else{
            $return = $imageUpload;
        }
        return $return;
    }

    public function slideImageUpload(HomeProductsRequest $request){
        $maxId = HomeProductsModel::max(HomeProductsModel::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"image","/website/uploads/Slider/","slide_$maxId");
    }

    public function updateSlide(HomeProductsRequest $request){
        $check = HomeProductsModel::where([HomeProductsModel::ID=>$request->input(HomeProductsModel::ID),HomeProductsModel::STATUS=>1])->first();
        if($check){
            if($request->input(HomeProductsModel::IMAGE)){
                $imageUpload =$this->slideImageUpload($request);
                if($imageUpload["status"]){
                    $check->{HomeProductsModel::IMAGE} = $imageUpload["data"];
                    $check->{HomeProductsModel::SLIDE_SORTING} = $request->input(HomeProductsModel::SLIDE_SORTING);
                    $check->{HomeProductsModel::HEADING_TOP} = $request->input(HomeProductsModel::HEADING_TOP);
                    $check->{HomeProductsModel::HEADING_MIDDLE} = $request->input(HomeProductsModel::HEADING_MIDDLE);
                    $check->{HomeProductsModel::HEADING_BOTTOM} = $request->input(HomeProductsModel::HEADING_BOTTOM);
                    $check->{HomeProductsModel::SLIDE_STATUS} = $request->input(HomeProductsModel::SLIDE_STATUS);
                    $check->{HomeProductsModel::UPDATED_BY} = Auth::user()->id;
                    $check->save();
                    $this->forgetSlides();
                    $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];
                }else{
                    $return = $imageUpload;
                }
            }else{
                $check->{HomeProductsModel::SLIDE_SORTING} = $request->input(HomeProductsModel::SLIDE_SORTING);
                $check->{HomeProductsModel::HEADING_TOP} = $request->input(HomeProductsModel::HEADING_TOP);
                $check->{HomeProductsModel::HEADING_MIDDLE} = $request->input(HomeProductsModel::HEADING_MIDDLE);
                $check->{HomeProductsModel::HEADING_BOTTOM} = $request->input(HomeProductsModel::HEADING_BOTTOM);
                $check->{HomeProductsModel::SLIDE_STATUS} = $request->input(HomeProductsModel::SLIDE_STATUS);
                $check->{HomeProductsModel::UPDATED_BY} = Auth::user()->id;
                $check->save();
                $this->forgetSlides();
                $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            }
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    // public function enableDisableSlide(HomeProductsRequest $request){
    //     $check = HomeProductsModel::find($request->input(HomeProductsModel::ID));
    //     if($check){
    //         $check->{HomeProductsModel::UPDATED_BY} = Auth::user()->id;
    //         if($request->input("action")=="enable"){
    //             $check->{HomeProductsModel::SLIDE_STATUS} = HomeProductsModel::SLIDE_STATUS_LIVE;
    //             $return = ["status"=>true,"message"=>"Enabled successfully.","data"=>""];
    //         }else{
    //             $check->{HomeProductsModel::SLIDE_STATUS} = HomeProductsModel::SLIDE_STATUS_DISABLED;
    //             $return = ["status"=>true,"message"=>"Disabled successfully.","data"=>""];
    //         }
    //         $this->forgetSlides();
    //         $check->save();
    //     }else{
    //         $return = ["status"=>false,"message"=>"Details not found.","data"=>""];
    //     }
    //     return $return;
    // }
    public function enableDisableSlide(HomeProductsRequest $request) {
        $check = HomeProductsModel::find($request->input(HomeProductsModel::ID));
        
        if ($check) {
            $check->{HomeProductsModel::UPDATED_BY} = Auth::user()->id;
            
            if ($request->input("action") == "enable") {
                $check->{HomeProductsModel::SLIDE_STATUS} = HomeProductsModel::SLIDE_STATUS_LIVE;
                $return = ["status" => 1, "message" => "Enabled successfully.", "data" => ""];
            } else {
                $check->{HomeProductsModel::SLIDE_STATUS} = HomeProductsModel::SLIDE_STATUS_DISABLED;
                $return = ["status" => 1, "message" => "Disabled successfully.", "data" => ""];
            }
            
            $this->forgetSlides();
            $check->save();
        } else {
            $return = ["status" => 0, "message" => "Details not found.", "data" => ""];
        }
        
        return $return;
    }
    
}
