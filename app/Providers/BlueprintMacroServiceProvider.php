<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class BlueprintMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        /**
         * -------------------------------------------------------------
         *  Macro: commonSaasFields()
         *  Adds standard fields required across SaaS-based module tables
         *  - Primary key
         *  - Client multitenancy fields
         *  - Status flags
         *  - Audit fields (created_by, updated_by, deleted_by)
         *  - Soft deletes + timestamps
         *  - Entry source tracking (web / mobile / api / system)
         *  - Remarks (user + system)
         *  - JSON metadata (IP, device, logs etc.)
         * -------------------------------------------------------------
         */
        Blueprint::macro('commonSaasFields', function () {

            // Primary key
            $this->id();

            // Multitenancy: Which client/tenant this record belongs to
            $this->unsignedBigInteger('client_id')
                ->nullable()
                ->index()
                ->comment('Tenant/Client owner ID');

            // Record status: 1=Active, 0=Inactive, etc.
            $this->unsignedTinyInteger('status')
                ->default(1)
                ->index()
                ->comment('Record status: 1=Active,0=Inactive');

            /**
             * -----------------------------------------------------
             * Audit Fields (Optional but widely useful)
             * Manually updated inside controllers/service layers
             * -----------------------------------------------------
             */
            $this->unsignedBigInteger('created_by')
                ->nullable()
                ->index()
                ->comment('User ID who created entry');

            $this->unsignedBigInteger('updated_by')
                ->nullable()
                ->index()
                ->comment('User ID who last updated entry');

            $this->unsignedBigInteger('deleted_by')
                ->nullable()
                ->index()
                ->comment('User ID who soft-deleted entry');

            // Soft Delete + Timestamp fields
            $this->softDeletes();   // deleted_at
            $this->timestamps();    // created_at, updated_at

            /**
             * -----------------------------------------------------
             * Entry Source Tracking
             * Helps identify how data entered system
             * Examples: web, mobile, employee, api, auto/system
             * -----------------------------------------------------
             */
            $this->string('entry_source', 50)
                ->nullable()
                ->comment('Source of entry: web, mobile, employee, api, system');

            $this->unsignedBigInteger('entry_source_ref_id')
                ->nullable()
                ->comment('Reference ID e.g., employee_id if entry_source=employee');

            /**
             * -----------------------------------------------------
             * Remarks
             * → remark: Human written note
             * → system_remark: Automated logs or explanations
             * -----------------------------------------------------
             */
            $this->text('remark')
                ->nullable()
                ->comment('Human-readable remark or note');

            $this->text('system_remark')
                ->nullable()
                ->comment('System-generated remark or auto-processing log');

            /**
             * -----------------------------------------------------
             * meta_info (JSON)
             * Flexible metadata structure:
             * - IP address
             * - User agent / device info
             * - Version history
             * - API payload details
             * - Internal logs
             * -----------------------------------------------------
             */
            $this->json('meta')
                ->nullable()
                ->comment('Dynamic metadata: IP, device, versioning, logs');
        });

        /**
         * -------------------------------------------------------------
         *  Macro: commonPersonFields()
         *  Adds standard fields used in person-related modules
         *  (students, employees, patients, visitors, parents, etc.)
         *  
         *  Includes:
         *  - Basic identity info
         *  - Contact details
         *  - Government ID details
         *  - Demographic info
         *  - Family/religious/social identity fields
         * -------------------------------------------------------------
         */
        Blueprint::macro('commonPersonFields', function () {

            // Name fields
            $this->string('name', 100)
                ->nullable()
                ->comment('Full name of the person');

            // Gender and demographic profile
            $this->string('gender', 20)
                ->nullable()
                ->comment('Gender of the person');

            $this->date('dob')
                ->nullable()
                ->comment('Date of birth');

            $this->unsignedTinyInteger('age')
                ->nullable()
                ->comment('Age (calculated or manually entered)');

            // Contact details
            $this->string('phone', 20)
                ->nullable()
                ->index()
                ->comment('Primary phone number');

            $this->string('email', 255)
                ->nullable()
                ->comment('Email address');

            // Government / verification IDs
            $this->string('verification_id_name', 64)
                ->nullable()
                ->comment('Verification ID type (Aadhar, PAN, etc.)');

            $this->string('verification_id_number', 64)
                ->nullable()
                ->comment('Verification ID number');

            // Address
            $this->text('address')
                ->nullable()
                ->comment('Complete postal address');

            // Cultural / social identifiers
            $this->string('religion', 100)
                ->nullable()
                ->comment('Religion');

            $this->string('caste', 100)
                ->nullable()
                ->comment('Caste');

            $this->string('category', 100)
                ->nullable()
                ->comment('Category such as General/OBC/SC/ST');

            $this->string('nationality', 100)
                ->nullable()
                ->comment('Nationality');

            // Marital status: 0=Single,1=Married,2=Widowed,3=Divorced
            $this->unsignedTinyInteger('marital_status')
                ->nullable()
                ->comment('0=Single,1=Married,2=Widowed,3=Divorced');
        });
    }
}
