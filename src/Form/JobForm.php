<?php
namespace App\Form;

use Cake\Form\Form;
use Cake\Form\Schema;
use Cake\Datasource\ConnectionManager;

class JobForm extends Form
{
    protected function _execute(array $data)
    {
		//Setting Connection 
		$connection = ConnectionManager::get('default');
		if($connection->insert('jobs', $data)){
			return TRUE;
		} else {
			return FALSE;
		}
	}
}
?>
