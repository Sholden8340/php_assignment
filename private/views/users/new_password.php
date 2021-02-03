<?php require APP_ROOT . '/views/includes/head.php'; ?>
<?php require APP_ROOT . '/views/includes/nav.php'; ?>
    <main class="container card card-body bg-light mt-5">

        <?php flash('register_success'); ?>
        <?php flash('error_not_logged_in'); ?>
        <?php flash(''); ?>

        <form class="form-signin" action="<?php echo URL_ROOT . '/users/new_password'; ?>" method="POST">

            <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->

            <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your new password</h1>

            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="inputPassword"
                       class="form-control <?php echo (!empty($data['password_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Password" required>
                <span class="invalid-feedback"><?php echo $data['password_error'] ?></span>
            </div>

            <div class="form-group">
                <label for="inputPasswordConfirm" class="sr-only">Confirm Password</label>
                <input type="password" id="inputPasswordConfirm" name="inputPasswordConfirm"
                       class="form-control <?php echo (!empty($data['password_confirm_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Confirm Password" required>
                <span class="invalid-feedback"><?php echo $data['password_confirm_error'] ?></span>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        </form>

    </main>
<?php require APP_ROOT . '/views/includes/footer.php'; ?>