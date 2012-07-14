<?php

class Create_Inventory_Type_Master {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
                Schema::create('inventory_type_master', function($table){
                        
                        // auto incremental id(PK)
                        $table->increments('id');
                        
                        // varchar 32
                        $table->string('inventory_type_name', '32');
                });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
                Schema::drop('inventory_type_master');
	}

}