<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostPdf extends Model
{
    use HasFactory;

    protected $fillable = ['post_detail_id', 'post_pdf_file'];

    public function postDetail()
    {
        return $this->belongsTo(PostDetail::class, 'post_detail_id');
    }
}
