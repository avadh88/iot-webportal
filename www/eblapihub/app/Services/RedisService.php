<?php
namespace App\Services;

use Illuminate\Redis\Connections\PredisConnection;
use Illuminate\Support\Facades\Redis;

class RedisService{

    public function __construct()
    {
        
    }

    public function connectRedis(){
        $redis = new \Predis\Client(array('host' => env('REDIS_HOST'), 'port' => env('REDIS_PORT')));
        $redis->auth(env('REDIS_PASSWORD'));
        return $redis;
    }

    public function disconnectRedis(){
        Redis::close();
    }

    public function publishRedis($key, $value){
        $redisConn = $this->connectRedis();
        return $redisConn->publish($key, $value);
    }

    public function waitingForResponse( $key, $timeInSec = 60, $sleepTimeInSec = 1 ){
        
        $time = 0;
        while($time < $timeInSec){
            if($this->getRedis($key)){
                exit;
            }

            $time++;
        }
    }

    public function getRedis($key){
        $redisConn = $this->connectRedis();
        $reply = $redisConn->get($key);
        if($reply){
            return true;
        }else{
            return false;
        }
    }
}


?>