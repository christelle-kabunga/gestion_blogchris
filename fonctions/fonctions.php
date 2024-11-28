<?php
    /**
 * Cette fonction permet de récupérer la photo, la déplacer, et renvoyer son nom.
 * Si l'extension de la photo sélectionnée n'est pas autorisée, elle retourne 0.
 * Sinon, elle retourne le nom de la photo ou fichier.
 */
function RecuperPhoto($image, $file, $destination)
{
    // Récupération des informations du fichier temporaire
    $filetmp = $file['tmp_name'];
    
    // Extraction de l'extension du fichier
    $fileext = pathinfo($image, PATHINFO_EXTENSION);
    $fileext = strtolower($fileext); // Mettre l'extension en minuscules
    
    // Extensions autorisées
    $allowedExtensions = ['png', 'jpg', 'jpeg'];
    
    // Vérifications
    if (empty($image)) {
        return -1; // Aucun fichier sélectionné
    } elseif (!in_array($fileext, $allowedExtensions)) {
        return '0'; // Extension non autorisée
    } else {
        // Déplacement du fichier
        if (move_uploaded_file($filetmp, $destination)) {
            return $image; // Succès : on retourne le nom du fichier
        } else {
            return -2; // Erreur lors du déplacement du fichier
        }
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

