<?php
// include 'db_bridge.php';
// Already include in index

// Get data
$str = file_get_contents('./database/galaxies.json');
$galaxies = json_decode($str, true); // decode the JSON into an associative array
$str = file_get_contents('./database/fields.json');
$fields = json_decode($str, true); // decode the JSON into an associative array
// echo '<pre>' . print_r($json, true) . '</pre>';

// Sort the fields
// function cmp($a, $b) {
//   return strcmp($a['label'], $b['label']);
// }
// usort($fields['economy'], "cmp");
// usort($fields['wealth'], "cmp");
// usort($fields['conflict'], "cmp");

// If POST data
if (isset($_POST['save'])) {
  /* Escape values */
  foreach($_POST AS $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link, $value);
  }
  $v = "Atlas Rises";

  // coord hex to voxel
  $voxelX = hexdec($_POST['xc']) - 2047;
  $voxelY = hexdec($_POST['yc']) - 127;
  $voxelZ = hexdec($_POST['zc']) - 2047;
  $ssi = hexdec($_POST['staridx']);

  /* Compute Distance to Center */
  // sqrt(VoxelX^2 + VoxelY^2 + VoxelZ^2) * 100 * 4
  // $dist = sqrt(pow(hexdec($_POST['xc']) - 2047, 2) + pow(hexdec($_POST['yc']) - 127, 2) + pow(hexdec($_POST['zc']) - 2047, 2)) * 100 * 4;
  // echo "<pre>Hex:".$_POST['xc'].",".$_POST['yc'].",".$_POST['zc']."</pre>";
  // echo "<pre>Dec:".hexdec($_POST['xc']).",".hexdec($_POST['yc']).",".hexdec($_POST['zc'])."</pre>";
  // echo "<pre>Voxel".(hexdec($_POST['xc'])- 2047).",".(hexdec($_POST['yc']) - 127).",".(hexdec($_POST['zc']) - 2047)."</pre>";
  // echo "<pre>Dist".$dist."</pre>";

  /* Add system */
  mysqli_query($link, "INSERT INTO `omnt_systems` (`namegame`,`namepc`,`discoveredpc`,`nameps4`,`discoveredps4`, `region`, `galaxy`, `voxelx`, `voxely`, `voxelz`, `ssi`, `spectral`, `planets`, `moons`, `lifeform`, `economy`, `wealth`, `conflict`, `buy`, `sell`, `version`) "
  . "VALUES ('{$_POST['namegame']}','{$_POST['namepc']}','{$_POST['discoveredpc']}','{$_POST['nameps4']}','{$_POST['discoveredps4']}',"
  . "'{$_POST['region']}','{$_POST['galaxy']}','{$voxelX}','{$voxelY}','{$voxelZ}','{$ssi}',"
  . "'{$_POST['spectral']}','{$_POST['planets']}','{$_POST['moons']}','{$_POST['lifeform']}','{$_POST['economy']}','{$_POST['wealth']}','{$_POST['conflict']}',"
  . "'{$_POST['buy']}','{$_POST['sell']}','{$v}')"
  ) or die(mysqli_error($link));
?>
<div class="alert alert-success" role="alert">Star system saved!</div>
<?php
}
?>
<br>
<form class="form-horizontal formfonts" action="" method="POST">
  <fieldset>
    <legend class="formfonts header">Star System</legend>
    <div class="form-group">
      <label class="col-md-2 control-label">Coordinates</label>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="xc" name="xc" maxlength="4" placeholder="0000" />
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="yc" name="yc" maxlength="4" placeholder="0000"/>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="zc" name="zc" maxlength="4" placeholder="0000"/>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="staridx" name="staridx" maxlength="4" placeholder="0000"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="namegame">Original Name</label>
      <div class="col-md-8">
        <input id="namegame" name="namegame" placeholder="Tashilkulovat XV" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="namepc">PC: Named</label>
      <div class="col-md-4">
        <input id="namepc" name="namepc" placeholder="Pilgrim Star" class="form-control input-md" type="text">
      </div>
      <div class="col-md-1">
        <label class="col-md-2 control-label" for="discoveredpc">by</label>
      </div>
      <div class="col-md-3">
        <input id="discoveredpc" name="discoveredpc" placeholder="knightmb" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="nameps4">PS4: Named</label>
      <div class="col-md-4">
        <input id="nameps4" name="nameps4" placeholder="Starfall" class="form-control input-md" type="text">
      </div>
      <div class="col-md-1">
        <label class="col-md-2 control-label" for="discoveredps4">by</label>
      </div>
      <div class="col-md-3">
        <input id="discoveredps4" name="discoveredps4" placeholder="St3amb0t" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="region">Region Name</label>
      <div class="col-md-8">
        <input id="region" name="region" placeholder="Ocopadica" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="galaxy">Galaxy</label>
      <div class="col-md-8">
        <select id="galaxy" name="galaxy" class="form-control">
<?php
foreach($galaxies AS $i => $g) {
  echo "<option value='".$i."'>".$g."</option>";
}
 ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="spectral">Spectral Class</label>
      <div class="col-md-8">
        <input id="spectral" name="spectral" placeholder="G8f" class="form-control input-md" type="text" maxlength="4">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="planets">Planets</label>
      <div class="col-md-2">
        <input id="planets" name="planets" value="4" class="form-control input-md" type="text">
      </div>
      <div class="col-md-2"><!--space--></div>
      <label class="col-md-2 control-label" for="moons">Moons</label>
      <div class="col-md-2">
        <input id="moons" name="moons" value="0" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="economy">Economy</label>
      <div class="col-md-3">
        <select id="economy" name="economy" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['economy'] AS $i => $f) {
  echo "<option value='".$i."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
      <label class="col-md-2 control-label" for="wealth">Wealth</label>
      <div class="col-md-3">
        <select id="wealth" name="wealth" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['wealth'] AS $i => $f) {
  echo "<option value='".$i."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="conflict">Conflict</label>
      <div class="col-md-3">
        <select id="conflict" name="conflict" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['conflict'] AS $i => $f) {
  echo "<option value='".$i."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
      <label class="col-md-2 control-label" for="lifeform">Lifeform</label>
      <div class="col-md-3">
        <select id="lifeform" name="lifeform" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['lifeform'] AS $i => $f) {
  echo "<option value='".$i."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="sell">Sell (%)</label>
      <div class="col-md-2">
        <input id="sell" name="sell" value="null" class="form-control input-md" type="text">
      </div>
      <div class="col-md-2"><!--space--></div>
      <label class="col-md-2 control-label" for="buy">Buy (%)</label>
      <div class="col-md-2">
        <input id="buy" name="buy" value="null" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="save">Save</label>
      <div class="col-md-8">
        <button id="save" name="save" class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Star System</button>
      </div>
    </div>
  </fieldset>
<br>
