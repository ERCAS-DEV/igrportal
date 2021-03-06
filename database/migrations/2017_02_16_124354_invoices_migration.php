<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvoicesMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invoice_key');
            $table->string('name');
            $table->string('email');
            $table->string('payer_id');
            $table->integer('worker_id')->unsigned()->index();
            $table->foreign('worker_id')->references('id')->on('workers')->onDelete('cascade');
            $table->enum('invoice_status', [0, 1]);
            $table->integer('mda_id')->unsigned()->index();
            $table->foreign('mda_id')->references('id')->on('mdas')->onDelete('cascade');
            $table->integer('revenuehead_id')->unsigned()->index();
            $table->foreign('revenuehead_id')->references('id')->on('revenueheads')->onDelete('cascade');
            $table->integer('subhead_id')->unsigned()->index();
            $table->foreign('subhead_id')->references('id')->on('subheads')->onDelete('cascade');
            $table->string('phone');
            $table->string('pos_key');
            $table->string('amount');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
