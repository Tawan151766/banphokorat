<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'title',
        'word_file',
        'excel_file',
        'pdf_file',
        'image_file'
    ];

    // Relationship with menu
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
