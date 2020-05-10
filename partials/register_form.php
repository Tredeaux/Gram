<form action="PHP/register.php" method="POST">
    <div id="register_form" style="display:none;" class="card cardActive">
        <p style="font-size:25px;">Register</p>
        <input autocomplete="off" name="username" type="text" placeholder="Enter your username" required />
        <br><br>
        <input autocomplete="off" name="email" type="email" placeholder="Enter your email" required />
        <br><br>
        <input name="password" id="psw1" title="Uppercase, Lowercase, number, more than 8"
            pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" type="Password" placeholder="Password" required />
        <br><br>
        <input name="password2" id="psw2" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" oninput="checkPasswordMatch()"
            type="password" placeholder="Re-type password" required />
        <p id="confirmation"></p>
        <br>
        <input type="submit">
        <div style="text-align:center;">
            <p>Already have an account? <a onclick="showLogin()">Log in</a></p>                    
        </div>
    </div>

</form>
