<?php
$conn = pg_connect("host=localhost dbname=emargement user=jd password=jd");

if (!$conn) {
die("Pas de connexion à postgres");
}
?>