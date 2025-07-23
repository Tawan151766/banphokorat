<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItaContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'url',
        'description',
        'evaluation_id',
    ];

    public function evaluation()
    {
        return $this->belongsTo(ItaEvaluation::class, 'evaluation_id');
    }
}