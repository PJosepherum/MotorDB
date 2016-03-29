<div class="row">
    <div class="column">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <li><a href="/">MotorDB</a></li>
                <li><span class="show-for-sr">Current: </span> Register</li>
            </ul>
        </nav>
    </div>
</div>

{{ content() }}

<div class="row">
    <div class="column">
        <h1>Register</h1>
    </div>
</div>
<div class="row">
    <div class="column">
        <h2>Create an account</h2>
    </div>
</div>

{{ form('register', 'id': 'registerForm', 'onbeforesubmit': 'return false') }}

    <fieldset>

        <div class="row">
            <div class="column">
                {{ form.label('username') }}
                {{ form.render('username', ['placeholder': 'foobar']) }}
                <p class="callout alert hide" id="usernameHelpText">Username is unavailable.</p>
            </div>
        </div>

        <div class="row">
            <div class="column">
                {{ form.label('email') }}
                {{ form.render('email', ['placeholder': 'foo@bar.com']) }}
                <p class="callout alert hide" id="emailPasswordHelpText">Email address is incorrectly formatted.</p>
            </div>
        </div>

        <div class="row">
            <div class="column">
                {{ form.label('password') }}
                {{ form.render('password', ['placeholder': 'password']) }}
                <p class="callout alert hide" id="passwordHelpText">Passwords must be at least 8 characters.</p>
            </div>
        </div>

        <div class="row">
            <div class="column">
                <label class="control-label" for="repeatPassword">Repeat Password</label>
                {{ password_field('repeatPassword', 'placeholder': 'password') }}
                <p class="callout alert hide" id="repeatPasswordHelpText">Passwords do not match.</p>
            </div>
        </div>

        <div class="row">
                <div class="column">
                <p class="callout warning" id="repeatPasswordHelpText">By signing up, you accept terms of use and privacy policy.</p>
                {{ submit_button('Register', 'class': 'button primary', 'onclick': 'return SignUp.validate();') }}
            </div>
        </div>

    </fieldset>
</form>
