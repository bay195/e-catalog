<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();

            // Data dari User
            $table->string('item_code')->nullable();
            $table->string('inc')->nullable();
            $table->string('item_type')->nullable();
            $table->string('item_group')->nullable();
            $table->string('uom')->nullable();
            $table->string('denotation')->nullable();
            $table->string('keyword')->nullable();
            $table->text('description')->nullable();
            $table->string('old_code')->nullable();
            $table->string('cross_ref_1')->nullable();
            $table->string('cross_ref_2')->nullable();
            $table->string('cross_ref_3')->nullable();
            $table->string('functional_location')->nullable();
            
            

            // Data dari FAT
            $table->string('coa')->nullable();
            $table->string('gl')->nullable();
            

            // Data dari Procurement
            
            $table->decimal('unit_price', 15, 2)->nullable();
            $table->string('main_supplier')->nullable();

            // Data dari Logistik
            $table->string('storage_location')->nullable();
            $table->string('max_stock_level')->nullable();
            $table->string('reorder_point')->nullable();

            // Status progress pengisian data (0=user, 1=fat, 2=procurement, 3=logistik, 4=selesai)
            $table->unsignedTinyInteger('status')->default(0);

            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
