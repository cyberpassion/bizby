<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Fee Structure Patterns
        |--------------------------------------------------------------------------
        |
        | Examples:
        |
        | monthly
        | quarterly
        | half_yearly
        | annual
        | custom
        |
        */

        Schema::create('student_fee_structure_patterns', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();

            /*
            |--------------------------------------------------------------------------
            | Pattern Info
            |--------------------------------------------------------------------------
            */

            $table->string('name');

            // monthly, quarterly, annual etc
            $table->string('key')->unique();

            $table->text('description')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Behaviour
            |--------------------------------------------------------------------------
            */

            // Can admin modify periods manually?
            $table->boolean('is_customizable')
                ->default(false);

            // Active / inactive pattern
            $table->boolean('is_active')
                ->default(true);

            // Display order
            $table->integer('sort_order')
                ->default(0);
        });

        /*
        |--------------------------------------------------------------------------
        | Pattern Periods
        |--------------------------------------------------------------------------
        |
        | Examples:
        |
        | apr  => April
        | may  => May
        |
        | q1   => Quarter 1
        |
        | annual => Annual
        |
        */

        Schema::create('student_fee_structure_pattern_periods', function (Blueprint $table) {

            // Common SaaS Fields
            $table->commonSaasFields();

            /*
            |--------------------------------------------------------------------------
            | Relations
            |--------------------------------------------------------------------------
            */

            $table->foreignId('pattern_id')
                ->constrained('student_fee_structure_patterns')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Period Info
            |--------------------------------------------------------------------------
            */

            // apr, q1, annual etc
            $table->string('key');

            // April, Quarter 1 etc
            $table->string('label');

            /*
            |--------------------------------------------------------------------------
            | Optional Metadata
            |--------------------------------------------------------------------------
            */

            // Useful for timelines / reports
            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Ordering
            |--------------------------------------------------------------------------
            */

            $table->integer('sort_order')
                ->default(0);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('is_active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Keys Per Pattern
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'pattern_id',
                'key',
            ]);

			$table->date('due_date')
		        ->nullable();

        });

    }

    public function down(): void
	{
    	Schema::dropIfExists(
        	'student_fee_structure_pattern_periods'
	    );

	    Schema::dropIfExists(
    	    'student_fee_structure_patterns'
    	);
	}
};