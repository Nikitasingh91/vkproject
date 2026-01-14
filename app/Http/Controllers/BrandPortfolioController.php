<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandPortfolioRequest;
use App\Models\BrandPortfolio;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class BrandPortfolioController extends Controller
{
    use CommonFunctions;

    public function viewBrandPortfolio(){
        return view("Dashboard.Pages.brandPortfolio");
    }

    public function getBrandPortfolio(){
            $query = BrandPortfolio::select(
               'id','icon','title','status','position','banner_image','description'
            );
        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a   href="javascript:void(0)" onclick="Disable('.$row->{BrandPortfolio::ID}.')" class="btn btn-danger btn-sm">Disable</a>';
                $btn_enable = ' <a   href="javascript:void(0)" onclick="Enable('.$row->{BrandPortfolio::ID}.')" class="btn btn-primary btn-sm">Enable </a>';
                if($row->status == 0){
                    return $btn_edit.$btn_enable;
                }else{
                    return $btn_edit.$btn_disable;
                }
            })
            ->rawColumns(['action'])
            ->make(true);
        
        
    }

    public function saveBrandPortfolio(BrandPortfolioRequest $request){
        try{
            switch($request->input("action")){
                case "insert":
                    $return = $this->insertBrandPortfolio($request);
                    break;
                case "update":
                    $return = $this->updateBrandPortfolio($request);
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

    public function insertBrandPortfolio(BrandPortfolioRequest $request){ 
        $imageUpload = $this->BrandPortfolioImageUpload($request); 
        $bannerImage = $this->BrandBannerUpload($request);
        if($imageUpload['status'])
        {
            $brandPortfolio = new BrandPortfolio();
            $brandPortfolio->icon = $imageUpload['data'];
            $brandPortfolio->status = $request->status;  
            $brandPortfolio->title = $request->title;           
            $brandPortfolio->description = $request->description;           
            $brandPortfolio->banner_image = $bannerImage['data'];           
            $brandPortfolio->position = $request->position;
            $brandPortfolio->save();
            $return = ["status"=>true,"message"=>"Saved successfully","data"=>null];
            $this->forgetSlides();
        }else{
            $return = $imageUpload;
        }
        return $return;
    }

    public function BrandPortfolioImageUpload(BrandPortfolioRequest $request){
        $maxId = BrandPortfolio::max(BrandPortfolio::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"icon","/images/brandPortfolio/","slide_$maxId");
    }

    public function BrandBannerUpload(BrandPortfolioRequest $request){
        $maxId = BrandPortfolio::max(BrandPortfolio::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request,"banner_image","/images/brandBanner/","slide_$maxId");
    }

    
    public function updateBrandPortfolio(BrandPortfolioRequest $request){
        $check = BrandPortfolio::where([BrandPortfolio::ID=>$request->input(BrandPortfolio::ID)])->first();

        if($check){
            if($request->hasFile('icon') ){
                $imageUpload =$this->BrandPortfolioImageUpload($request);
                if($imageUpload["status"]){
                    $check->icon = $imageUpload["data"];                                                         
                }
                
            }
            if($request->hasFile('banner_image') )
            {
                $bannerImage = $this->BrandBannerUpload($request);
                if($bannerImage["status"]){
                    $check->banner_image = $bannerImage["data"];                                                         
                }
            }
            $check->position = $request->position;
            $check->title = $request->title;           
            $check->description = $request->description;           
            $check->status = $request->status;
            $check->save();
            $this->forgetSlides();
            $return = ["status"=>true,"message"=>"Updated successfully","data"=>null];            
            
        }else{
            $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
        }
        return $return;
    }

    public function enableDisablePortfolio(BrandPortfolioRequest $request){
        $check = BrandPortfolio::find($request->input(BrandPortfolio::ID));
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
