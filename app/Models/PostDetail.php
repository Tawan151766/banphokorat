<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetail extends Model
{
    use HasFactory;

    protected $fillable = ['post_type_id', 'date', 'title_name', 'topic_name', 'details'];

    public function postType()
    {
        return $this->belongsTo(PostType::class, 'post_type_id');
    }

    public function photos()
    {
        return $this->hasMany(PostPhoto::class, 'post_detail_id');
    }

    public function pdfs()
    {
        return $this->hasMany(PostPdf::class, 'post_detail_id');
    }

    public function videos()
    {
        return $this->hasMany(PostVideo::class, 'post_detail_id');
    }
}
