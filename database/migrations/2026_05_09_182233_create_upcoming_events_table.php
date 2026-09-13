// database/migrations/2026_05_09_000000_create_upcoming_events_table.php
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('upcoming_events', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('subtitle')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->string('button_text')->nullable();
            $table->string('button_link')->nullable();

            $table->string('badge_text')->default('UPCOMING');

            $table->string('background_color')->nullable();
            $table->string('button_color')->nullable();

            $table->string('image')->nullable();

            $table->boolean('status')->default(1);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('upcoming_events');
    }
};