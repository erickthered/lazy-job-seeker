<?php

namespace App\Http\Controllers;

use App\Adapter\Search\Jobs;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiController extends Controller
{
    private $client = null;

    private function calculateMatch($required, $current)
    {
        $requiredNames = array_map(function($i) {  return $i->name; }, $required);
        $currentNames = array_map(function($i) { return $i->name; }, $current);
        return round(count(array_intersect($requiredNames, $currentNames))/count($required) * 100, 2);
    }

    public function jobs(Request $request)
    {
        $client = $this->getHttpClient();
        $success = false;
        try {
            $json = Jobs::adapt($request);
            $size = (int)$request->get('size', 10);
            $offset = (int)$request->get('offset', 0);
            $data = $client->post('https://search.torre.co/opportunities/_search?size='.$size.'&offset='.$offset, [
                'content-type' => 'application/json',
                'json' =>  $json
            ]);
            $data = json_decode($data->getBody()->getContents());
            foreach ($data->results as &$result) {
                $result->match = $this->calculateMatch(
                    $result->skills,
                    Cache::get('currentSkills')
                );
            }
            $success = true;
        } catch (\Exception $e) {
            $data = $e->getMessage();
        }

        return [
            'success' => $success,
            'data' => $data
        ];
    }

    public function job(Request $request, string $id)
    {
        $client = $this->getHttpClient();
        $success = false;
        try {
            $data = $client->get('https://torre.co/api/opportunities/' . $id);
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

    public function people(Request $request)
    {
        $client = $this->getHttpClient();
        $success = false;
        try {
            error_log($request->getBody());
            $data = $client->post('https://search.torre.co/people/_search', [
                ['body' =>  $request->getBody()]
            ]);
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

    public function user(Request $request, string $username)
    {
        $client = $this->getHttpClient();
        $url = 'https://torre.bio/api/bios/' . $username;
        $success = false;
        try {
            $data = $client->get($url);
            $data = json_decode($data->getBody()->getContents());
            Cache::put('currentSkills', $data->strengths);
            $success = true;
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
