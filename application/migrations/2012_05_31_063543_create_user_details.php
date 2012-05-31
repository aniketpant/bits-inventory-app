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
                        $table->increments('iduser_details');
                        
                        // integer
                        $table->integer('psrn');
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}