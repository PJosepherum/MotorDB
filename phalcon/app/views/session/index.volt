<div class="row">
    <div class="column">
        <nav aria-label="You are here:" role="navigation">
            <ul class="breadcrumbs">
                <li><a href="/">MotorDB</a></li>
                <li><span class="show-for-sr">Current: </span> Session</li>
            </ul>
        </nav>
    </div>
</div>

{{ content() }}

<div class="row">
    <div class="columns medium-6">
        <div class="row">
            <div class="column">
                <h2>Log In</h2>
             </div>
        </div>
        <div class="row">
            <div class="column">
                {{ form('session/start', 'role': 'form') }}
                <fieldset>
                <div class="row">
                    <div class="column">
                        <label for="email">User/Email</label>
                        {{ text_field('email') }}
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <label for="password">Password</label>
                        {{ password_field('password') }}
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        {{ submit_button('Login', 'class': 'button primary large') }}
                    </div>
                </div>
                </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="column medium-6">
        <div class="row">
            <div class="column">
                <h2>Register</h2>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <p>Create an account offers the following advantages:</p>
                <ul>
                    <li>Create, modify, and delete vehicles</li>
                    <li>Manage vehicle makes</li>
                    <li>Moar cool tings</li>
                </ul>
                {{ link_to('register', 'Sign Up', 'class': 'button primary large success') }}
            </div>
        </div>
    </div>
</div>
