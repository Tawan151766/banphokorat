<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfResultsSection extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'section_name','date'];

    public function type()
    {
        return $this->belongsTo(PerfResultsType::class, 'type_id');
    }

    public function subTopics()
    {
        return $this->hasMany(PerfResultsSubTopic::class);
    }
}
