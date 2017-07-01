
<?= $this->getContent() ?>

<div class="page-header">
    <h2>新規登録フォーム</h2>
</div>

<?= $this->tag->form(['register', 'id' => 'registerForm', 'onbeforesubmit' => 'return false', 'enctype' => 'multipart/form-data']) ?>

    <fieldset>

        <div class="control-group">
            <?= $form->label('username', ['class' => 'control-label']) ?>
            <div class="controls">
                <?= $form->render('username', ['class' => 'form-control']) ?>
                <p class="help-block">(必須)</p>
                <div class="alert alert-warning" id="username_alert">
                    <strong>Warning!</strong> Please enter your desired user name
                </div>
            </div>
        </div>

        <div class="control-group">
            <?= $form->label('email', ['class' => 'control-label']) ?>
            <div class="controls">
                <?= $form->render('email', ['class' => 'form-control']) ?>
                <p class="help-block">(必須)</p>
                <div class="alert alert-warning" id="email_alert">
                    <strong>Warning!</strong> Please enter your email
                </div>
            </div>
        </div>

        <div class="control-group">
            <?= $form->label('password', ['class' => 'control-label']) ?>
            <div class="controls">
                <?= $form->render('password', ['class' => 'form-control']) ?>
                <p class="help-block">(最低8文字以上)</p>
                <div class="alert alert-warning" id="password_alert">
                    <strong>Warning!</strong> Please provide a valid password
                </div>
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="repeatPassword">Password確認</label>
            <div class="controls">
                <?= $this->tag->passwordField(['repeatPassword', 'class' => 'form-control']) ?>
                <p></p>
                <div class="alert" id="repeatPassword_alert">
                    <strong>Warning!</strong> The password does not match
                </div>
            </div>
        </div>

         <div class="control-group">
            <label class="control-label" for="picture">写真</label>
            <div class="controls">
                <input type="file" name="images[]" multiple>
                <p class="help-block">(.gifまたは.jpgまたは.png)</p>
                <div class="alert alert-warning" id="password_alert">
                    <strong>Warning!</strong> Please enter your picture
                </div>
            </div>
        </div>

        <div class="control-group"><p></p></div>
        <div class="form-actions">
            <?= $this->tag->submitButton(['登録', 'class' => 'btn btn-primary', 'onclick' => 'return SignUp.validate();']) ?>
        </div>

    </fieldset>
</form>
