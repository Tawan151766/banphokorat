<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['post_detail_id', 'post_photo_file', 'post_photo_status'];

    public function postDetail()
    {
        return $this->belongsTo(PostDetail::class, 'post_detail_id');
    }
}
