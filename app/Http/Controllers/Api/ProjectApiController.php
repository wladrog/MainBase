<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;

class ProjectApiController extends Controller
{
    public function index()
    {
        return response()->json(Project::all());
    }
}
