<?php
// include 'db_bridge.php';
// Already included in index

if (isset($_POST['save'])) {
  /* Escape values */
  foreach($_POST AS $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link, $value);
  }
  /* Add pilot */
  mysqli_query($link, "INSERT INTO `omnt_pilots` (`username`, `pilot_type`, `ship_name`) "
  . "VALUES ('{$_POST['username']}','{$_POST['pilot_type']}','{$_POST['ship_name']}')"
  ) or die(mysqli_error($link));
  $id = mysqli_insert_id($link);
  /* Add tags */
  $tags = explode(",", $_POST['tags']);
  foreach($tags as $value) {
    $val = trim($value);
    mysqli_query($link, "INSERT INTO `omnt_tags` (`type`, `object_id`, `label`) VALUES ('pilot','{$id}','{$val}')"
    ) or die(mysqli_error($link));
  }
?>
<div class="alert alert-success" role="alert">Pilot saved!</div>
<?php
}
if (isset($_POST['move'])) {
  /* Escape values */
  foreach($_POST AS $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link, $value);
  }
  /* Add location */
  mysqli_query($link, "INSERT INTO `omnt_locations` (`system_id`, `ship_id`) "
  . "VALUES ('{$_POST['coord_id']}','{$_POST['pilot_id']}')"
  ) or die(mysqli_error($link));
  $id = mysqli_insert_id($link);
?>
<div class="alert alert-success" role="alert">Location saved!</div>
<?php
}
?>
<br>
<form class="form-horizontal formfonts" action="" method="POST">
  <fieldset>
    <legend class="formfonts header">Pilot</legend>
    <div class="form-group">
      <label class="col-md-4 control-label" for="username">Username</label>
      <div class="col-md-4">
        <input id="username" name="username" placeholder="Traveller Name" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12">
        <label class="col-md-4 control-label">Category</label>
        <div class="col-md-2">
          <label class="radio-inline"><input type="radio" name="pilot_type" value="ship">Single Ship</label>
        </div>
        <div class="col-md-2">
          <label class="radio-inline"><input type="radio" name="pilot_type" value="freighter">Freighter</label>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="ship_name">Ship Name</label>
      <div class="col-md-4">
        <input id="ship_name" name="ship_name" placeholder="Nautilus" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="tags">Tags</label>
      <div class="col-md-4">
        <input id="tags" name="tags" placeholder="UFT, AGT" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="save">Save</label>
      <div class="col-md-4">
        <button id="save" name="save" class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Pilot</button>
      </div>
    </div>
  </fieldset>
</form>
<br>

<form class="form-horizontal formfonts" action="" method="POST">
  <fieldset>
    <legend class="formfonts header">Location</legend>
    <div class="form-group">
      <label class="col-md-4 control-label" for="pilor_id">Ship</label>
      <div class="col-md-4">
        <select id="pilot_id" name="pilot_id" class="selectpicker" data-live-search="true">
          <option value="0">--Select a Ship--</option>
<?php
$sql = "SELECT `pilot_id`, `ship_name` FROM `omnt_pilots`";
$query = $link->query($sql);
while ( $pins = $query->fetch_assoc() ) {
?>
          <option value="<?php echo $pins['pilot_id']; ?>"><?php echo $pins['ship_name']; ?></option>
<?php
}
?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="coord_id">System</label>
      <div class="col-md-4">
        <select id="coord_id" name="coord_id" class="selectpicker" data-live-search="true">
          <option value="0">--Select a System--</option>
<?php
$sql = "SELECT `coord_id`, `system` FROM `omnt_coords`";
$query = $link->query($sql);
while ( $pins = $query->fetch_assoc() ) {
?>
          <option value="<?php echo $pins['coord_id']; ?>"><?php echo $pins['system']; ?></option>
<?php
}
?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="move">Save</label>
      <div class="col-md-4">
        <button id="move" name="move" class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Location</button>
      </div>
    </div>
  </fieldset>
</form>
<br>
