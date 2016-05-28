<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Artisan;

class installer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mulai:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Memulai Instalasi Aplikasi';

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
            $this->comment('Memulai instalasi Aplikasi');
            // Cek apakah sudah ada App Key pada file .env
            if (! env('APP_KEY'))
            {
              //Jika belum ada APP_KEY, maka akan melakukan generate KEY baru.
              $this->info('Key Belum dibuat, Akan melakukan generate key baru');
              //Memanggil perintah Artisan key:generate
              Artisan::call('key:generate');
              $this->info('Key baru berhasil dibuat');
            } else
            {
              $this->comment('APP_KEY sudah ada, melanjutkan');
            }

            $this->info('Memulai Migrasi Database');
            //Melakukan migrasi database
            Artisan::call('migrate');
            //Informasi jika database berhasil di migrasi
            $this->comment('Database telah berhasil di migrasi');
            //Setup selesai
            $this->info('Aplikasi berhasil di setup');
    }
}
