<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function tags()
    {
       return  $this->hasMany(ArticleTag::class,'articles_id','id');
    }
}
