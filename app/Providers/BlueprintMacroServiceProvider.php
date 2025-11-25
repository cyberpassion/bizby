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
        });

        // Common fields for person modules
        Blueprint::macro('commonPersonFields', function () {

            $this->string('first_name', 100);
            $this->string('middle_name', 100)->nullable();
            $this->string('last_name', 100)->nullable();

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
        });
    }
}
