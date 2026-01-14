<?php

namespace App\Http\Controllers;
use App\Http\Requests\SubscriptionRequest;
use Illuminate\Http\Request;
use App\Models\Subscribe;
use App\Traits\CommonFunctions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Facades\DataTables;

class SubscribeController extends Controller
{
    public function save(SubscriptionRequest $request)
    {
        Subscribe::create([
            'email'=> $request->email,
            'ip_address' => $request->ip(),
        ]);
        return response()->json([
            'status' => true,
            'message' => "Thank you for Subscribing Us",
        ]);

    }

    public function getSubscribe()
    {
        return view("Dashboard.Pages.manageSubscriber");
    }

    public function subscribeData()
    {
        $query = Subscribe::select(
            'email','ip_address','id'
        );
        return DataTables::of($query)
            ->addIndexColumn()
            ->make(true);
    }
}
