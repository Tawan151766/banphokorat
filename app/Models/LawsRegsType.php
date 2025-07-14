<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LawsRegsType extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_name',
    ];

    public function sections()
    {
        return $this->hasMany(LawsRegsSection::class, 'type_id');
    }
}
