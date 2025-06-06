<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return response()->json([
            'tasks' => [
                ['id' => 1, 'name' => 'Task 1'],
                ['id' => 2, 'name' => 'Task 2'],
            ]
        ]);
    }
}
