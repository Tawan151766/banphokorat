<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfResultsSubTopic extends Model
{
    use HasFactory;

    protected $fillable = ['section_id', 'topic_name','date'];

    public function section()
    {
        return $this->belongsTo(PerfResultsSection::class, 'section_id');
    }

    public function files()
    {
        return $this->hasMany(PerfResultsFile::class);
    }
}
