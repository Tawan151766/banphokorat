<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'parent_id',
        'level',
        'order_no'
    ];

    // ความสัมพันธ์กับเมนูหลัก (กรณีนี้เมนูที่เป็น parent ของ current menu)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // ความสัมพันธ์กับเมนูย่อย (children ทุกระดับ)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('order_no');
    }

    // ความสัมพันธ์เฉพาะกับ small_sub menus
    public function smallSubs()
    {
        return $this->hasMany(Menu::class, 'parent_id')
            ->where('level', 'small_sub')
            ->orderBy('order_no');
    }

    // ความสัมพันธ์กับไฟล์แนบ (attachments)
    public function attachments()
    {
        return $this->hasMany(MenuAttachment::class);
    }

    // Scope สำหรับเมนูหลัก
    public function scopeMainMenus($query)
    {
        return $query->where('level', 'main')->whereNull('parent_id')->orderBy('order_no');
    }

    // Scope สำหรับเมนูย่อย
    public function scopeSubMenus($query)
    {
        return $query->where('level', 'sub')->orderBy('order_no');
    }

    // Scope สำหรับเมนูย่อยย่อย
    public function scopeSmallSubMenus($query)
    {
        return $query->where('level', 'small_sub')->orderBy('order_no');
    }
}