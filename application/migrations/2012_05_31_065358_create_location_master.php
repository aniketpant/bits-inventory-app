<?php

class Create_Location_Master {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('location_master', function($table){
                        
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // varchar 32
                        $table->string('location_name', '32');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('location_master');
	}

}