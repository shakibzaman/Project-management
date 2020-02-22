<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectAmountReceive extends Model
{
    public function projectName()
    {
        return $this->belongsTo('App\Project','pro_id');
    }
    public function userName()
    {
        return $this->belongsTo('App\User','paid_by');
    }
    public function contractor()
    {
        return $this->belongsTo('App\Contracter','paid_by');
    }
}
