<?php

class Create_Inventory_Type_Details {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('inventory_type_details', function($table){
                    
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // integer
                        $table->integer('inventory_type_master_id');
                        $table->integer('user_details_id');
                        
                        // foreign keys
                        $table->foreign('inventory_type_master_id')->references('id')->on('inventory_type_master')->on_delete('restrict');
                        $table->foreign('user_details_id')->references('id')->on('user_details')->on_delete('restrict');
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('inventory_type_details');
	}

}