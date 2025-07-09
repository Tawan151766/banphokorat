<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerfResultsFile extends Model
{
    use HasFactory;

    protected $fillable = ['sub_topic_id', 'files_path', 'files_type'];

    public function subTopic()
    {
        return $this->belongsTo(PerfResultsSubTopic::class);
    }
}
