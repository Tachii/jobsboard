<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Job Entity.
 */
class Job extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = array(
        'category_id' => true,
        'user_id' => true,
        'type_id' => true,
        'company_name' => true,
        'title' => true,
        'description' => true,
        'city' => true,
        'contact_email' => true,
        'category' => true,
        'user' => true,
        'type' => true,
    );
}
