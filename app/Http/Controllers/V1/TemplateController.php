<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TemplateController extends Controller
{

    public function index(Request $request)
    {
        return response()->json('hello');
    }
}
