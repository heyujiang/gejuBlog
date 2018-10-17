<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/9/22
 * Time: 12:03
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $table = 'queues';
    protected $primaryKey = 'id';
    protected $guarded = [];
}