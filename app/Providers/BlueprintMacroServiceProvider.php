<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class BlueprintMacroServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Common fields for SaaS modules
        Blueprint::macro('commonSaasFields', function () {

            $this->id();
            $this->unsignedBigInteger('client_id')->nullable()->index();
            $this->unsignedTinyInteger('status')->default(1)->index();

            // Audit fields
            $this->unsignedBigInteger('created_by')->nullable()->index();
            $this->unsignedBigInteger('updated_by')->nullable()->index();
            $this->unsignedBigInteger('deleted_by')->nullable()->index();

            $this->softDeletes();    // deleted_at
            $this->timestamps();     // created_at, updated_at

			$this->string('entry_source', 50)->nullable()
              ->comment('Source of entry: web, mobile, employee, api, system');

	        $this->unsignedBigInteger('entry_source_ref_id')->nullable()
              ->comment('Reference ID if entry source is tied to a specific record, e.g. employee_id');

    	    $this->text('remark')->nullable()
              ->comment('Human-readable remark or note');

			$this->text('system_remark')->nullable()
              ->comment('System-generated remark / auto-processing note');

        	$this->json('meta_info')->nullable()
              ->comment('Dynamic metadata (IP, device, payload, log info)');
        });

        // Common fields for person modules
        Blueprint::macro('commonPersonFields', function () {

            $this->string('name', 100)->nullable();

            // Optional: auto CONCATED full_name column
            // $this->string('full_name')->virtualAs("CONCAT(first_name, ' ', last_name)");

            $this->date('dob')->nullable();

            $this->string('phone_number', 20)->nullable()->index();
            $this->string('email', 255)->nullable();

			$this->string('verification_id_name', 64)->nullable();
			$this->string('verification_id_number', 64)->nullable();

            // Optional: stored lowercase email for search
            // $this->string('email_lower')->nullable()->storedAs('LOWER(email)');

            $this->text('address')->nullable();

            $this->string('religion', 100)->nullable();
            $this->string('caste', 100)->nullable();
            $this->string('category', 100)->nullable();
			$this->string('nationality', 100)->nullable();

        });
    }
}
