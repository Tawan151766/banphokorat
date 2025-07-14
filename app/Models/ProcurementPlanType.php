<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementPlanType extends Model
{
    use HasFactory;

    protected $fillable = ['type_name'];

    public function files()
    {
        return $this->hasMany(ProcurementPlanFile::class, 'type_id');
    }
}
