<?php

/**
 * SessionController
 *
 * Allows to register new users
 */
class RegisterController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }
    
    /**
     * Action to register a new user
     */
    public function indexAction()
    {
        $form = new RegisterForm;

        //リクエストがpostのときの処理
        if ($this->request->isPost()) {

            //$_POST[]
            $username = $this->request->getPost('username', 'alphanum');
            $email = $this->request->getPost('email', 'email');
            $password = $this->request->getPost('password');
            $repeatPassword = $this->request->getPost('repeatPassword');
            $FileName = "";
            if ($password != $repeatPassword) {
                $this->flash->error('Passwordが一致しませんでした。');
                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
            }

            //アップロードファイルがあるかどうかをチェックします
            if( $this->request->hasFiles() == true)
            {
                //アップロードされたファイルを取得、アクセスします。
                foreach ($this->request->getUploadedFiles() as $file) {
                    $FileName = $file->getName();
                    $TempFile = $file->getTempName();
                    $ext = substr($FileName, -3);
                    if ($ext != 'jpg' && $ext != 'gif' && $ext != 'png') {
                       $this->flash->error('指定するファイルに問題があります。やり直してください。');
                       return $this->dispatcher->forward(
                        [
                        "controller" => "index",
                        "action"     => "index",
                        ]
                        );
                   }else{ 
                        $image = date('YmdHis') . $FileName;
                        $file->moveTo('./img/' . $image);
                   }
               }
            }  
        
            $user = new Users();
            $user->username = $username;
            $user->password = sha1($password);
            $user->email = $email;
            $user->picture = $image;
            $user->created_at = new Phalcon\Db\RawValue('now()');
            if ($user->save() == false) {
                foreach ($user->getMessages() as $message) {
                    $this->flash->error((string) $message);
                }
            } else {
                $this->tag->setDefault('email', '');
                $this->tag->setDefault('password', '');
                $this->flash->success('新規登録ありがとうございます！それではログインしてください。');

                return $this->dispatcher->forward(
                    [
                        "controller" => "index",
                        "action"     => "index",
                    ]
                );
            }
        
  }
  $this->view->form = $form;
}

}

?>
