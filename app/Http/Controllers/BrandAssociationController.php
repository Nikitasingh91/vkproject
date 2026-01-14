<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CommonFunctions;
use Exception;
use App\Http\Requests\BrandRequest;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BrandAssociation;

class BrandAssociationController extends Controller
{
    use CommonFunctions;
    public function viewBrand()
    {
        return view("Dashboard.Pages.brandAssociation");
    }

    public function saveBrand(BrandRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertBrand($request);
                    break;
                case "update":
                    $return = $this->updateBrand($request);
                    break;
                case "enable":
                case "disable":
                    $return = $this->enableDisableBrand($request);
                    break;
                default:
                $return = ["status"=>false,"message"=>"Unknown case","data"=>""];
            }
        }catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertBrand(BrandRequest $request){ 
        $imageUpload = $this->BrandImageUpload($request);
        $ImageUrls = array_column($imageUpload, 'data');
        
            $Brand = new BrandAssociation();
            $Brand->image = json_encode($ImageUrls);
            $Brand->status = $request->status;           
            $Brand->position = $request->position;
            $Brand->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        
        return $return;
    }

    public function BrandImageUpload(BrandRequest $request){
        $maxId = BrandAssociation::max(BrandAssociation::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadMultipleLocalFiles($request,"image","/images/brand/","slide_$maxId");
    }

    
    public function updateBrand(BrandRequest $request){
        $check = BrandAssociation::where([BrandAssociation::ID=>$request->input(BrandAssociation::ID)])->first();

        if($check){
            if($request->hasFile('image') ){
                $imageUpload = $this->BrandImageUpload($request);
                $ImageUrls = array_column($imageUpload, 'data');                
                 $check->image = json_encode($ImageUrls);                                                         
                 }
            $check->position = $request->position;
            $check->status = $request->status;
            $check->save();
            $this->forgetSlides();
            $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    public function enableDisableBrand(BrandRequest $request){
        $check = BrandAssociation::find($request->input(BrandAssociation::ID));
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

    public function getBrand(){
        $query = BrandAssociation::select(
            'id','image','status' ,'position'
        );
    return DataTables::of($query)
        ->addIndexColumn()
        ->addColumn('action', function ($row){
            $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
            
            $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{BrandAssociation::ID}.')" class="btn btn-danger btn-sm">Disable</a>';
            $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{BrandAssociation::ID}.')" class="btn btn-primary btn-sm">Enable </a>';
            if($row->status== 0){
                return $btn_edit.$btn_enable;
            }else{
                return $btn_edit.$btn_disable;
            }
        })
        ->rawColumns(['action'])
        ->make(true);
    
    }
}
