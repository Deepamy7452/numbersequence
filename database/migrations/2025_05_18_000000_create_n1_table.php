  <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n1', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('number_sequence_code')->unique();
            $table->string('name');
            $table->integer('next');
            $table->string('format');
            $table->integer('constant_no');
            $table->integer('range_no');
            $table->string('area');
            $table->string('status');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('tbl_entity_id');
            $table->timestamp('created_at')->useCurrent();

            // You might want to add foreign key constraints on created_by and tbl_entity_id if applicable
            // $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('tbl_entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('n1');
    }
}

