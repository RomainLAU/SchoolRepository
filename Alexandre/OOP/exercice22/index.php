<?php

$iteration = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">

        <input type="text" name="lastname" placeholder="lastname">
        <input type="text" name="firstname" placeholder="firstname">
        <input type="email" name="email" placeholder="email">
        <input type="number" name="age" placeholder="age">

        <input type="submit" placeholder="Envoyer" name="$account<?php $iteration+=1; echo $iteration; ?>">
    </form>
</body>
</html>

<?php

class User {

    public string $lastname;
    public string $firstname;
    public string $email;
    public int $age;

    public function __construct(string $lastname, string $firstname, string $email, int $age) {

        $this->lastname = $lastname;
        $this->firstname = $firstname;
        $this->email = $email;
        $this->age = $age;
        
    }

}

if (isset($_POST['lastname'])) {

    $account1 = new User($_POST['lastname'], $_POST['firstname'], $_POST['email'], $_POST['age']);

    echo "Bonjour " . $account1->firstname . " " . $account1->lastname . ". Nous vous contacterons via votre adresse : " . $account1->email . " Sauf si vous avez moins de 18 ans, mais nous voyons que vous avez " . $account1->age . " ans donc tout va bien ! :D";

}