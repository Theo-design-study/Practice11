<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>

<body>
    <div class="container" style="padding-top: 64px;">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <br>
            <div class="input-field col s3">
                <input id="login" name="login" type="text" class="validate" required>
                <label for="login">Login</label>
            </div>
            <input class="btn" type="submit" value="Upload Image" name="submit">
        </form>
        <br>
        <table class="striped responsive-table blue lighten-4" style="padding-top: 64px;">
            <?php
            require_once 'include/db.php';

            $sql = 'SELECT users.id, users.first_name, users.last_name, users.login, users.img, roles.title FROM users LEFT JOIN roles ON users.id_role = roles.id';
            $users = $conn->query($sql);

            if ($users->num_rows > 0) {
                echo '<tr><th>Id</th><th>Photo</th><th>First Name</th><th>Last Name</th><th>Login</th><th>Role</th></tr>';
                while ($user = $users->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $user['id'] . '</td>';
                    echo '<td><img src="public/images/' . $user['img'] . '" width="256px" alt="User has no profile photo." /></td>';
                    echo '<td>' . $user['first_name'] . '</td>';
                    echo '<td>' . $user['last_name'] . '</td>';
                    echo '<td>' . $user['login'] . '</td>';
                    echo '<td>' . $user['title'] . '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
    </div>

</body>

</html>