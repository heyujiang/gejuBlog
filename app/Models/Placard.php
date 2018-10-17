<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Placard extends Model
{
    protected $table = 'placards';
    protected $primaryKey = 'placard_id';
    protected $guarded = [];

    const SHOW_STATUS_YES = 1;
    const SHOW_STATUS_NO = 2;

    const SHOW_STATUS =[
      self::SHOW_STATUS_YES => '已展示',
      self::SHOW_STATUS_NO  => '不展示'
    ];

    const DELETE_STATUS_NO = 1;
    const DELETE_STATUS_YES = 2;

    const DELETE_STATUS = [
        self::DELETE_STATUS_NO => '正常',
        self::DELETE_STATUS_YES => '已删除'
    ];
}
