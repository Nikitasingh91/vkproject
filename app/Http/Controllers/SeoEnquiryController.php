<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnquiryFormRequest;
use App\Models\SeoEnquiry;
use App\Traits\CommonFunctions;
use App\Traits\ResponseAPI;
use Exception;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SeoEnquiryController extends Controller
{
    use CommonFunctions;
    use ResponseAPI;

    public function enquiryDetails(EnquiryFormRequest $request)
{
    try {
        $newEnquiry = new SeoEnquiry();
        $newEnquiry->{SeoEnquiry::NAME} = $request->input(SeoEnquiry::NAME);
        $newEnquiry->{SeoEnquiry::PHONE_NUMBER} = $request->input(SeoEnquiry::PHONE_NUMBER);
        $newEnquiry->{SeoEnquiry::MESSAGE} = $request->input(SeoEnquiry::MESSAGE);
        $newEnquiry->{SeoEnquiry::IP_ADDRESS} = $request->ip();
        $newEnquiry->save();

        // $response = $this->success("Thank you for your message. We will contact you shortly.", []);
        return response()->json([
                    'status' => true,
                    'message' => "Thank you for your message. We will contact you shortly",
                ]);
    } catch (Exception $exception) {
        return response()->json([
                'status' => false,
                'message' => $exception->getMessage(),
            ]);    
    }

}

    public function enquiryAdminPage(){
        return view("Dashboard.Pages.enquiryAdmin");
    }

    public function enquiryDataTable(){
        
        $query = SeoEnquiry::select(
            SeoEnquiry::NAME,             
            SeoEnquiry::PHONE_NUMBER,
            SeoEnquiry::MESSAGE,
            SeoEnquiry::IP_ADDRESS,
            SeoEnquiry::ID,
            DB::raw('DATE_FORMAT(CONVERT_TZ('.SeoEnquiry::CREATED_AT.',"+00:00","+05:30"), "%W %M %e %Y %r") as created_at_formatted')
        );
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
