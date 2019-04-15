<?php

namespace App\Jobs;

use App\Repository\Business;
use App\Repository\Rectangles;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ReadFileUploaded implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $path;
    protected $business;
    protected $name;
    
    public function __construct($path, $name)
    {
        $this->path = $path;
        $this->name = $name;
        $this->business = new Business();
    }
    
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $fileCSV = fopen($this->path . $this->name, 'r');
        // Import the moved file to DB and return OK if there were rows affected
        while (!feof($fileCSV)) {
            $row = fgetcsv($fileCSV);
            if ($row == "") {
                break;
            }
//            $this->insertMarker($row);
            $position = $this->business->findRectangleInclude($row[ 0 ], $row[ 1 ]);
            $this->business->addNewData($position[ 'whereX' ], $position[ 'whereY' ], $row[ 2 ], 1);
        }
    }
}
