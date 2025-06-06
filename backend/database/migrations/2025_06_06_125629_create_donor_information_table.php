<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\BloodGroup;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('donor_information', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->enum('blood_group', BloodGroup::allGroups());
            $table->boolean('is_available')->default(true);
            $table->date('last_donation_date')->nullable();
            $table->string('profession')->nullable();
            $table->string('religion')->nullable();
            $table->unsignedTinyInteger('age')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
            $table->index(['user_id', 'is_available', 'blood_group']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_information');
    }
};
