<?php
  require("szavazo.php");
  $sz = new szavazo;
  if ($HTTP_POST_VARS["ertek"] != "") {
    $sz->szavazas($ertek);                                # szavaz�s
    //setcookie("szavazas", "1", time()+(1*86400));       # cookie be�ll�t�sa 1 napra
    header("location: index.php?szavazas_eredmenyek");    # oldal �jrat�lt�se, eredm�nyek ki�r�s�val
  }
?>
<html>
<title>Szavaz�s</title>
<body>

<?php
  if ($QUERY_STRING == "szavazas_eredmenyek") { $sz->lista(); }
  else { if ($HTTP_COOKIE_VARS["szavazas"] == "") { $sz->kerdes(); } else { $sz->lista(); } }
?>

</body>
</html>
