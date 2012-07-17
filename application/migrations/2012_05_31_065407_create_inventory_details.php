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
                        $table->integer('inventory_type_details_id');
                        $table->integer('location_details_id');
                        
                        // varchar 32
                        $table->string('value', 60);
                        
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