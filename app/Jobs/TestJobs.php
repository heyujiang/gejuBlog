<?php

namespace App\Jobs;

use App\Models\Queue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Redis;

class TestJobs implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $key ;

    /**
     *
     *
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($key)
    {
        $this->key = $key;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        sleep(10);

        $queues = Redis::zRange($this->key,0,-1);
        foreach ($queues as $queue){
            $time = Redis::zScore($this->key,$queue);

            if(time()>$time){
                echo $time , '\n';

                $data['queue_id'] = $time;
                $data['queue_value'] = $queue;

                if(Queue::query()->insert($data)){
                    echo 'success';
                    Redis::zRem($this->key,$queue);
                }else{
                    echo 'failed';
                }
            }else{
                break;
            }
        }

        if(Redis::zCard($this->key)){
            self::dispatch($this->key);
        }

    }
}
