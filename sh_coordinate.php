<?php
// include 'db_bridge.php';
// Already include in index

// Get data
$str = file_get_contents('./database/galaxies.json');
$galaxies = json_decode($str, true); // decode the JSON into an associative array
$str = file_get_contents('./database/fields.json');
$fields = json_decode($str, true); // decode the JSON into an associative array
// Sort the fields
function cmp($a, $b) {
  return strcmp($a['label'], $b['label']);
}
usort($fields['economy'], "cmp");
usort($fields['wealth'], "cmp");
usort($fields['conflict'], "cmp");
// echo '<pre>' . print_r($json, true) . '</pre>';

if (isset($_POST['save'])) {
  /* Escape values */
  foreach($_POST AS $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link, $value);
  }
  /* Compute Distance to Center */
  // sqrt(VoxelX^2 + VoxelY^2 + VoxelZ^2) * 100 * 4
  $dist = sqrt(pow(hexdec($_POST['xc']) - 2047, 2) + pow(hexdec($_POST['yc']) - 127, 2) + pow(hexdec($_POST['zc']) - 2047, 2)) * 100 * 4;
  // echo "<pre>Hex:".$_POST['xc'].",".$_POST['yc'].",".$_POST['zc']."</pre>";
  // echo "<pre>Dec:".hexdec($_POST['xc']).",".hexdec($_POST['yc']).",".hexdec($_POST['zc'])."</pre>";
  // echo "<pre>Voxel".(hexdec($_POST['xc'])- 2047).",".(hexdec($_POST['yc']) - 127).",".(hexdec($_POST['zc']) - 2047)."</pre>";
  // echo "<pre>Dist".$dist."</pre>";

  /* Add system */
  mysqli_query($link, "INSERT INTO `omnt_systems` (`name`, `region`, `galaxy`, `x`, `y`, `z`, `w`, `color`, `distance`, `planets`, `moons`, `lifeform`, `economy`, `wealth`, `conflict`, `discovered`, `alliance`, `mode`, `platform`) "
  . "VALUES ('{$_POST['name']}','{$_POST['region']}','{$_POST['galaxy']}','{$_POST['xc']}','{$_POST['yc']}','{$_POST['zc']}','{$_POST['wc']}',"
  . "'{$_POST['color']}','{$dist}','{$_POST['planets']}','{$_POST['moons']}','{$_POST['lifeform']}','{$_POST['economy']}','{$_POST['wealth']}','{$_POST['conflict']}',"
  . "'{$_POST['discovered']}','{$_POST['alliance']}','{$_POST['mode']}','{$_POST['platform']}')"
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
      <label class="col-md-2 control-label" for="name">System Name</label>
      <div class="col-md-8">
        <input id="name" name="name" placeholder="Pilgrim" class="form-control input-md" type="text">
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
foreach($galaxies AS $g) {
  echo "<option value='".$g."'>".$g."</option>";
}
 ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label">Coordinates</label>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="xc" name="xc"  size="5"  placeholder="0000" />
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="yc" name="yc"  size="5"  placeholder="0000"/>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="zc" name="zc"  size="5"  placeholder="0000"/>
      </div>
      <div class="col-md-2">
        <input type="text" class="form-control input-sm" id="wc" name="wc" size="5"  placeholder="0000"/>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="color">Star Color</label>
      <div class="col-md-8">
        <select id="color" name="color" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['color'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
}
 ?>
        </select>
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
foreach( $fields['economy'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
      <label class="col-md-2 control-label" for="wealth">Wealth</label>
      <div class="col-md-3">
        <select id="wealth" name="wealth" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['wealth'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
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
foreach($fields['conflict'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
      <label class="col-md-2 control-label" for="lifeform">Lifeform</label>
      <div class="col-md-3">
        <select id="lifeform" name="lifeform" class="form-control">
          <option value="null">--unknown--</option>
<?php
foreach($fields['lifeform'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="discovered">Discovered by</label>
      <div class="col-md-3">
        <input id="discovered" name="discovered" placeholder="Player" class="form-control input-md" type="text">
      </div>
      <label class="col-md-2 control-label" for="alliance">Alliance</label>
      <div class="col-md-3">
        <input id="alliance" name="alliance" placeholder="AGT, UFT" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-2 control-label" for="mode">Mode</label>
      <div class="col-md-3">
        <select id="mode" name="mode" class="form-control">
<?php
foreach($fields['mode'] AS $f) {
  echo "<option value='".$f['label']."'>".$f['label']."</option>";
}
 ?>
        </select>
      </div>
      <label class="col-md-2 control-label" for="platform">Platform</label>
      <div class="col-md-3">
        <select id="platform" name="platform" class="form-control">
          <option value="PC">PC</option>
          <option value="PS4">PS4</option>
        </select>
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
