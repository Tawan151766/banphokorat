<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawsRegsFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'files_path',
        'files_type'

    ];

    public function section()
    {
        return $this->belongsTo(LawsRegsSection::class, 'section_id');
    }
}
