<?php

namespace App\Jobs;

use App\Modelos\CORE\PX_SIS_PERSONA;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class PruebaJob implements ShouldQueue
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
        $consulta = PX_SIS_PERSONA::where("Id",1)->first();
        PX_SIS_PERSONA::where("Id",1)->update(["IdEntidad" => $consulta->IdEntidad +1]);
    }
}
