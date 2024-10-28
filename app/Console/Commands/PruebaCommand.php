<?php

namespace App\Console\Commands;

use App\Modelos\CORE\PX_SIS_PERSONA;
use Illuminate\Console\Command;

class PruebaCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'creamos un post en la base de datos';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $consulta = PX_SIS_PERSONA::where("Id",1)->first();
        PX_SIS_PERSONA::where("Id",1)->update(["IdEntidad" => $consulta->IdEntidad +1]);
    }
}
