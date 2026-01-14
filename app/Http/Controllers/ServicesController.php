<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicesRequest;
use App\Models\ServicesModel;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    use CommonFunctions;

    public function servicesSlider(){
        return view("Dashboard.Pages.services");
    }

    public function servicesData(){
        $query = ServicesModel::select(
            ServicesModel::ID,
            ServicesModel::BANNER_IMAGE,
            ServicesModel::GALLERY_IMAGES,
            ServicesModel::HEADING_TOP,
            ServicesModel::SLUG,
            ServicesModel::HEADING_MIDDLE,
            ServicesModel::LONG_DESCRIPTION,
            ServicesModel::SEO_TITLE,
            ServicesModel::SEO_DESCRIPTION,
            ServicesModel::SEO_KEYWORDS,
            ServicesModel::SLIDE_STATUS,
            ServicesModel::SLIDE_SORTING
        );

        return DataTables::of($query)
            ->addIndexColumn()
            ->addColumn('banner_image', function($row) {
                return $row->{ServicesModel::BANNER_IMAGE} ? 
                    '<img src="'.url($row->{ServicesModel::BANNER_IMAGE}).'" class="img-thumbnail" width="80">' : '';
            })
            ->addColumn('action', function ($row){
                $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                
                $btn_disable = ' <a href="javascript:void(0)" onclick="Disable('.$row->{ServicesModel::ID}.')" class="btn btn-danger btn-sm">Disable Service</a>';
                $btn_enable = ' <a href="javascript:void(0)" onclick="Enable('.$row->{ServicesModel::ID}.')" class="btn btn-primary btn-sm">Enable Service</a>';
                
                if($row->{ServicesModel::SLIDE_STATUS} == 'disabled'){
                    return $btn_edit . $btn_enable;
                } else {
                    return $btn_edit . $btn_disable;
                }
            })
            ->rawColumns(['banner_image', 'action'])
            ->make(true);
    }

    public function servicesSaveSlide(ServicesRequest $request){
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
                    $return = ["status" => false, "message" => "Unknown action", "data" => null];
            }
        } catch(Exception $exception){
            $return = $this->reportException($exception);
        }
        return response()->json($return);
    }

    public function insertSlide(ServicesRequest $request){
        $service = new ServicesModel();

        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('services/banner_images', 'public');
            $service->{ServicesModel::BANNER_IMAGE} = '/storage/' . $bannerPath;
        }

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $path = $galleryImage->store('services/gallery_images', 'public');
                $galleryPaths[] = '/storage/' . $path;
            }
            // Since your model casts gallery_images to array, store as JSON encoded string or just assign array
            $service->{ServicesModel::GALLERY_IMAGES} = $galleryPaths; // Eloquent cast will handle JSON
        }

        $service->{ServicesModel::HEADING_TOP} = $request->input('heading_top');
        $service->{ServicesModel::SLUG} = $request->input('slug');
        $service->{ServicesModel::HEADING_MIDDLE} = $request->input('heading_middle');
        $service->{ServicesModel::LONG_DESCRIPTION} = $request->input('long_description');
        $service->{ServicesModel::SEO_TITLE} = $request->input('seo_title');
        $service->{ServicesModel::SEO_DESCRIPTION} = $request->input('seo_description');
        $service->{ServicesModel::SEO_KEYWORDS} = $request->input('seo_keywords');
        $service->{ServicesModel::SLIDE_STATUS} = $request->input('slide_status');
        $service->{ServicesModel::SLIDE_SORTING} = $request->input('slide_sorting');

        $service->save();

        $this->forgetSlides();

        return ["status" => true, "message" => "Service saved successfully", "data" => null];
    }

    public function updateSlide(ServicesRequest $request){
        $service = ServicesModel::find($request->input(ServicesModel::ID));

        if (!$service) {
            return ["status" => false, "message" => "Service not found", "data" => null];
        }

        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('services/banner_images', 'public');
            $service->{ServicesModel::BANNER_IMAGE} = '/storage/' . $bannerPath;
        }

        if ($request->hasFile('gallery_images')) {
            $galleryPaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $path = $galleryImage->store('services/gallery_images', 'public');
                $galleryPaths[] = '/storage/' . $path;
            }
            $service->{ServicesModel::GALLERY_IMAGES} = $galleryPaths;
        }

        $service->{ServicesModel::HEADING_TOP} = $request->input('heading_top');
        $service->{ServicesModel::SLUG} = $request->input('slug');
        $service->{ServicesModel::HEADING_MIDDLE} = $request->input('heading_middle');
        $service->{ServicesModel::LONG_DESCRIPTION} = $request->input('long_description');
        $service->{ServicesModel::SEO_TITLE} = $request->input('seo_title');
        $service->{ServicesModel::SEO_DESCRIPTION} = $request->input('seo_description');
        $service->{ServicesModel::SEO_KEYWORDS} = $request->input('seo_keywords');
        $service->{ServicesModel::SLIDE_STATUS} = $request->input('slide_status');
        $service->{ServicesModel::SLIDE_SORTING} = $request->input('slide_sorting');

        $service->save();

        $this->forgetSlides();

        return ["status" => true, "message" => "Service updated successfully", "data" => null];
    }

    public function enableDisableSlide(ServicesRequest $request) {
        $service = ServicesModel::find($request->input(ServicesModel::ID));

        if ($service) {
            if ($request->input("action") == "enable") {
                $service->{ServicesModel::SLIDE_STATUS} = 'live';
                $return = ["status" => true, "message" => "Enabled successfully.", "data" => null];
            } else {
                $service->{ServicesModel::SLIDE_STATUS} = 'disabled';
                $return = ["status" => true, "message" => "Disabled successfully.", "data" => null];
            }
            $service->save();
            $this->forgetSlides();
        } else {
            $return = ["status" => false, "message" => "Service not found.", "data" => null];
        }

        return $return;
    }
}
