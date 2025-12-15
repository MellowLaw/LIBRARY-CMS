<?php

namespace App\Observers;

use App\Models\Page;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

class PageObserver
{
    /**
     * Handle the Page "created" event.
     */
    public function created(Page $page): void
    {
        AuditLog::log(
            'create',
            Page::class,
            $page->id,
            Auth::user(),
            null,
            $page->toArray()
        );
    }

    /**
     * Handle the Page "updated" event.
     */
    public function updated(Page $page): void
    {
        AuditLog::log(
            'update',
            Page::class,
            $page->id,
            Auth::user(),
            $page->getOriginal(),
            $page->getChanges()
        );
    }

    /**
     * Handle the Page "deleted" event.
     */
    public function deleted(Page $page): void
    {
        AuditLog::log(
            'delete',
            Page::class,
            $page->id,
            Auth::user(),
            $page->toArray(),
            null
        );
    }
}
