<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Post;

final class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create(
            'posts',
            function (Blueprint $table): void {
                $table->id();
                $table->string('title');
                $table->text('content');
                $table->string('image_url')->nullable();
                $table->timestamps();
            }
        );
        Post::create([
            'title' => 'Save the Polar bear',
            'content' => 'The polar bear (Ursus maritimus) is a hypercarnivorous bear whose native range lies largely within the Arctic Circle, encompassing the Arctic Ocean, its surrounding seas and surrounding land masses. It is the largest extant bear species, as well as the largest extant land carnivore. A boar (adult male) weighs around 350–700 kg, while a sow (adult female) is about half that size.',
            'image_url' => 'https://media.audleytravel.com/-/media/images/home/canada-and-the-usa/canada/country-guides/polar-bear-watching-in-canada/istock_483585503_canada_churchill_polar_bear_tundra_letterbox.jpg?q=79&w=1920&h=640',
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
}
