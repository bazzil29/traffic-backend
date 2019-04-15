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


class MarkerController extends Controller
{
    private $business;

    /**
     * MarkerController constructor.
     */
    function __construct()
    {
        $this->business = new Business();
    }

    /**
     *add new data then recalculate the map
     */
    function recalculateMap()
    {
        $this->business->addNewData(1, 15.5, 1, 3);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function postUpload(Request $request)
    {
        if ($request->hasFile('fileCSV')) {
            $files = $request->file('fileCSV');
            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                //check out the edit content on bottom of my answer for details on $storage
                $path = public_path() . "\\uploads\\";
                // Moves file to folder on server
                $file->move($path, $name);
                //Make new queue for Reading the Fle Upload
                $job = new ReadFileUploaded($path, $name);
                $job->handle();
                dispatch($job);
                $job->delete();
            }
            return view('admin.pages.current');
        } else {
            return view('admin.pages.upload');
        }
    }

    /**
     * show upload file form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showUploadForm()
    {
        return view('admin.pages.upload');
    }

    /**
     * calculate data for frontend
     * @param string $start_time
     * @return $this
     */
    public function showColorXML($start_time = '')
    {
        // Future make by Toan
        if ($start_time == '') {
            $rectangles = $this->business->fetchRectangle();
        } elseif (substr($start_time,0,6) == 'future') {
            $rectangles = $this->business->calculateFuture($start_time);
        } else {
            $rectangles = $this->business->readHistory($start_time);
        }
        return response()->view('admin.pages.color', compact('rectangles', 'start_time'))->header('Content-Type',
            'text/xml');
    }

    /**
     * calculate data for frontend
     * @param string $start_time
     * @return $this
     */
    public function showColorJson($start_time = '')
    {
        if ($start_time == '') {
            $rectangles = $this->business->fetchRectangle();
        } elseif ($start_time == 'future') {
            $rectangles = $this->business->calculateFuture();
        } else {
            $rectangles = $this->business->readHistory($start_time);
        }
        return response()->json('admin.pages.color', compact('rectangles', 'start_time'));
    }

    public function reset()
    {
        // Modified by Toan Rectangles => CellsDetail
        // Modified by Toan Add where end_time
        CellsDetail::where('id', '>', 0)->where('end_time', '>=', Carbon::now()->subMinute(30))->update([
            'avg_speed' => 0,
            'marker_count' => 0,
            'color' => '#808080',
        ]);
        // Modified by Toan
//      $this->business->resetColors();
        return response()->view('admin.pages.current');
    }

    public function overwrite(Request $request)
    {
        // Make by Toan
        CellsDetail::where('id', '>', 0)->where('end_time', '>=', Carbon::now()->subMinute(30))->where('height', '=', $request->whereX)->where('width', '=',$request->whereY)->update([
            'color' => $request->color,
        ]);
        // Make by Toan
        // $this->business->overwriteRectangle($request->whereX, $request->whereY, $request->color);
    }

    public function showHistory($start_time = '')
    {
        // Make by Toan
        $grid = $this->business->getGrid();
        return view('admin.pages.history', compact('start_time','grid'));
        // Make by Toan

        // return view('admin.pages.history', compact('start_time');
    }

    public function showCurrent()
    {
        // Make by Toan
        $grid = $this->business->getGrid();
        return view('admin.pages.current',compact('grid'));
        // Make by Toan

        // return view('admin.pages.current');
    }

    public function showFuture()
    {
        // Make by Toan
        $grid = $this->business->getGrid();
        return view('admin.pages.future', compact('grid'));
        // Make by Toan
        // return view('admin.pages.future');
    }

    public function saveToHistory()
    {
        $now = Carbon::now()->subMinutes(30);
        $rectangles = Rectangles::select('color')->get();
        $result = '';
        foreach ($rectangles as $rectangle) {
            $result .= $this->business->getLevelFromColor($rectangle->color);
        }
        $id = History::select('id')->where('end_time', '>', Carbon::now()->toDateTimeString())->first();
        if (!isset($id)) {
            History::insert(
                [
                    'start_time' => $now->toDateTimeString(),
                    'end_time' => $now->addMinutes(30)->toDateTimeString(),
                    'colors' => $result
                ]
            );
            Rectangles::where('id', '>', 0)->update([
                'avg_speed' => 0,
                'marker_count' => 0,
                'color' => '#808080',
                'overwrite_user' => null
            ]);
            return view('admin.pages.current');
        } else {
            return view('admin.pages.current')->withErrors('Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function index()
    {
        return redirect('current');
    }
}
