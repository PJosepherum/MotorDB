<?php

use Phalcon\Mvc\Model;

/**
 * Products
 */
class Vehicles extends Model
{
	/**
	 * @var integer
	 */
	public $id;

	/**
	 * @var integer
	 */
	public $user_id;

	/**
	 * @var integer
	 */
	public $make_id;

	/**
	 * @var string
	 */
	public $model;

	/**
	 * @var string
	 */
	public $colour;

	/**
	 * @var string
	 */
	public $price;

	/**
	 * @var string
	 */
	public $condition;

	/**
	 * @var string
	 */
	public $image;

	/**
	 * @var string
	 */
	public $style;

	/**
	 * Products initializer
	 */
	public function initialize()
	{
		$this->belongsTo('make_id', 'Makes', 'id', array(
			'reusable' => true
		));
	}

}
