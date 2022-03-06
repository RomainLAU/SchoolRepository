<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>

<?php

$form = $_POST;
$errors = [];

foreach($form as $key => $value) {
	if ($key == "firstname") {
		if ($value == null) {
			array_push($errors, "Le champ Prénom n'est pas rempli.");
		} if (strlen($value) < 2) {
			array_push($errors, "Le champ Prénom ne contient pas 2 caractères.");
		} if (ctype_alpha($value) == false) {
			array_push($errors, "Le champ Prénom ne contient pas uniquement des caractères alphabétiques.");
		}
	} else if ($key == "lastname") {
		if ($value == null) {
			array_push($errors, "Le champ Nom n'est pas rempli.");
		} if (strlen($value) < 2) {
			array_push($errors, "Le champ Nom ne contient pas 2 caractères.");
		} if (ctype_alpha($value) == false) {
			array_push($errors, "Le champ Nom ne contient pas uniquement des caractères alphabétiques.");
		}
	} else if ($key == "E-mail") {
		if ($value == null) {
			array_push($errors, "Le champ E-mail n'est pas rempli.");
		} if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
			array_push($errors, "Le champ E-mail n'est pas une adresse e-mail valide.");
		}
	} else if ($key == "Age") {
		if ($value == null) {
			array_push($errors, "Le champ Age n'est pas rempli.");
		} if (ctype_digit($value) == false) {
			array_push($errors, "Le champ Age ne contient pas que des chiffres.");
		} if ($value <= 13 || $value >= 160) {
			array_push($errors, "Le champ Age n'est pas valide.");
		}
	} else if ($key == "Bachelor") {
		if ($value == null) {
			array_push($errors, "Le champ Bachelor n'est pas rempli.");
		} if ($value != "dev" && $value != "business" && $value != "design") {
			array_push($errors, "Le champ Bachelor ne contient pas 'dev, 'business' ou 'design'.");
		}
	} else if ($key == "password") {
		if ($value == null) {
			array_push($errors, "Le champ Mot de passe n'est pas rempli.");
		} if (strlen($value) < 12) {
			array_push($errors, "Le champ Mot de passe ne contient pas 12 caractères.");
		}
	} else if ($key == "checked-password") {
		if ($value == null) {
			array_push($errors, "Le champ Retapez le mot de passe n'est pas rempli.");
		} if (strlen($value) < 12) {
			array_push($errors, "Le champ Retapez le mot de passe ne contient pas 12 caractères.");
		}
		if ($form[$key] != $form["password"]) {
			array_push($errors, "Le champ Retapez le mot de passe n'est pas égal au champ Mot de passe.");
		}
	} else if (!isset($form["sexe"]) && !isset($form["Tome"])){
		array_push($errors, "Le champ Sexe n'est pas rempli.");
		array_push($errors, "Le champ Tome n'est pas rempli.");
    
    } else if (!isset($form["Tome"]) && isset($form["sexe"]) && $key == "sexe"){
    	array_push($errors, "Le champ Tome n'est pas rempli.");
    
    } else if (isset($form["Tome"]) && !isset($form["sexe"]) && $key == "Tome"){
    	array_push($errors, "Le champ Sexe n'est pas rempli.");
    } 
}

if (count($errors) > 0) { ?>

	<b>Erreurs</b><br>
	<ul>
	<?php 
		foreach($errors as $sentences => $error) {
			echo("<li><b>$error</b></li>");
		}
	?>
	</ul><br>
	<img src="https://risibank.fr/cache/stickers/d311/31114-full.jpg">
<?php

} else { ?>

	<table border=1>
		<tr>
			<td>
				<b>Prénom</b>
			</td>
			<td>
				<?php
					echo($_POST['firstname']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Nom</b>
			</td>
			<td>
				<?php
					echo($_POST['lastname']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>E-mail</b>
			</td>
			<td>
				<?php
					echo($_POST['E-mail']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Age</b>
			</td>
			<td>
				<?php
					echo($_POST['Age']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Bachelor</b>
			</td>
			<td>
				<?php
					echo($_POST['Bachelor']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Mot de passe</b>
			</td>
			<td>
				<?php
					echo($_POST['password']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Mot de passe vérifié</b>
			</td>
			<td>
				<?php
					echo($_POST['checked-password']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Sexe</b>
			</td>
			<td>
				<?php
					echo($_POST['Sexe']);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Tome(s) favoris de H2B2</b>
			</td>
			<td>
				<?php
					foreach ($_POST['Tome'] as $tome) {
				        $tomes[] = $tome;
				    }    
				    $selectedTomes = implode(', ', $tomes);
				    echo($selectedTomes);
				?>
			</td>
		</tr>
		<tr>
			<td>
				<b>Commentaire</b>
			</td>
			<td>
				<?php
					echo(htmlspecialchars($form['Commentaire'], 0));
				?>
			</td>
		</tr>

	</table>

<?php

}

?>

</body>
</html>