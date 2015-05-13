<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function validationDefault(Validator $validator)
    {
        return $validator
            ->notEmpty('first_name', 'A username is required')
			->notEmpty('last_name', 'A username is required')
			->notEmpty('email', 'A username is required')
			->notEmpty('username', 'A username is required')
			->notEmpty('password', 'A username is required')
			->add('role', 'inList', [
                'rule' => ['inList', ['Employer', 'Job Seeker']],
                'message' => 'Please enter a valid role'
            ]);
    }

}
?>