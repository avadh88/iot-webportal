<?php

namespace App\Http\Controllers\Ebl;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    /**
     * Api Request 
     *
     * @param string $method
     * @param string $url
     * @param string|array $data
     * 
     * @return array
     */
    public function getGuzzleRequest($method, $url, $data = "")
    {

        $apiUrl    = env('API_URL');
        $client    = new \GuzzleHttp\Client();
        $callUrl   = $apiUrl . $url;
        $datas     = json_encode($data);

        try {
            if ($method == 'get' || $method == 'GET') {
                $response = $client->request(
                    $method,
                    $callUrl,
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $data
                        ],
                        'body' => $datas
                    ]
                );
            } else if ($method == 'post' || $method == "POST") {
                $response = $client->request(
                    $method,
                    $callUrl,
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $data['token']
                        ],
                        'body' => $datas
                    ]
                );
            }
        } catch (ClientException $e) {

            $response = $e->getResponse();
        }

        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_URL,$callUrl);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$datas);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $server_output = curl_exec($ch);
        // curl_close ($ch);


        $res['status'] = $response->getStatusCode();
        $res['data']   = $response->getBody()->getContents();
        return $res;
    }

    /**
     * Api Request with Image
     *
     * @param string $method
     * @param string $url
     * @param string|array $data
     * 
     * @return array
     */
    public function fileWithDataGuzzleRequest($method, $url, $imageName, $data = "")
    {
        $apiUrl    = env('API_URL');
        $client    = new \GuzzleHttp\Client();
        $callUrl   = $apiUrl . $url;
        $datas     = json_encode($data);

        try {
            if ($method == 'post' || $method == "POST") {
                $response = $client->request(
                    $method,
                    $callUrl,
                    [
                        'headers' => [
                            'Accept' => 'application/json',
                            'Authorization' => 'Bearer ' . $data['token']
                        ],
                        'multipart' => [
                            [

                                'name'      => $imageName,
                                'filename'  => $data['file_uploaded_name'],
                                'Mime-Type' => $data['file_mime'],
                                'contents'  => fopen($data['file_path'], 'r'),
                            ],
                            [
                                'name' => 'form_data',
                                'contents' => $datas
                            ],
                        ],
                    ]
                );
            }
        } catch (ClientException $e) {

            $response = $e->getResponse();
        }

        $res['status'] = $response->getStatusCode();
        $res['data']   = $response->getBody()->getContents();
        return $res;
    }
}
