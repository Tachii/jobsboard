<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class TypesTable extends Table
{
    public function initialize(array $config)
    {
    	$this->table('types');
    }
	
}