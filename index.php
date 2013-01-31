<?php
  require("szavazo.php");
  $sz = new szavazo;
  if ($HTTP_POST_VARS["ertek"] != "") {
    $sz->szavazas($ertek);                                # szavazás
    //setcookie("szavazas", "1", time()+(1*86400));       # cookie beállítása 1 napra
    header("location: index.php?szavazas_eredmenyek");    # oldal újratöltése, eredmények kiírásával
  }
?>
<html>
<title>Szavazás</title>
<body>

<?php
  if ($QUERY_STRING == "szavazas_eredmenyek") { $sz->lista(); }
  else { if ($HTTP_COOKIE_VARS["szavazas"] == "") { $sz->kerdes(); } else { $sz->lista(); } }
?>

</body>
</html>
