
<?= $this->getContent() ?>

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>ログイン</h2>
        </div>
        <?= $this->tag->form(['session/start', 'role' => 'form']) ?>
            <fieldset>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="controls">
                        <?= $this->tag->textField(['email', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        <?= $this->tag->passwordField(['password', 'class' => 'form-control']) ?>
                    </div>
                </div>
                <div class="form-group">
                    <?= $this->tag->submitButton(['Login', 'class' => 'btn btn-primary btn-large']) ?>
                </div>
            </fieldset>
        </form>

           <h2>まだアカウントを持っていませんか?</h2>

        <div class="clearfix center">
            <?= $this->tag->linkTo(['register', '新規登録', 'class' => 'btn btn-primary btn-large btn-success']) ?>
        </div>
    </div>
</div>
