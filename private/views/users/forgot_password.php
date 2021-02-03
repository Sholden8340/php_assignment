<?php require APP_ROOT . '/views/includes/head.php'; ?>
<?php require APP_ROOT . '/views/includes/nav.php'; ?>
    <main class="container card card-body bg-light mt-5">

        <?php flash('register_success'); ?>
        <?php flash('error_not_logged_in'); ?>
        <?php //flash(''); ?>

        <form class="form-signin" action="<?php echo URL_ROOT . '/users/forgot_password'; ?>" method="POST">

            <!-- <img class="mb-4" src="https://getbootstrap.com/docs/4.0/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72"> -->

            <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your email address</h1>

            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail"
                       class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Email address" required autofocus>
                <span class="invalid-feedback"><?php echo $data['email_error']; ?></span>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Reset Password</button>
        </form>

    </main>
<?php require APP_ROOT . '/views/includes/footer.php'; ?>