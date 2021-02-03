<?php require APP_ROOT . '/views/includes/head.php'; ?>
<?php require APP_ROOT . '/views/includes/nav.php'; ?>

    <main class="container card card-body bg-light mt-5">

        <?php flash('register_success'); ?>
        <?php flash('error_not_logged_in'); ?>
        <?php flash('password_reset'); ?>
        <?php flash('password_reset_email'); ?>

        <form class="form-signin" action="<?php echo URL_ROOT . '/users/login'; ?>" method="POST">

            <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->

            <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>

            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail"
                       class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Email address" value="<?php echo $data['email']; ?>" required autofocus>
                <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
            </div>

            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword"
                       class="form-control  <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Password" required>
                <span class="invalid-feedback"><?php echo $data['password_error'] ?></span>
            </div>

            <div class="form-group checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <div id="formFooter">
                <a class="underlineHover" href="<?php echo URL_ROOT . '/users/forgot_password' ?>">Forgot Password?</a>
            </div>
        </form>

    </main>

<?php require APP_ROOT . '/views/includes/footer.php'; ?>