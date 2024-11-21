<?php

namespace App\Http\Controllers\Location;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function getProvinces()
    {
        $provinces = DB::table('provinces')->get();
        return response()->json($provinces);
    }

    public function getDistricts($provinceId)
    {
        $districts = DB::table('districts')->where('province_id', $provinceId)->get();
        return response()->json($districts);
    }

    public function getWards($districtId)
    {
        $wards = DB::table('wards')->where('district_id', $districtId)->get();
        return response()->json($wards);
    }
}
