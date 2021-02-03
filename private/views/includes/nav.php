<nav class="navbar navbar-expand-md navbar-dark bg-dark navbar-fixed-top mb-3">
    <div class="container">


        <a class="navbar-brand" href="<?php echo URL_ROOT; ?>">PHP Assignment</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
                aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">

            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/index">Home <span
                                class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo URL_ROOT; ?>/pages/about">About</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" href="<?php echo URL_ROOT; ?>/pages/projects">Projects</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link disabled" href="<?php echo URL_ROOT; ?>/pages/blog">Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="<?php echo URL_ROOT; ?>/pages/contact">Contact</a>
                </li>

            </ul>


            <!-- IF user is logged in display logout button -->
            <ul class="navbar-nav ml-auto">
                <?php if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/profile"><i
                                    class="bi bi-person-fill ms-1"></i> Welcome <?php echo $_SESSION['user_name'] ?>
                            <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/logout"><i
                                    class="bi bi-box-arrow-left ms-1"></i> Logout<span class="sr-only">(current)</span></a>
                    </li>

                <?php } else {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/register"> Register <span
                                    class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo URL_ROOT; ?>/users/login"><i
                                    class="bi bi-box-arrow-in-right ms-1"></i> Login</a>
                    </li>

                <?php } ?>
            </ul>
        </div>

    </div>
</nav>