<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Module\Resource;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description');
            $table->string('file_upload');
            $table->timestamps();
        });
        foreach (Resource::all() as $resources) {
            $resources->slug = str_slug($resources->resources_name, '-');
            $resources->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
        Schema::table('resources', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
