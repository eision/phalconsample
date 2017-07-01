<?php

use Phalcon\Mvc\Model;

class Companies extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $content;

}
