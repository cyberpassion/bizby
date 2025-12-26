<?php

namespace Modules\Library\Http\Controllers;

use Modules\Library\Models\Library;
use Modules\Shared\Http\Controllers\SharedApiController;

class LibraryApiController extends SharedApiController
{
    protected function model()
    {
        return Library::class;
    }

    protected function validationRules($id = null)
    {
        return [];
    }
    protected function allowedCharts(): array
    {
        return [
            'books_by_category',          // Category-wise books
            'books_by_language',          // Language-wise distribution
            'books_by_author',            // Author-wise count
            'books_by_publication',       // Publication-wise books
            'books_by_publishing_year',   // Year-wise publishing trend
            'books_by_entry_source',      // Web / Mobile / API entries
            'books_by_status',            // Active vs Inactive
            'books_in_use_vs_available',  // Issued vs Available
            'books_by_rating',            // Rating-wise grouping
            'books_added_over_time'       // created_at date-wise
        ];
    }
    protected function defaultMetrics(): array
    {
        return [
            'total_books',            // Total records
            'total_quantity',         // Total available quantity
            'average_rating'          // Avg rating of books
        ];
    }

    protected function defaultAggregates(): array
    { 
        return [
            'count:id',                                   // Total books count
            'sum:total_quantity',                         // Total book quantity
            'count:is_currently_in_use=Yes',              // Issued books
            'count:is_currently_in_use=No',               // Available books
            'avg:average_rating'                          // Average rating
        ];
    }

    protected function defaultGroups(): array
    {
        return [
            'category',               // Category-wise grouping
            'language',               // Language-wise grouping
            'publishing_year',        // Year-wise grouping
            'entry_source'            // Source-wise grouping
        ];
    }  





}
