<?php

namespace App\Http\Controllers\API;

use App\Site;
use App\Visit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;

class VisitsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->input('token');
        $site = Site::where('token', $token)->first();
        if ($token && $site) {
            $values = [
                'site_id' => $site->id,
                'visitor' => $request->input('visitor'),
                'url' => $request->input('url'),
                'browser' => $request->input('browser'),
                'ip' => $request->getClientIp(),
                'datetime' => Date::now(),
            ];
            $visit = Visit::create($values);
            if ($visit) {
                return response('', 201);
            }
        }
        return response()->json(['error' => 'Client not found'], 404);
    }
}
