<?php require APP_ROOT . '/views/includes/head.php'; ?>
<?php require APP_ROOT . '/views/includes/nav.php'; ?>


    <main class="container card card-body bg-light mt-5">

        <form class="form-signin" action="<?php echo URL_ROOT . '/users/register'; ?>" method="POST">

            <h1 class="h3 mb-3 font-weight-normal text-center">Please enter your details</h1>

            <div class="form-group">
                <label for="inputName" class="sr-only">Name</label>
                <input type="text" id="inputName" name="inputName"
                       class="form-control <?php echo (!empty($data['name_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Name" value="<?php echo $data['name'] ?>" required autofocus>
                <span class="invalid-feedback"><?php echo $data['name_error'] ?></span>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="inputEmail"
                       class="form-control <?php echo (!empty($data['email_error'])) ? 'is-invalid' : '' ?>"
                       placeholder="Email address" value="<?php echo $data['email']; ?>" required>
                <span class="invalid-feedback"><?php echo $data['email_error'] ?></span>
            </div>

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

            <div class="form-group checkbox mb-3">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
        </form>

    </main>

<?php require APP_ROOT . '/views/includes/footer.php'; ?>