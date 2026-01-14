<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TestimonialController extends Controller
{
    /**
     * Show testimonials management page
     */
    public function manageTestimonials()
    {
        try {
            return view("Dashboard.Pages.testimonials");
        } catch (Exception $exception) {
            report($exception);
            abort(500, 'Something went wrong while loading the testimonials page.');
        }
    }

    /**
     * DataTable server-side processing
     */
    public function testimonialsDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::select(['id', 'name', 'company_name', 'message', 'status', 'sorting']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $encoded = base64_encode(json_encode($row));
                    return '
                        <button class="btn btn-sm btn-primary edit" data-row="'.$encoded.'">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteTestimonial('.$row->id.')">Delete</button>
                    ';
                })
                ->editColumn('status', function ($row) {
                    return $row->status ? 'Active' : 'Inactive';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Add / Update / Delete testimonials
     */
    public function addTestimonial(Request $request)
    {
        try {
            $action = $request->input('action');

            if ($action === 'insert' || $action === 'update') {
                $validated = $request->validate([
                    'name'         => 'required|string|max:255',
                    'company_name' => 'nullable|string|max:255',
                    'message'      => 'required|string|max:1000',
                    'status'       => 'required|boolean',
                    'sorting'      => 'nullable|integer',
                ]);

                if ($action === 'insert') {
                    Testimonial::create($validated);
                    return response()->json(['status' => true, 'message' => 'Testimonial added successfully!']);
                }

                if ($action === 'update' && $request->id) {
                    Testimonial::where('id', $request->id)->update($validated);
                    return response()->json(['status' => true, 'message' => 'Testimonial updated successfully!']);
                }
            }

            if ($action === 'delete' && $request->id) {
                Testimonial::where('id', $request->id)->delete();
                return response()->json(['status' => true, 'message' => 'Testimonial deleted successfully!']);
            }

            return response()->json(['status' => false, 'message' => 'Invalid request.']);
        } catch (Exception $exception) {
            report($exception);
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }
}
