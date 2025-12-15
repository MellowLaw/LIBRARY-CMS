<?php

namespace App\Policies;

use App\Models\Page;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PagePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        // Anyone can view published pages, authenticated users with permissions can view all
        if (!$user) {
            return true; // Public can view published pages via published endpoint
        }
        return $user->isAdmin() || $user->isLibrarian();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, Page $page): bool
    {
        // Anyone can view published pages
        if ($page->is_published && $page->published_at && $page->published_at <= now()) {
            return true;
        }
        
        // Only authenticated users with permissions can view unpublished pages
        if (!$user) {
            return false;
        }
        
        // Creator, admin, or librarian can view unpublished pages
        return $user->isAdmin() || 
               $user->isLibrarian() || 
               $user->id === $page->created_by;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->isAdmin() || $user->isLibrarian();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Page $page): bool
    {
        // Admin can update any page
        if ($user->isAdmin()) {
            return true;
        }
        
        // Librarian can update pages they created
        if ($user->isLibrarian() && $user->id === $page->created_by) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Page $page): bool
    {
        // Only admin can delete pages
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Page $page): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Page $page): bool
    {
        return false;
    }
}
