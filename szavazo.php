<?php


class szavazo {

var $csikmeret = 1.5;     // eredményeknél a csíkok mérete

function open_szavazo_txt() {
// adatok beolvasása
 if (file_exists("szavazo.txt")) {
  $fajl = fopen("szavazo.txt", "r");
  $sor = fgets($fajl, 5120); $sor = trim($sor); $this->adatok = explode("|", $sor);
  fclose($fajl);
 }
}

function open_kerdes_txt() {
// adatok beolvasása
 $a = -1;
 if (file_exists("kerdes.txt")) {
  $fajl = fopen("kerdes.txt", "r");
  $sor = fgets($fajl, 5120); $this->kerdes = trim($sor);
  $a = -1;
  while (!feof($fajl)) { $sor = trim(fgets($fajl, 5120)); $a++; $this->valasz[$a] = $sor; }
  fclose($fajl);
 }
 $this->vno = $a;
}

function szavazas($ertek) {
  $this->open_kerdes_txt();
  $this->open_szavazo_txt();

// megfelelõ érték növelése
  $this->adatok[$ertek]++;
  $fajl = fopen("szavazo.txt", "w");
  $string = ""; $b = $this->vno;
  for ($a = 0; $a <= $b; $a++) { $string .= $this->adatok[$a]."|"; }
  fputs($fajl, $string);
  fclose($fajl);
}

function lista() {
  $this->open_szavazo_txt();
  $this->open_kerdes_txt();

// számolás [összes szavazat, grafikonok hossza, százalék)
  $this->ossz = 0; $b = $this->vno;
  for ($a = 0; $a <= $b; $a++) { $this->ossz += $this->adatok[$a]; }
  if ($this->ossz == 0) { $this->ossz = 1; }
// eredmények kiírása
  echo "<table width=50% border=1 bordercolor=#cccccc cellpadding=5 cellspacing=2>\n";
  echo "<tr><th colspan=2>".$this->kerdes."</th></tr>\n";
  for ($a = 0; $a <= $b; $a++) {
    $this->szazalek[$a] = round(($this->adatok[$a] / $this->ossz) * 100);
    $this->hossz[$a] = $this->szazalek[$a] * $this->csikmeret;
    echo "<tr><td width=50%>".$this->valasz[$a]."</td><td><img src=szin$a.gif width=".$this->hossz[$a]." height=10> (".$this->szazalek[$a]." %)</td>\n";
  }
  echo "<tr><td colspan=2 align=center>Összesen <b>".$this->ossz."</b> válasz érkezett.</td></tr>\n";
  echo "</table>\n";
}

function kerdes() {
  $this->open_kerdes_txt();

// kérdés és válaszok kiírása
  echo "<form name=szavazas action=index.php method=post>\n";
  echo " :: <b>Kérdés</b> :: ".$this->kerdes."<br>\n";
  $b = $this->vno;
  for ($a = 0; $a <= $b; $a++) { echo " <input type=radio name=ertek value=$a>&nbsp;".$this->valasz[$a]."<br>\n"; }
  echo " <input type=submit value='Választás'><br>\n";
  echo "</form>\n";
  echo "<a href=index.php?szavazas_eredmenyek>Eredmények</a><br><br>\n";
}

}
?>
