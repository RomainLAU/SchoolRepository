<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
</head>
<body>
    <h1>List of users</h1>
    <ul>
        <?php foreach($users as $user): ?>
            <li>
                <?php echo "nom : " . $user['lastname'] . "<br> prénom : " . $user['firstname'] . "<br>" ?>
            </li>
        <?php endforeach ?>
    </ul>
</body>
</html>