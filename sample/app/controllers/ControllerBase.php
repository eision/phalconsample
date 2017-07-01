<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{

    protected function initialize()
    {
        $this->tag->prependTitle('Sample | ');
        $this->view->setTemplateAfter('main');
    }
}
