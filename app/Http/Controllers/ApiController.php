<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    private $client = null;

    public function jobs()
    {
    }

    public function job()
    {
    }

    public function people()
    {
    }

    public function user(Request $request, $username)
    {
        $client = $this->getHttpClient();
        $url = 'https://torre.bio/api/bios/'.$username;
        $success = false;
        try {
            $data = $client->get($url);
            $success = true;
            $data = json_decode($data->getBody()->getContents());
        } catch (\Exception $e) {
            $data = null;
        }

        return [
            'success' => $success,
            'data' => $data
        ];
    }

    private function getHttpClient()
    {
        if ($this->client === null) {
            $this->client = new HttpClient();
        }

        return $this->client;
    }
}
