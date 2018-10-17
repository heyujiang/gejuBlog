<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/22
 * Time: 12:07
 */

namespace App\Http\Controllers\Index;


use App\Http\Controllers\Controller;
use App\Jobs\DedayJob;
use App\Jobs\TestJobs;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    protected $queueName = 'Text:SortedSort:One';

    public function index()
    {
        $this->addRedayQueue();
        TestJobs::dispatch($this->queueName);
    }


    //
    public function addRedayQueue(){

        for($i = 0;$i < 5;$i++){
            $a = rand(0,60);
            echo $a ,"\n:\n";
            $a = time() + $a;
            Redis::zAdd($this->queueName,$a,$a.'queue');
            echo $a ,";\n";
        }
    }

    public function deday(){
        echo Carbon::now();
        DedayJob::dispatch(Carbon::now())->delay(Carbon::now()->addMinutes(20));
    }


    public function status(Request $request){
        $data = $request->all();
        dd(camel_case('ppppp_ydsfasfas'));
        dd($data);
    }

}
