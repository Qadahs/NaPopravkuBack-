<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleTag extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table='article_tag';
    protected $fillable=[
        'articles_id',
        'tags_id'
    ];
    public function tag()
    {
        return $this->belongsTo(Tags::class,'tags_id','id');
    }
}
