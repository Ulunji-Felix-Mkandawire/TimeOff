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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            // You cannot delete the department (ex: design department) from the departments table
            // while we still have employees in that department hence restricting on delete.
            // restrict on delete will simply raise a violetion error when
            $table->foreignId('department_id')->constrained('departments')->restrictOnDelete();
            // If the manager gets deleted from the table, the employees that had that manager
            // will simply have a null on their manager id column indicating that they
            // currently do not have any manager
            // people dont stp existing within the company simply because a manager died
            $table->foreignId('manager_id')->nullable()->constrained('employees')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
