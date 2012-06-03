<?php

class Create_Inventory_Details {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('inventory_details', function($table){
                        
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // integer
                        $table->integer('user_role_details_id');
                        $table->integer('location_master_id');
                        $table->integer('item_type_master_id');
                        $table->integer('quantity');
                        
                        // varchar 32
                        $table->string('value', 32);
                        
                        // foreign keys
                        $table->foreign('user_role_details_id')->references('id')->on('user_role_details')->on_delete('restrict');
                        $table->foreign('location_master_id')->references('id')->on('location_master')->on_delete('restrict');
                        $table->foreign('item_type_master_id')->references('id')->on('item_type_master')->on_delete('restrict');
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('inventory_details');
	}

}