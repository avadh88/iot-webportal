<?php
namespace App\Services;

use Illuminate\Redis\Connections\PredisConnection;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Stmt\TryCatch;

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
        
        
        try {
        //code...
            // file_put_contents('redis',$key."=".$value);
            return $redisConn->publish($key, $value);
        } catch (\Throwable $th) {
        //throw $th;
            return $th;
        }
        
        return $redisConn->publish($key, $value);
    }

    public function waitingForResponse( $key, $lastInsertedId, $timeInSec = 60, $sleepTimeInSec = 1 ){
        
        $time = 0;
        while($time < $timeInSec){
            $reply =  $this->getRedis($key);

            if($reply){

                list($reply_key, $reply_id, $reply_time, $reply_uuid) = explode(';;', $reply);
            
                if($reply_id == $lastInsertedId){
                    file_put_contents('redis',$reply_id."=".$lastInsertedId);
                break;
                }
            }

            $time++;
        }
    }

    public function getRedis($key){
        $redisConn = $this->connectRedis();
        return $redisConn->get($key);
        // if($reply){
            // return true;
        // }else{
            // return false;
        // }
    }
}


?>