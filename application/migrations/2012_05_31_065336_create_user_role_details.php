<?php

class Create_User_Role_Details {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('user_role_details', function($table){
                    
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // integer
                        $table->integer('user_details_iduser_details');
                        $table->integer('user_role_master_iduser_role_master');
                        
                        // foreign keys
                        $table->foreign('user_details_iduser_details')->references('id')->on('user_details')->on_delete('restrict');
                        $table->foreign('user_role_master_iduser_role_master')->references('id')->on('user_role_master')->on_delete('restrict');
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('user_role_details');
	}

}