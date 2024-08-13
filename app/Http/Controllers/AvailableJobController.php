<?php

namespace App\Http\Controllers;

use App\Models\AvailableJob;
use Illuminate\Http\Request;

class AvailableJobController extends Controller
{
    public function index()
    {
        $jobs = AvailableJob::all();
        return response([
            'jobs' => $jobs
        ]);
    }
}
