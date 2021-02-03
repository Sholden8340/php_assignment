<?php require APP_ROOT . '/views/includes/head.php'; ?>
<?php require APP_ROOT . '/views/includes/nav.php'; ?>

    <main class="container">
        <h1> <?php echo $data['title']; ?></h1>
        <h2>Header 2</h2>
        <p>This is a paragraph</p>
        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th>user_id</th>
                <th>email</th>
                <th>password</th>
                <th>name</th>
                <th>registration_date</th>
                <th>role</th>
            </tr>

            </thead>
            <tbody>
            <?php

            foreach ($data['users'] as $user) {
                echo '<tr>';
                echo '<td>' . $user->user_id . '</td>';
                echo '<td>' . $user->email . '</td>';
                echo '<td>' . $user->password . '</td>';
                echo '<td>' . $user->name . '</td>';
                echo '<td>' . $user->registration_date . '</td>';
                echo '<td>' . $user->role . '</td>';
                echo '</tr>';
            }

            ?>

            </tbody>

        </table>
    </main>

<?php require APP_ROOT . '/views/includes/footer.php'; ?>