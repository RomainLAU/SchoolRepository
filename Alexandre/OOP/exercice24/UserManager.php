<?php

class UserManager {

    public function createUser(string $email, string $password, $PDO) {

        function hashage(string $password) {
            $splittedPassword = str_split($password);
            foreach($splittedPassword as $chars) {
                if ($chars === 'a') {
                    $chars = 'b';
                } else if ($chars === 'b') {
                    $chars = 'c';
                } else if ($chars === 'c') {
                    $chars = 'd';
                } else if ($chars === 'd') {
                    $chars = 'e';
                } else if ($chars === 'e') {
                    $chars = 'f';
                } else if ($chars === 'f') {
                    $chars = 'g';
                } else if ($chars === 'h') {
                    $chars = 'i';
                } else if ($chars === 'i') {
                    $chars = 'j';
                }
            }
            $hashedPassword = implode($splittedPassword);
            return $hashedPassword;
        }

        $statement = $PDO->prepare("INSERT INTO book (email, password) VALUES (:email, :password)");

        $statement->execute([
            'name' => $email,
            'releaseDate' => hashage($password),
        ]);
    }
}