<?php

namespace App\Observers;

use App\Models\Subcategory;

class SubCategoryObserver
{
    /**
     * Handle the Subcategory "created" event.
     */
    public function created(Subcategory $subcategory): void
    {
        $subcategory->load(['category']);
    }

    /**
     * Handle the Subcategory "updated" event.
     */
    public function updated(Subcategory $subcategory): void
    {
        $subcategory->load(['category']);
    }

    /**
     * Handle the Subcategory "deleted" event.
     */
    public function deleted(Subcategory $subcategory): void
    {
        //
    }

    /**
     * Handle the Subcategory "restored" event.
     */
    public function restored(Subcategory $subcategory): void
    {
        //
    }

    /**
     * Handle the Subcategory "force deleted" event.
     */
    public function forceDeleted(Subcategory $subcategory): void
    {
        //
    }
}
