<?php
$pageTitle = 'Please Register';
require_once ('header.php'); ?>

<main class="container">
    <h1>User Registration</h1>
    <div class="alert alert-info" id="message">Please create your account</div>

    <form method="post" action="save-registration.php">
    <fieldset class="form-group">
        <label for="username" class="col-sm-2">Username:</label>
        <input name="username" id="username" required type="email" placeholder="email@email.com"  />
    </fieldset>
    <fieldset class="form-group">
        <label for="password" class="col-sm-2">Password:</label>
        <input type="password" name="password" id="password" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" />
        <span id="result"></span>
    </fieldset>
    <fieldset class="form-group">
        <label for="confirm" class="col-sm-2">Confirm Password:</label>
        <input type="password" name="confirm" id="confirm" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>
    </fieldset>
    <div class="g-recaptcha" data-sitekey="6LcPmgQTAAAAAO8CDeB-fKKVyUOikLev1GR-LORv"></div>
    <div class="col-sm-offset-2">
        <button class="btn btn-success btnRegister">Register</button>
    </div>
    </form>
</main>

<!-- google recaptcha api script -->
<script src='https://www.google.com/recaptcha/api.js'></script>

<?php require_once('footer.php'); ?>

