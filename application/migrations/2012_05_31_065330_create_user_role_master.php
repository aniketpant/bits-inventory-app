<?php

class Create_User_Role_Master {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('user_role_master', function($table){
                        
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // varchar 32
                        $table->string('role_name', 32);
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('user_role_master');
	}

}