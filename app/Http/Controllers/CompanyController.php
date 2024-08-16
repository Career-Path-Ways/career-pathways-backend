<?php

namespace App\Http\Controllers;

use App\Models\company as CompanyModel;
use Faker\Provider\ar_EG\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['string', 'required'],
            'logo' => ['required', 'image', 'max:2048'],
            'location' => ['string', 'required'],
            'phone' => ['string', 'required'],
        ]);

        $logo = $this->saveImage($request->logo, 'CompanyLogo');
        $attributes['logo'] = $logo;
        $company = CompanyModel::create($attributes);

        return response([
            'company' => $company,
            'message' => 'Company creaated successfully'
        ], 200);
    }
}
