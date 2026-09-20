<?php

use App\Models\Screenshot;
use App\Models\Tag;
use App\Models\User;
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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('excerpt');
            $table->json('features')->nullable(); // ex:{feature1, feature2}
            // in the screenshot should i create a another table or should i make it as a json {path:......, ........}
            $table->json('screenshots')->nullable();
            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at');
            $table->foreignIdFor(Screenshot::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Tag::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
