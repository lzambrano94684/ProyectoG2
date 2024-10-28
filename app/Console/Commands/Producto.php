<?php

namespace App\Console\Commands;

use App\Mail\MessageReceived;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Producto extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producto:porVencer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'El producto esta por vencer';

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
        /*try{
            $mail = Mail::to("hugo.hernandez@exeltis.com")->send(new MessageReceived);
        }catch (\Exception $exception){
            $mail= $exception->getMessage();
        }

        Log::info("mensage enviado hahaha");*/
    }
}
