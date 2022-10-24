<?php
 
namespace App\Implementations;

use Illuminate\Support\Facades\Log;
use App\Interfaces\DataManagement;
 
class GoogleSheetApi implements DataManagement
{
    public function pushdata($data): bool
    {
        // configure the Google Client
        $client = new \Google_Client();
        $client->setApplicationName('Google Sheets API');
        $client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
        $client->setAccessType('offline');
        // // get datA FROM credentials.json is the key file we downloaded while setting up our Google Sheets API
        $path = storage_path('credentials.json');
       
        $client->setAuthConfig($path);

        // // configure the Sheets Service
        $service = new \Google_Service_Sheets($client);

        $spreadsheetId = env('SPREADSHEET_ID'); //It is present in your URL

        $spreadsheet = $service->spreadsheets->get($spreadsheetId);

        // get all the rows of a sheet
        $range = env('SHEET_RANGE'); // here we use the name of the Sheet to get or set all the rows
        $final_array=array();
        $key_array=array();
         foreach($data[0] as $key=>$val)
         {
            array_push($key_array,$key);
         }
         array_push($final_array,$key_array);
         

        foreach($data as $a)
        {
            $a1=array();
            foreach($a as $key=>$val)
            {
                if(is_array($val) && count($val)==0)
                {
                    $val="";
                }
                array_push($a1,$val);
                
            }
              array_push($final_array,$a1);
        }
        $rows = $final_array ; // you can append several rows at once
        $valueRange = new \Google_Service_Sheets_ValueRange();
        $valueRange->setValues($rows);
        $options = ['valueInputOption' => 'USER_ENTERED'];
        $reponse=$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $options);
        if($reponse)
        {
            Log::info('Data in google sheets updated  sucessfully.');
            return true;

        }
         Log::info('Unable to append data on google sheets.');
        return false;
         // File uploaded
    }
 
    
}
