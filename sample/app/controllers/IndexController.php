<?php

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice('これは　[Phalcon Framework]　のサンプルアプリなので、個人情報などは入力しないようにお願いします。');
        }
    }
}
