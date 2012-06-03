<?php

class Create_User_Details {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_details', function($table) {
                    
                        // auto incremental id (PK)
                        $table->increments('id');
                        
                        // integer
                        $table->integer('psrn');
                        $table->integer('user_master_id');
                        
                        // foreign keys
                        $table->foreign('user_master_id')->references('id')->on('user_master')->on_delete('restrict');
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('user_details');
	}

}