<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    public function manageClients()
    {
        return view('Dashboard.Pages.manageClients');
    }

    public function clientsDataTable(Request $request)
    {
        if ($request->ajax()) {
            $data = Client::select(['id', 'image', 'status', 'sorting']);

            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    $encoded = base64_encode(json_encode($row));
                    return '
                        <button class="btn btn-sm btn-primary edit" data-row="'.$encoded.'">Edit</button>
                        <button class="btn btn-sm btn-danger" onclick="deleteClient('.$row->id.')">Delete</button>
                    ';
                })
                ->editColumn('image', function ($row) {
                    return $row->image 
                        ? '<img src="'.asset($row->image).'" class="img-thumbnail" width="80">'
                        : '';
                })
                ->editColumn('status', function ($row) {
                    return $row->status ? 'Active' : 'Inactive';
                })
                ->rawColumns(['image', 'action'])
                ->make(true);
        }
    }

    public function addClient(Request $request)
    {
        try {
            $action = $request->input('action');

            if ($action === 'insert' || $action === 'update') {
                $validated = $request->validate([
                    'status'  => 'required|boolean',
                    'sorting' => 'nullable|integer',
                    'image'   => $action === 'insert' ? 'required|image|mimes:jpg,jpeg,png|max:2048' : 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                ]);

                // Handle image upload
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('uploads/clients', 'public');
                    $validated['image'] = 'storage/' . $imagePath;
                }

                if ($action === 'insert') {
                    Client::create($validated);
                    return response()->json(['status' => true, 'message' => 'Client added successfully!']);
                }

                if ($action === 'update' && $request->id) {
                    $client = Client::findOrFail($request->id);
                    $client->update($validated);
                    return response()->json(['status' => true, 'message' => 'Client updated successfully!']);
                }
            }

            if ($action === 'delete' && $request->id) {
                Client::where('id', $request->id)->delete();
                return response()->json(['status' => true, 'message' => 'Client deleted successfully!']);
            }

            return response()->json(['status' => false, 'message' => 'Invalid request.']);
        } catch (Exception $exception) {
            report($exception);
            return response()->json(['status' => false, 'message' => 'Something went wrong.']);
        }
    }
}
