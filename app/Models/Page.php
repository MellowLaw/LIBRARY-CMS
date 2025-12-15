<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug',
        'title',
        'meta_description',
        'is_published',
        'published_at',
        'scheduled_at',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
        'scheduled_at' => 'datetime',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function sections()
    {
        return $this->hasMany(ContentSection::class)->orderBy('display_order');
    }

    public function auditLogs()
    {
        return $this->morphMany(AuditLog::class, 'model');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('is_published', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeScheduled($query)
    {
        return $query->where('scheduled_at', '>', now());
    }

    // Methods
    public function publish()
    {
        $this->update([
            'is_published' => true,
            'published_at' => now(),
            'scheduled_at' => null,
        ]);
    }

    public function schedulePublish($dateTime)
    {
        $this->update(['scheduled_at' => $dateTime]);
    }
}
