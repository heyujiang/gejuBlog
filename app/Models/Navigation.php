<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Navigation extends Model
{
    protected $table = 'navigations';
    protected $primaryKey = 'navigation_id';

    protected $guarded = [];

    const DEL_STATUS  = [
        self::DEL_STATUS_NO =>'未删除',
        self::DEL_STATUS_YES=>'正常'
    ];
    const DEL_STATUS_NO = 1;
    const DEL_STATUS_YES = 2;
}
