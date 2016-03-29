<?php

class BlogController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Blog');
        parent::initialize();
    }

    public function indexAction()
    {
    }
}
