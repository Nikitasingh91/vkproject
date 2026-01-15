<?php

namespace App\Http\Controllers;

use App\Http\Requests\WebSiteElementRequest;
use App\Models\WebSiteElements;
use App\Traits\CommonFunctions;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class WebSiteElementsController extends Controller
{
    
    use CommonFunctions;
    const ELEMENTS = [
        "Logo",
        "email_1",
        "email_2",
        "contact_us_contact_number",
        // "facebook_link",
        // "youtube_link",
        // "linkedin_link",
        // "instagram_link",
        "home_about_content",
        "home_about_image",
        "footer_logo_name",
        "address",
        "whatsapp_footer_link",
        "about_us_page_text",
        "mision_image",
        "mision_content",
        "vision_image",
        "vision_content",
        "value_image",
        "value_content",
        "contact_us_image",
        "contact_us_content",
        "boucher_pdf",
        "quality_policy"
    ];
    public function addWebSiteElements()
    {
        $titles = self::ELEMENTS;
        return view("Dashboard.Pages.webSiteElements", compact("titles"));
    }

    public function saveWebSiteElement(WebSiteElementRequest $request)
    {
        try {
            $requestData = $request->all();
            if ($requestData["action"] == "insert") {
                $return = $this->insertWebSiteElement($requestData, $request);
            } else if ($request["action"] == "update") {
                $return = $this->updateWebSiteElement($requestData, $request);
            } else if ($request["action"] == "disable") {
                $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
                $check->{WebSiteElements::UPDATED_BY} = Auth::user()->id; 
                $check->{WebSiteElements::STATUS} = 0;
                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            } else if ($request["action"] == "enable") {
                $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
                $check->{WebSiteElements::UPDATED_BY} = Auth::user()->id;
                $check->{WebSiteElements::STATUS} = 1;
                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            } else {
                $return = ["status" => false, "message" => "Invalid action", "data" => null];
            }
        } catch (Exception $exception) {
            $return = ["status" => false, "message" => "Exception occurred  : " . $exception->getMessage(), "data" => null];
        }
        return response()->json($return);
    }

    public function updateWebSiteElement($requestData, WebSiteElementRequest $request)
    {
        $check = WebSiteElements::where(WebSiteElements::ID, $requestData[WebSiteElements::ID])->first();
        if ($check) {
            if ($this->checkDuplicateElement($requestData[WebSiteElements::ELEMENT], $requestData[WebSiteElements::ID])) {
                $return = ["status" => false, "message" => "Element already found", "data" => null];
            } else {
                $check->{WebSiteElements::ELEMENT} = $requestData[WebSiteElements::ELEMENT];
                $check->{WebSiteElements::ELEMENT_TYPE} = $requestData[WebSiteElements::ELEMENT_TYPE];
              if ($requestData[WebSiteElements::ELEMENT_TYPE] == "Image" || $requestData[WebSiteElements::ELEMENT_TYPE] == "PDF") {

    // choose correct folder
    $folder = $requestData[WebSiteElements::ELEMENT_TYPE] == "PDF"
        ? "/website/uploads/WebsitePDF/"
        : "/website/uploads/WesiteElements/";

    // Use the new name element_details_file
    $fileUpload = $this->uploadLocalFile($request, "element_details_file", $folder);

    if ($fileUpload["status"]) {
        $check->{WebSiteElements::ELEMENT_DETAILS} = $fileUpload["data"];
    } else {
        return $fileUpload;
    }

} else {
    // TEXT
    $check->{WebSiteElements::ELEMENT_DETAILS} = $requestData["element_details_text"];
}

                $check->save();
                $this->forgetWebSiteElements();
                $return = ["status" => true, "message" => "Details updated", "data" => null];
            }
        } else {
            $return = ["status" => false, "message" => "Details not found", "data" => null];
        }
        return $return;
    }

    public function checkDuplicateElement($element, $existingId = null)
    {
        $check = WebSiteElements::where(WebSiteElements::ELEMENT, $element);
        if ($existingId) {
            $check->where(WebSiteElements::ID, "!=", $existingId);
        }
        return $check->exists();
    }
    public function insertWebSiteElement($requestData, WebSiteElementRequest $request)
    {
        $check = WebSiteElements::where([
            [WebSiteElements::ELEMENT, $requestData[WebSiteElements::ELEMENT]],
            [WebSiteElements::ELEMENT_TYPE, $requestData[WebSiteElements::ELEMENT_TYPE]]
        ])->first();
        if ($this->checkDuplicateElement($requestData[WebSiteElements::ELEMENT])) {
            $return = ["status" => false, "message" => "Element already found", "data" => null];
        } else {
            $check = new WebSiteElements();
            $check->{WebSiteElements::ELEMENT} = $requestData[WebSiteElements::ELEMENT];
            $check->{WebSiteElements::ELEMENT_TYPE} = $requestData[WebSiteElements::ELEMENT_TYPE];
            if ($requestData[WebSiteElements::ELEMENT_TYPE] == "Image" || $requestData[WebSiteElements::ELEMENT_TYPE] == "PDF") {

    // choose correct folder
    $folder = $requestData[WebSiteElements::ELEMENT_TYPE] == "PDF"
        ? "/website/uploads/WebsitePDF/"
        : "/website/uploads/WesiteElements/";

    // Use the new name element_details_file
    $fileUpload = $this->uploadLocalFile($request, "element_details_file", $folder);

    if ($fileUpload["status"]) {
        $check->{WebSiteElements::ELEMENT_DETAILS} = $fileUpload["data"];
    } else {
        return $fileUpload;
    }

} else {
    // TEXT
    $check->{WebSiteElements::ELEMENT_DETAILS} = $requestData["element_details_text"];
}

            $this->forgetWebSiteElements();
            $check->save();
            $return = ["status" => true, "message" => "Saved successfully.", "data" => null];
        }
        return $return;
    }


    public function getWebElementsData()
    {
        $data = WebSiteElements::select(
            WebSiteElements::ID,
            WebSiteElements::ELEMENT,
            WebSiteElements::ELEMENT_TYPE,
            WebSiteElements::ELEMENT_DETAILS,
            WebSiteElements::STATUS
        );

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a data-row="' . base64_encode(json_encode($row)) . '" href="javascript:void(0)" class="edit btn btn-primary btn-sm">Edit</a>';
                if ($row->{WebSiteElements::STATUS} == 1) {
                    $btn .= '<a href="javascript:void(0)" onclick="Disable(\''.$row->{WebSiteElements::ID}.'\')" class="btn btn-danger btn-sm">Disable</a>';
                } else {
                    $btn .= '<a href="javascript:void(0)" onclick="Enable(\''.$row->{WebSiteElements::ID}.'\')" class="btn btn-info btn-sm">Enable</a>';
                }
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}