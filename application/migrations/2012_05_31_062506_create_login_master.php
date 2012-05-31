<?php

class Create_Login_Master {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('login_master', function($table) {
                    
                        // auto incremental id (PK)
                        $table->increments('idlogin_master');
                        
                        // varchar 45
                        $table->string('user_name', 45);
                        
                        // varchar 60
                        $table->string('password', 60);
                        
                        // created_at | updated_at DATETIME
                        $table->timestamps();
                        
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('login_master');
	}

}