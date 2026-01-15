<?php
namespace App\Http\Controllers;

use App\Http\Requests\VerticalRequest;
use App\Models\Vertical;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use App\Traits\CommonFunctions;

class VerticalController extends Controller
{
    use CommonFunctions;

    public function manageVerticals() {
        return view("Dashboard.Pages.manageVerticals");
    }

    public function verticalsData()
    {
        try {
            $query = Vertical::select(
                'id',
                'vertical_name',
                'vertical_image',
                'differentiators',
                'status'
            );

            return DataTables::of($query)
                ->addIndexColumn()

                // Show image preview - FIXED PATH
                ->addColumn('vertical_image_view', function ($row) {
                    $img = $row->vertical_image 
                        ? asset($row->vertical_image)  // Changed from asset('storage/' . $row->vertical_image)
                        : asset('no-image.png');

                    return '<img src="' . $img . '" class="img-thumbnail" width="70">';
                })

                // Show differentiators as list
                ->addColumn('differentiators_view', function ($row) {
                    $list = json_decode($row->differentiators ?? "[]", true);
                    if (!$list || !is_array($list)) return "<i>No differentiators</i>";
                    return implode("<br>", array_filter($list)); // Added array_filter to remove empty values
                })

                // Action buttons
                ->addColumn('action', function ($row) {
                    $btn_edit = '<a data-row="' . base64_encode(json_encode($row)) . '" 
                                    href="javascript:void(0)" 
                                    class="edit btn btn-primary btn-sm">
                                    Edit
                                 </a>';

                    $btn_disable = ' <a href="javascript:void(0)" 
                                    onclick="Disable(' . $row->id . ')" 
                                    class="btn btn-danger btn-sm">
                                    Disable
                                 </a>';

                    $btn_enable = ' <a href="javascript:void(0)" 
                                    onclick="Enable(' . $row->id . ')" 
                                    class="btn btn-success btn-sm">
                                    Enable
                                 </a>';

                    return ($row->status == 0) ? $btn_edit . $btn_enable : $btn_edit . $btn_disable;
                })

                ->rawColumns([
                    'vertical_image_view',
                    'differentiators_view',
                    'action'
                ])

                ->make(true);

        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function saveVertical(VerticalRequest $request) {
        try {
            switch ($request->action) {
                case "insert": 
                    return $this->insertVertical($request);
                case "update": 
                    return $this->updateVertical($request);
                case "enable":
                case "disable": 
                    return $this->enableDisableVertical($request);
                default:
                    return ["status" => false, "message" => "Invalid action"];
            }
        } catch (Exception $e) {
            return ["status" => false, "message" => $e->getMessage()];
        }
    }

    public function insertVertical($request) {
        $vertical = new Vertical();

        if ($request->hasFile("vertical_image")) {
            $upload = $this->verticalImageUpload($request);

            if ($upload["status"]) {
                $vertical->vertical_image = $upload["data"];
            } else {
                return $upload; // return error
            }
        }

        $vertical->vertical_name = $request->vertical_name;
        
        // Filter out empty differentiators
        $differentiators = array_filter($request->differentiators ?? []);
        $vertical->differentiators = json_encode(array_values($differentiators));
        
        $vertical->status = 1;
        $vertical->created_by = Auth::id();

        $vertical->save();

        return ["status" => true, "message" => "Vertical saved successfully"];
    }

    public function verticalImageUpload($request){
        // Generate unique filename
        $maxId = Vertical::max('id') ?? 0;
        $maxId += 1;

        $timeNow = strtotime(now());
        $maxId .= "_$timeNow";

        return $this->uploadLocalFile($request, "vertical_image", "/website/uploads/verticals/", "vertical_$maxId");
    }

    public function updateVertical($request) {
        $vertical = Vertical::find($request->id);

        if (!$vertical) {
            return ["status" => false, "message" => "Vertical not found"];
        }

        if ($request->hasFile("vertical_image")) {
            $upload = $this->verticalImageUpload($request);

            if ($upload["status"]) {
                // Delete old image if exists
                if ($vertical->vertical_image && file_exists(public_path($vertical->vertical_image))) {
                    unlink(public_path($vertical->vertical_image));
                }
                
                $vertical->vertical_image = $upload["data"];
            } else {
                return $upload; // return error
            }
        }

        $vertical->vertical_name = $request->vertical_name;
        
        // Filter out empty differentiators
        $differentiators = array_filter($request->differentiators ?? []);
        $vertical->differentiators = json_encode(array_values($differentiators));
        
        $vertical->updated_by = Auth::id();

        $vertical->save();

        return ["status" => true, "message" => "Updated successfully"];
    }
   
    public function enableDisableVertical($request) {
        $vertical = Vertical::find($request->id);
        
        if (!$vertical) {
            return ["status" => false, "message" => "Vertical not found"];
        }
        
        $vertical->status = $request->action == "enable" ? 1 : 0;
        $vertical->save();

        return ["status" => true, "message" => ucfirst($request->action) . "d successfully"];
    }
}