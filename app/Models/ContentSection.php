<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_type',
        'title',
        'content',
        'display_order',
    ];

    // Relationships
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    // Scopes
    public function scopeByType($query, $type)
    {
        return $query->where('section_type', $type);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order');
    }
}
