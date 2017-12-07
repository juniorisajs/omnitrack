<?php
// include 'db_bridge.php';
// Already include in index

if (isset($_POST['save'])) {
  /* Escape values */
  foreach($_POST AS $key => $value) {
    $_POST[$key] = mysqli_real_escape_string($link, $value);
  }
  /* Add system */
  mysqli_query($link, "INSERT INTO `omnt_coords` (`username`, `x`, `y`, `z`, `w`, `class`, `system`, `region`, `galaxy`, `platform`) "
  . "VALUES ('{$_POST['username']}','{$_POST['xc']}','{$_POST['yc']}','{$_POST['zc']}','{$_POST['wc']}',"
  . "'{$_POST['class']}','{$_POST['system']}','{$_POST['region']}','{$_POST['galaxy']}','{$_POST['platform']}')"
  ) or die(mysqli_error($link));
  $id = mysqli_insert_id($link);
  /* Add tags */
  $tags = explode(",", $_POST['tags']);
  foreach($tags as $value) {
    $val = trim($value);
    mysqli_query($link, "INSERT INTO `omnt_tags` (`type`, `object_id`, `label`) VALUES ('system','{$id}','{$val}')"
    ) or die(mysqli_error($link));
  }
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
      <label class="col-md-4 control-label" for="system">System name</label>
      <div class="col-md-4">
        <input id="system" name="system" placeholder="Pilgrim" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-12 ">
        <label class="col-md-4 control-label">Coordinates</label>
        <div class="col-md-1">
          <input type="text" class="form-control input-sm" id="xc" name="xc"  size="5"  placeholder="0000" />
        </div>
        <div class="col-md-1">
          <input type="text" class="form-control input-sm" id="yc" name="yc"  size="5"  placeholder="0000"/>
        </div>
        <div class="col-md-1">
          <input type="text" class="form-control input-sm" id="zc" name="zc"  size="5"  placeholder="0000"/>
        </div>
        <div class="col-md-1">
          <input type="text" class="form-control input-sm" id="wc" name="wc" size="5"  placeholder="0000"/>
        </div>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="class">Star Class</label>
      <div class="col-md-4">
        <input id="class" name="class" placeholder="F" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="region">Region Name</label>
      <div class="col-md-4">
        <input id="region" name="region" placeholder="Ocopadica" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="galaxy">Galaxy name</label>
      <div class="col-md-4">
        <input id="galaxy" name="galaxy" placeholder="Euclid" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="tags">Tags</label>
      <div class="col-md-4">
        <input id="tags" name="tags" placeholder="UFT, AGT, Base, Atlas" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="username">Discovered by</label>
      <div class="col-md-4">
        <input id="username" name="username" placeholder="Traveller Name" class="form-control input-md" type="text">
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="platform">Platform</label>
      <div class="col-md-4">
        <select id="platform" name="platform" class="form-control">
          <option value="PC">PC</option>
          <option value="PS4">PS4</option>
        </select>
      </div>
    </div>
    <div class="form-group">
      <label class="col-md-4 control-label" for="save">Save</label>
      <div class="col-md-4">
        <button id="save" name="save" class="btn btn-primary" type="submit"><i class="fa fa-floppy-o" aria-hidden="true"></i> Save Star System</button>
      </div>
    </div>
  </fieldset>
<br>
