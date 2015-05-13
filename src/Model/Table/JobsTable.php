<?php

namespace App\Model\Table;

use Cake\ORM\Table;

class JobsTable extends Table
{
    public function initialize(array $config)
    {
		$this->belongsTo('Types', [
            'foreignKey' => 'type_id',
            'joinType' => 'INNER',
        ]);
		$this->belongsTo('Categories', [
            'foreignKey' => 'category_id',
            'joinType' => 'INNER',
        ]);
    }
	
}