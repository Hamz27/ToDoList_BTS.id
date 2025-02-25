<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }

}
