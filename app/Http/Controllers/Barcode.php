<?php

namespace App\Http\Controllers;

use App\Models\Bottle;
use Illuminate\Http\Request;

class Barcode extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add()
    {
        $bottles = Bottle::all();
        return view('add', ['bottles' => $bottles]);
    }

    public function create(Request $request)
    {
        $barcode = new \App\Models\Barcode;
        $barcode->barcode = $request->barcode;
        $barcode->bottle_id = $request->bottle;
        $barcode->save();

        return response()->json(['id' => $barcode->id]);
    }
}
