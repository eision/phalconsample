
{{ content() }}

<div class="row">

    <div class="col-md-6">
        <div class="page-header">
            <h2>ログイン</h2>
        </div>
        {{ form('session/start', 'role': 'form') }}
            <fieldset>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="controls">
                        {{ text_field('email', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="controls">
                        {{ password_field('password', 'class': "form-control") }}
                    </div>
                </div>
                <div class="form-group">
                    {{ submit_button('Login', 'class': 'btn btn-primary btn-large') }}
                </div>
            </fieldset>
        </form>

           <h2>まだアカウントを持っていませんか?</h2>

        <div class="clearfix center">
            {{ link_to('register', '新規登録', 'class': 'btn btn-primary btn-large btn-success') }}
        </div>
    </div>
</div>
