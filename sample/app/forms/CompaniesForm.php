<?php

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class CompaniesForm extends Form
{

    /**
     * Initialize the companies form
     */
    public function initialize($entity = null, $options = array())
    {

        if (!isset($options['edit'])) {
            $element = new Text("id");
            $this->add($element->setLabel("Id"));
        } else {
            $this->add(new Hidden("id"));
        }

        $title = new Text("title");
        $title->setLabel("Title");
        $title->setFilters(array('striptags', 'string'));
        $title->addValidators(array(
            new PresenceOf(array(
                'message' => 'Title is required'
            ))
        ));
        $this->add($title);

        $content = new Text("content");
        $content->setLabel("Content");
        $content->setFilters(array('striptags', 'string'));
        $content->addValidators(array(
            new PresenceOf(array(
                'message' => 'Content is required'
            ))
        ));
        $this->add($content);

    }

}