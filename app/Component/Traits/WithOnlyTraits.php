<?php
/**
 * Created by PhpStorm.
 * User: my
 * Date: 2018/10/13
 * Time: 14:47
 */

namespace App\Component\Traits;


trait WithOnlyTraits
{
    public function scopeWithOnly($query, $relation, Array $columns)
    {
        return $query->with([$relation => function ($query) use ($columns){
            $query->select($columns);
        }]);
    }
}