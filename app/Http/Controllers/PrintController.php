<?php

namespace App\Http\Controllers;

use App\Services\PrintService;
use Illuminate\Http\Request;

class PrintController extends Controller
{

    protected $printService;

    public function __construct(PrintService $printService)
    {
        $this->middleware('auth');
        $this->printService = $printService;
    }

    public function printPage()
    {
        $barcodes = $this->printService->generateView();

        return view('print', ['barcodes' => $barcodes]);
    }

}
