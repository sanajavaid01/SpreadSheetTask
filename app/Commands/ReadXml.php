<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Facades\Log;
use App\Interfaces\DataManagement;

class ReadXml extends Command
{
    
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'read:xml {url : Specify url of xml file}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Reading XML File';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(DataManagement $data)
    {
          //reading xml file from url 
            $xml=simplexml_load_file($this->argument('url'),'SimpleXMLElement', LIBXML_NOCDATA);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
          
            Log::info('XML file with this url:'.$this->argument('url').' read sucessfully.');
            if($data->pushdata($array['item']))
            {
                Log::info('XML file with this url:'.$this->argument('url').' uploaded to google sheets  sucessfully.');
                return true;

            }
            else{
                 Log::info('Error while updating google sheets');
                return false;

            } 
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
