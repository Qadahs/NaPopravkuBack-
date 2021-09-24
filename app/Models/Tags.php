<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    use HasFactory;
    protected $fillable=['title'];
    public $timestamps = false;
    public function article()
    {
        $this->belongsTo(Articles::class,'id','articles_id');
    }
}
