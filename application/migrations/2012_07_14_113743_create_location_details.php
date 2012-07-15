<?php

class Create_Location_Details {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('location_details', function($table){
                    
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // integer
                        $table->integer('location_master_id');
                        $table->integer('user_details_id');
                        
                        // foreign keys
                        $table->foreign('location_master_id')->references('id')->on('location_master')->on_delete('restrict');
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
                Schema::drop('location_details');
	}

}