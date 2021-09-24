<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserArticle extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='user_article';
    public function user()
    {
        return $this->belongsTo(User::class,'users_id','id');
    }
    public function article()
    {
        return $this->belongsTo(Articles::class,'articles_id','id');
    }
}
