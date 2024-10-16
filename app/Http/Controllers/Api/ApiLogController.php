<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Models\ApiLogs;
use Illuminate\Routing\Route;

class ApiLogController extends Controller {
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function get() {
        $ApiLogs = ApiLogs::orderBy('id', 'desc')->paginate(100);
        return ['status' => "true", 'data' => $ApiLogs, 'message' => "Order time should be 30 minutes ahead of now."];
    }

}
