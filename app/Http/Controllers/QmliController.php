<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Input;
use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;


class QmliController extends Controller
{
    //
    public function index(){
        return view('qmli_bot.index');
    }
    
    public function changeBatch(){
        $requestContent = [
            'headers' => [
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'gid' => 'BATCH 1',
                'token' => 'admin_qmli',
            ]
        ];
    
        try {
            $client = new GuzzleHttpClient();
    
            $apiRequest = $client->request('POST', 'https://www.qmlionline.com/api/fetch.php', $requestContent);
            // $apiRequest = $client->request('POST', 'http://localhost:8080/Project/wa_api.php', $requestContent);
            // $apiRequest = $client->request('GET', 'https://api.publicapis.org/entries');
    
            $response = json_decode((string) $apiRequest->getBody(), true);
    
            // dd($response[0]);
            return view('qmli_bot.index',compact(['response']));
        } catch (RequestException $re) {
              // For handling exception.
        }
    }
}
