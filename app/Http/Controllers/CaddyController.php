<?php
# app/Http/Controllers/CaddyController.php

namespace App\Http\Controllers;

# use App\Store;
use Illuminate\Http\Request;

class CaddyController extends Controller
{
    /**
     *  Checks the current domain during SSL connection establishment
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response|void
     */
    public function check(Request $request)
    {
        $authorizedDomains = [
            'localhost',
            // Add subdomains here
        ];

        if (in_array($request->query('domain'), $authorizedDomains)) {
            return response('Domain Authorized');
        }

        // Abort if there's no 200 response returned above
        abort(503);
    }
}
