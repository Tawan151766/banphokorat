<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawsRegsSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'section_name'

    ];

    public function type()
    {
        return $this->belongsTo(LawsRegsType::class, 'type_id');
    }

    public function files()
    {
        return $this->hasMany(LawsRegsFiles::class, 'section_id');
    }
}
