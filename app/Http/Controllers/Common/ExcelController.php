<?php

namespace App\Http\Controllers\Common;

use App\Services\Common\ExcelService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExcelController extends Controller
{
    protected $excelService;

    public function __construct(ExcelService $excelService)
    {
        $this->excelService = $excelService;
    }

    public function download(Request $request)
    {
        return $this->excelService->download($request);
    }

}
