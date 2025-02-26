<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'checklist_id', 'status'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
