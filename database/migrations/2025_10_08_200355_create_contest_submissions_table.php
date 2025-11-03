<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contest_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('nom_prenom');
            $table->string('email');
            $table->string('telephone')->nullable();
            $table->string('statut');
            $table->string('activite');
            $table->text('besoins');
            $table->string('budget');
            $table->string('deadline');
            $table->text('message')->nullable();
            $table->boolean('consent_rgpd')->default(false);
            $table->boolean('opt_in_marketing')->default(false);
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contest_submissions');
    }
};
