<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use niklasravnsborg\LaravelPdf\Facades\Pdf;
//use niklasravnsborg\LaravelPdf\Pdf;
use App\Creation;

class ProcessPDF implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = [
            'title' => 'My creations',
            'creations' => Creation::orderBy('id')->get()
        ];

        $pdf = PDF::loadView('creations.creationsPDF', $data);
        $pdf->save('creations.pdf');
//        return $pdf->download('creations.pdf');
    }
}
