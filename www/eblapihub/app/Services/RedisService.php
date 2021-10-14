<?php

namespace App\Services;

use Illuminate\Support\Facades\Redis;

class RedisService
{

    public function __construct()
    {
    }

    /**
     * Connect Redis
     */
    public function connectRedis()
    {
        $redis = new \Predis\Client(array('host' => env('REDIS_HOST'), 'port' => env('REDIS_PORT')));
        $redis->auth(env('REDIS_PASSWORD'));
        return $redis;
    }

    /**
     * Disconnect redis
     */
    public function disconnectRedis()
    {
        Redis::close();
    }

    /**
     * send data to device for ack
     * 
     * @return response
     */
    public function publishRedis($key, $value)
    {
        $redisConn = $this->connectRedis();

        try {
            return $redisConn->publish($key, $value);
        } catch (\Throwable $th) {
            return $th;
        }
    }

    /**
     * Wait for response from device
     * 
     *  @return response
     */
    public function waitingForResponse($key, $lastInsertedId, $timeInSec = 600, $sleepTimeInSec = 1)
    {

        $time = 0;
        while ($time < $timeInSec) {
            $reply =  $this->getRedis($key);

            if ($reply) {
                list($reply_key, $reply_id, $reply_time, $reply_uuid) = explode(';;', $reply);

                if ($reply_id == $lastInsertedId) {
                    $this->disconnectRedis();
                    return true;
                }
            }
            $time++;
        }
    }

    /**
     * Get response from device
     * 
     * @return response
     */
    public function getRedis($key)
    {
        $redisConn = $this->connectRedis();
        return $redisConn->get($key);
    }

    // public function subRedis($key, $timeInSec = 60, $sleepTimeInSec = 1)
    // {
    //     $time = 0;
    //     $redisConn = $this->connectRedis();
    //     $reply = $redisConn->subscribe($key);

    //     while ($time < $timeInSec) {

    //         if ($reply) {
    //             return $reply;
    //         }
    //         sleep(1);

    //         $time++;
    //     }
    // }
}
