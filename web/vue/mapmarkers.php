<?php

function parseToXML($htmlStr)
{
    $xmlStr = str_replace('<', '&lt;', $htmlStr);
    $xmlStr = str_replace('>', '&gt;', $xmlStr);
    $xmlStr = str_replace('"', '&quot;', $xmlStr);
    $xmlStr = str_replace("'", '&#39;', $xmlStr);
    $xmlStr = str_replace("&", '&amp;', $xmlStr);
    return $xmlStr;
}

try {
    $bdd = new PDO('mysql:host=localhost;dbname=agence;charset=utf8', 'root', '');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Select all the rows in the markers table
$query = $bdd->query('SELECT nomAgence, nomVille, lat, lng FROM adresse INNER JOIN agence a ON adresse.id = a.adresse_id');

header("Content-type: text/xml");
// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row = $query->fetch()) {
    // Add to XML document node
    echo '<marker ';
    echo 'name="' . parseToXML($row['nomAgence']) . '" ';
    echo 'address="' . parseToXML($row['nomVille']) . '" ';
    echo 'lat="' . $row['lat'] . '" ';
    echo 'lng="' . $row['lng'] . '" ';
    echo '/>';
}
echo '</markers>';

?>