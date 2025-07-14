<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcurementPlanFile extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'files_path', 'files_type'];

    public function type()
    {
        return $this->belongsTo(ProcurementPlanType::class, 'type_id');
    }
}
