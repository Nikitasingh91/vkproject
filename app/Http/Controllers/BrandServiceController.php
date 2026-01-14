<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\CommonFunctions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\BrandServiceRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Models\BrandService;
use App\Models\BrandPortfolio;
use Illuminate\Support\Facades\Storage;


class BrandServiceController extends Controller
{
    use CommonFunctions;
  
    public function viewBrandService()
    {
        $brand = BrandPortfolio::where('status',1)->get(['id', 'title']);
        return view("Dashboard.Pages.manageBrandService" ,compact('brand'));
    }

    public function saveBrandService(BrandServiceRequest $request)
    {
        Cache::forget("brand_services");
        switch ($request->input("action")) {
            case "insert":
                $return = $this->insertData($request);
                break;
            case "update":
                $return = $this->updateData($request);
                break;
            case "enable":
                $return = $this->enableRow($request);
                break;
            case "disable":
                $return = $this->disableRow($request);
                break;
            default:
                $return = ["status" => false, "message" => "Unknown action.", "data" => null];
        }
        return response()->json($return);
    }

    public function ImageUpload(BrandServiceRequest $request)
    {
        $maxId = BrandService::max(BrandService::ID);
        $maxId += 1;
        $timeNow = strtotime($this->timeNow());
        $maxId .= "_$timeNow";
        return $this->uploadLocalFile($request, 'image', "/images/brand_service/", "brand_$maxId");
    }

    public function insertData(BrandServiceRequest $request)
    {
        $createNewRow = new BrandService();

        if($request->file('image')){
            $image_url = "";
            $bannerImage = $this->ImageUpload($request);

            if ($bannerImage["status"]) {
                $image_url = $bannerImage["data"];
                $createNewRow->image = $image_url;
            } else {
                return $bannerImage;
            }  
        }       
        // $uploadedFiles = [];
        // if ($request->hasFile('files')) {
        //     foreach ($request->file('files') as $file) {
        //         $filename = uniqid() . '_' . $file->getClientOriginalName();
        //         $filePath = 'brand_service_files/' . $filename;
                
        //         Storage::disk('public')->put($filePath, file_get_contents($file));
        //         $uploadedFiles[] = [
        //             'filename' => $filename,
        //             'path' => $filePath,
        //         ];
        //     }
        // }           
            $uploadedFiles = "";
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                
                $directory = 'brand_service_files';
                $path = public_path($directory);
                
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                
                $file->move($path, $filename);               
                $uploadedFiles = $filename;
            }          
                     
            $createNewRow->title = $request->title;
            $createNewRow->description = $request->description;
            $createNewRow->position = $request->position;
            $createNewRow->video_link = $request->video_link;
            $createNewRow->brand_id = $request->brand_id;
            $createNewRow->status = $request->status;
            $createNewRow->files = $uploadedFiles; 
            // $createNewRow->files = json_encode($uploadedFiles); 
            $createNewRow->save();
            $return = $this->returnMessage("Saved successfully.", true);
        
        return $return;
    }

    public function updateData(BrandServiceRequest $request)
    {
        
            $updateModel = BrandService::find($request->id);
        if($updateModel){
            $image_url = $updateModel->image;
            if($request->file('image')){
                $BrandServiceImage = $this->ImageUpload($request);
                if ($BrandServiceImage["status"]) {
                    $image_url = $BrandServiceImage["data"];
                    $updateModel->image = $image_url;
                } else {
                    $updateModel->image = $BrandServiceImage;
                }
            }  

            // $uploadedFiles = [];
            // if ($request->hasFile('files')) {
            //     foreach ($request->file('files') as $file) {
            //         $filename = uniqid() . '_' . $file->getClientOriginalName();
            //         $filePath = 'brand_service_files/' . $filename;
            //         $file->move(public_path('brand_service_files'), $filename);                   
            //         $uploadedFiles[] = [
            //             'filename' => $file->getClientOriginalName(),
            //             'path' => $filePath,
            //         ];
            //     }
            // }  
            $uploadedFiles = "";
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $filename = uniqid() . '_' . $file->getClientOriginalName();
                
                // Create directory if it doesn't exist
                $directory = 'brand_service_files';
                $path = public_path($directory);
                
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
                
                $file->move($path, $filename);
                
                $uploadedFiles = $filename;
                $updateModel->files = $uploadedFiles; 
            }
            $updateModel->title = $request->title;
            $updateModel->description = $request->description;
            $updateModel->position = $request->position;
            $updateModel->video_link = $request->video_link;
            $updateModel->brand_id = $request->brand_id;  
            // $updateModel->files = json_encode($uploadedFiles); 

            $updateModel->status = 1;
            $updateModel->save();
            $return = $this->returnMessage("Saved successfully.", true);
        }else{
                $return = ["status"=>false,"message"=>"Details not found.","data"=>null];
            }
        return $return;
    }

    public function enableRow(BrandServiceRequest $request)
    {
        $check = BrandService::where('id', $request->id)->first();
        if ($check) {
            $check->status = 1;
            $check->save();
            $return = $this->returnMessage("Enabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    public function disableRow(BrandServiceRequest $request)
    {
        $check = BrandService::where('id', $request->id)->first();
        if ($check) {
            $check->status = 0;
            $check->save();
             
            $return = $this->returnMessage("Disabled successfully.", true);
        } else {
            $return = $this->returnMessage("Details not found.");
        }
        return $return;
    }

    public function brandServiceData()
    {
        $query = BrandService::select(
            'brand_id','image','video_link','title','description','status','position','id','files'
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

}
