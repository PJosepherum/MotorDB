<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Select;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Numericality;

class VehiclesForm extends Form
{

    /**
     * Initialize the vehicles form
     */
    public function initialize($entity = null, $options = array())
    {

        //if (!isset($options['edit']) || !isset($options['new'])) {
        //    $element = new Text("id");
        //    $this->add($element->setLabel("Id"));
        //} else {
            $this->add(new Hidden("id"));
        //}

        $make = new Select('make_id', Makes::find(), array(
            'using'      => array('id', 'name'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $make->setLabel('Make');
        $this->add($make);

        $user = new Select('user_id', Users::find(), array(
            'using'      => array('id', 'name'),
            'useEmpty'   => true,
            'emptyText'  => '...',
            'emptyValue' => ''
        ));
        $user->setLabel('User');
        $this->add($user);



        $model = new Text("model");
        $model->setLabel("Model");
        $model->setFilters(array('striptags', 'string'));
        $model->addValidators(array(
            new PresenceOf(array(
                'message' => 'Name is required'
            ))
        ));
        $this->add($model);

        $condition = new Text("condition");
        $condition->setLabel("Condition");
        $condition->setFilters(array('striptags', 'string'));
        $condition->addValidators(array(
            new PresenceOf(array(
                'message' => 'Condition is required'
            ))
        ));
        $this->add($condition);

        $colour = new Text("colour");
        $colour->setLabel("Colour");
        $colour->setFilters(array('striptags', 'string'));
        $colour->addValidators(array(
            new PresenceOf(array(
                'message' => 'Colour is required'
            ))
        ));
        $this->add($colour);

        $style = new Text("style");
        $style->setLabel("Style");
        $style->setFilters(array('striptags', 'string'));
        $style->addValidators(array(
            new PresenceOf(array(
                'message' => 'Style is required'
            ))
        ));
        $this->add($style);

        $image = new Text("image");
        $image->setLabel("Image");
        $image->setFilters(array('striptags', 'string'));
        $image->addValidators(array(
            new PresenceOf(array(
                'message' => 'Image is required'
            ))
        ));
        $this->add($image);

        $price = new Text("price");
        $price->setLabel("Price");
        $price->setFilters(array('float'));
        $price->addValidators(array(
            new PresenceOf(array(
                'message' => 'Price is required'
            ))
        ));
        $this->add($price);

        $year = new Text("year");
        $year->setLabel("Year");
        $year->setFilters(array('float'));
        $year->addValidators(array(
            new PresenceOf(array(
                'message' => 'Year is required'
            ))
        ));
        $this->add($year);
    }
}