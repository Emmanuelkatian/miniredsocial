<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
  public function getcountries(Request $request)
  {
    $country = [];

        if($request->has('q'))
            $search = $request->q;
            $country =Country::select("id", "name")
            		->where('name', 'LIKE', "%$search%")
            		->get();
        
        return response()->json($country);
  }
}
