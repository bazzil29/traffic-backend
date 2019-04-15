<?php

namespace App\Http\Controllers;

use App\Jobs\ReadFileUploaded;
use App\Jobs\TestLog;
use App\Repository\Business;
use App\Repository\History;
use App\Repository\Rectangles;
// Make by Toan
use App\Repository\CellsDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MobileController extends Controller
{
    //
    private $business;
    //
    function __construct()
    {
        $this->business = new Business();
    }
    //
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getCurrentRectangles(){
        $rectangles = $this->business->fetchRectangle();
        return response()->json($rectangles);
    }

    public function Login () {   
        return response()->json();
    }

    public function Register (Request $request){
        $res->success = $request;
        
        return response()->json($request);
    }
}
