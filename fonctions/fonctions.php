<?php

/**
 * Fonction pour récupérer la photo, la déplacer et renvoyer son nom à la base de données.
 * Si l'extension n'est pas recommandée, retourne 0.
 */
function RecuperPhoto($image, $file, $destination)
{
    $filetmp = $file['tmp_name'];
    $fileext = explode('.', $image);
    $filecheck = strtolower(end($fileext));
    $allowedExtensions = array('png', 'jpg', 'jpeg');

    if (empty($image)) {
        return -1;
    } elseif (!in_array($filecheck, $allowedExtensions)) {
        return '0';
    } else {
        move_uploaded_file($filetmp, $destination);
        return $image;
    }
}

/**
 * Fonction pour récupérer les derniers caractères dans une chaîne.
 */
function getLastCharacters($string, $num) {
    return substr($string, -$num);
}

function upload_file($name, $file, $destination, $extensions) {
    $size = 5 * 1024 * 1024; // Limite de taille de 5 Mo
    $fileerror = $file['error'];
    $filetmp = $file['tmp_name'];
    $fileext = explode('.', $name);
    $filecheck = strtolower(end($fileext));

    // Vérification de l'erreur d'upload
    if ($fileerror !== UPLOAD_ERR_OK) {
        return "Erreur lors de l'importation du fichier. Code d'erreur: " . $fileerror;
    }
}

/**
 * Cette fonction récupère les derniers caractères d'une chaîne.
 * @param string $string : Chaîne de texte
 * @param int $num : Nombre de caractères à récupérer
 * @return string
 */
function getLastCharacters($string, $num)
{
    return substr($string, -$num);
}


    // Vérification de l'extension
    if (!in_array($filecheck, $extensions)) {
        return "Le format de fichier à importer est incorrect. Le système prend en charge les formats suivants <b>" . implode(', ', $extensions) . "</b> . Veuillez réessayer.";
    }

    // Vérification de la taille du fichier
    if ($file['size'] > $size) {
        return "La taille du fichier est incorrecte. Le système prend en charge un maximum de 5 Mo. Veuillez réessayer.";
    }

    // Déplacement du fichier vers la destination
    if (!move_uploaded_file($filetmp, $destination . '/' . $name)) {
        return "Erreur lors du déplacement du fichier.";
    }

    return $name;
}
?>

