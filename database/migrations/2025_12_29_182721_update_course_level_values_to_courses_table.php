<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Step 1: Temporarily add all values (old + new) to the enum
        DB::statement("ALTER TABLE courses MODIFY COLUMN level ENUM('beginner', 'intermediate', 'advanced', 'undergraduate', 'postgraduate', 'graduate', 'doctorate') NOT NULL");
        
        // Step 2: Update existing data to map old values to new ones
        DB::table('courses')
            ->where('level', 'beginner')
            ->update(['level' => 'undergraduate']);
            
        DB::table('courses')
            ->where('level', 'intermediate')
            ->update(['level' => 'postgraduate']);
            
        DB::table('courses')
            ->where('level', 'advanced')
            ->update(['level' => 'graduate']);
        
        // Step 3: Remove old values from the enum
        DB::statement("ALTER TABLE courses MODIFY COLUMN level ENUM('undergraduate', 'postgraduate', 'graduate', 'doctorate') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Step 1: Temporarily add all values to the enum
        DB::statement("ALTER TABLE courses MODIFY COLUMN level ENUM('beginner', 'intermediate', 'advanced', 'undergraduate', 'postgraduate', 'graduate', 'doctorate') NOT NULL");
        
        // Step 2: Update existing data to map new values back to old ones
        DB::table('courses')
            ->where('level', 'undergraduate')
            ->update(['level' => 'beginner']);
            
        DB::table('courses')
            ->where('level', 'postgraduate')
            ->update(['level' => 'intermediate']);
            
        DB::table('courses')
            ->where('level', 'graduate')
            ->update(['level' => 'advanced']);
            
        DB::table('courses')
            ->where('level', 'doctorate')
            ->update(['level' => 'advanced']);
        
        // Step 3: Remove new values from the enum
        DB::statement("ALTER TABLE courses MODIFY COLUMN level ENUM('beginner', 'intermediate', 'advanced') NOT NULL");
    }
};
