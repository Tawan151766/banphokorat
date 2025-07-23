<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItaEvaluation extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'ita_date',
    ];

    protected $casts = [
        'ita_date' => 'date',
    ];

    public function contents()
    {
        return $this->hasMany(ItaContent::class, 'evaluation_id');
    }
}