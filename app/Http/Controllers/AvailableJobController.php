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

    public function getSavedJobs(Request $request)
    {
        $jobs = $request->user()->interests;
        return response([
            'message' => 'Jobs fetched successfully',
            'jobs' => $jobs
        ], 200);
    }

    public function removeJobs(Request $request)
    {
        $attribute = $request->validate([
            'job' => 'required|integer'
        ]);

        $request->user()->interests()->detach($attribute['job']);

        return response([
            'message' => 'Job Removed successfully',
            'jobs' => $request->user()->interests
        ], 200);
    }


    public function saveJobs(Request $request)
    {
        $attribute = $request->validate([
            'job' => 'required|integer'
        ]);

        $request->user()->interests()->syncWithoutDetaching($attribute['job']);

        return response([
            'message' => 'Jobs saved successfully',
        ], 200);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required', 'max:255'],
            'description' => ['required', 'string'],
            'about' => ['required', 'string'],
            'website' => ['required', 'string'],
            'email' => ['required', 'string'],
            'site' => ['required', 'string'],
            'duration' => ['required', 'string'],
            'amount' => ['required', 'string'],
            'company_id' => ['required', 'string']
        ]);

        $job = AvailableJob::create($attributes);

        return response([
            'job' => $job,
            'message' => 'Post successfully created'
        ], 201);
    }
}
