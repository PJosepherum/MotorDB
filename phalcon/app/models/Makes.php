<?php

use Phalcon\Mvc\Model;

/**
 * Makes of Makes
 */
class Makes extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * Makes initializer
     */
    public function initialize()
    {
        $this->hasMany('id', 'Makes', 'makes_id', array(
        	'foreignKey' => array(
        		'message' => 'Make cannot be deleted because it\'s used in vehicles'
        	)
        ));
    }
}
