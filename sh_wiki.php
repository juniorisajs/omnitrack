<?php
// $_POST $galaxies $fields $voxelX $voxelY $voxelZ $ssi

// page name
$name = $_POST['namegame'];
$discovered = '';
if ($_POST['namepc'] !== '') {
  $name = $_POST['namepc'];
  if ($_POST['discoveredpc'] !== '') {
    $discovered = $_POST['discoveredpc']." (PC) ";
  }
} else if ($_POST['nameps4'] !== '') {
  $name = $_POST['nameps4'];
  if ($_POST['discoveredps4'] !== '') {
    $discovered = $_POST['discoveredps4']." (PS4) ";
  }
}

/* Compute Distance to Center */
$dist = (int)(sqrt(pow($voxelX, 2) + pow($voxelY, 2) + pow($voxelZ, 2)) * 100 * 4);

// Voxel to Glyph
$staridx = str_pad(strtoupper(dechex($ssi)), 4, "0", STR_PAD_LEFT);
$gidx = substr($staridx, 1);
$gx = str_pad(strtoupper(dechex((($voxelX + 2047) + 2049) % 4096)), 3, "0", STR_PAD_LEFT);
$gy = str_pad(strtoupper(dechex((($voxelY + 127) + 129) % 256)), 2, "0", STR_PAD_LEFT);
$gz = str_pad(strtoupper(dechex((($voxelZ + 2047) + 2049) % 4096)), 3, "0", STR_PAD_LEFT);

// Wiki string
$wiki = "{{Version|".$v."}}
{{System infobox
| image = ".$name.".jpg
| region = ".$_POST['region']."
| galaxy = ".$galaxies[$_POST['galaxy']]."
| class = ".$_POST['spectral']."
| distance = ".number_format($dist)."
| planet = ".$_POST['planets']."
| moon = ".$_POST['moons']."
| faction = ".$fields['lifeform'][$_POST['lifeform']]['label']."
| economy = ".$fields['economy'][$_POST['economy']]['label']."
| wealth = ".$fields['wealth'][$_POST['wealth']]['label']."
| conflict = ".$fields['conflict'][$_POST['conflict']]['label']."
| discovered = ".$discovered."
| release = ".$v."
}}
'''".$name."''' is a star system.

==Summary==
'''".$name."''' is a procedurally generated [[star system]] in the PC  universe of ''[[No Man's Sky]]''.

== Alias names ==
{{alias|platform=PC/PS4|text=Original|name=".$_POST['namegame']."}}
";
if ($_POST['namepc'] !== null) {
  $wiki .= "{{alias|platform=PC|text=Current|name=".$_POST['namepc']."}}
";
}
if ($_POST['nameps4'] !== '') {
  $wiki .= "{{alias|platform=PS4|text=Current|name=".$_POST['nameps4']."}}
";
}

$wiki .= "
== Planets & Moons ==
";
for ($i=0;$i<(int)$_POST['planets'];$i=$i+1) {
  $wiki .= "*{{link|P".($i+1)."}}
";
}
for ($i=0;$i<(int)$_POST['moons'];$i=$i+1) {
  $wiki .= "*{{link|M".($i+1)."}}
";
}

$wiki.="
==Coordinates==
{{Coords|".$_POST['xc']."|".$_POST['yc']."|".$_POST['zc']."|".$_POST['staridx']."}}
{{Portals|0|".$gidx[0]."|".$gidx[1]."|".$gidx[2]."|".$gy[0]."|".$gy[1]."|";
$wiki.=$gz[0]."|".$gz[1]."|".$gz[2]."|".$gx[0]."|".$gx[1]."|".$gx[2]."}}
<sub>* Exchange the first glyph with the planet index</sub>

== Space Stations ==
=== Galactic Trade Terminal ===
* Economy: ".$fields['economy'][$_POST['economy']]['tier']." (".$fields['wealth'][$_POST['wealth']]['color'].")
* Sell: ".$_POST['sell']."%
* Buy: ".$_POST['buy']."%

==Navigator==
{{".$_POST['region']." nav}}

[[Category:Star systems]]
[[Category:".$_POST['region']."]]
[[Category:".$name."]]";

?>
<!-- include button-->
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#wiki-string" aria-expanded="false" aria-controls="wiki-string">
  Show wiki template
</button>
<div class="collapse" id="wiki-string">
  <pre><?php echo $wiki; ?></pre>
</div>
