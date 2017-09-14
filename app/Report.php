<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table = "reports";

    protected $fillable = ['building_id', 'body', 'page', 'title'];

    public function getRouteKeyName()
    {
        return 'id';
    }
}
