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
                        $table->integer('login_master_idlogin_master');
                        
                        // foreign keys
                        $table->foreign('login_master_idlogin_master')->references('id')->on('login_master')->on_delete('restrict');
                        
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