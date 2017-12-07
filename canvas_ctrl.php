<br>

<div class="container-fluid">
  <div class="col-md-6 text-justify mywhell">
    <!--  <input type="text" class="form-control input-sm"id="words" value="240,500" /> -->
    Coordinates: <small><i>Last is optional!</i></small><br>
    <div class="col-xs-2">
      <input type="text" class="form-control input-sm" id="xc" value="" size="5" />
    </div>
    <div class="col-xs-2">
      <input type="text" class="form-control input-sm" id="yc" value="" size="5" />
    </div>
    <div class="col-xs-2">
      <input type="text" class="form-control input-sm" id="zc" value="" size="5" />
    </div>
    <div class="col-xs-2">
      <input type="text" class="form-control input-sm" id="wc" value="0000" size="5" />
    </div>
    <!-- hex to dec -->
    <input type="hidden" class="form-control input-sm" id="rxc" value="" size="5" />
    <input type="hidden" class="form-control input-sm" id="ryc" value="" size="5" />
    <input type="hidden" class="form-control input-sm" id="rzc" value="" size="5" />
    <input type="hidden" class="form-control input-sm" id="rwc" value="" size="5" />
    <!-- / hex to dec myFunction(); -->

    <button id="entertext" onclick="ConvertToDec();" type="button" class="btn btn-primary btn-sm" >Enter</button>
  </div>
  <div class="col-md-6 text-justify mywhell">
    Display:
    <form class="form-horizontal" action="" method="POST">
      <fieldset>
        <div class="col-md-6">
          <select id="mode" name="mode" class="form-control input-sm">
            <option value="systems">Star Systems</option>
            <option value="pilots">Pilos</option>
          </select>
        </div>
        <button id="submitted" name="submitted" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </fieldset>
    </form>
  </div>
</div>
<br>
<canvas id="c" width="1024px" height="1024px"></canvas>

<script src="js/canvas_render.js"></script>
<?php

if (isset($_POST['submitted'])) {
  if ($_POST['mode'] === 'systems') {
    $sql = "SELECT * FROM `omnt_coords`";
    $query = $link->query($sql);
  } else if ($_POST['mode'] === 'pilots') {
    $sql = "SELECT * FROM `omnt_coords`"
    . " INNER JOIN `omnt_locations` ON `omnt_coords`.coord_id=`omnt_locations`.system_id"
    . " INNER JOIN `omnt_pilots` ON `omnt_locations`.ship_id=`omnt_pilots`.pilot_id";
    $query = $link->query($sql);
  }

  while ($pins = $query->fetch_assoc()) {
    $x_pin = hexdec($pins['x']) /4;
    $z_pin = hexdec($pins['z']) /4;
    $typeadjust = $z_pin + 17;

    /**/
    $pins['color'] = 'FFFFFF';
    if ($_POST['mode'] === 'systems') {
      $label = $pins['system'];
    } else if ($_POST['mode'] === 'pilots') {
      $label = $pins['ship_name'];
    }

    echo "<script>console.log('".$label.": [".$x_pin.",".$z_pin."] - ".$pins['color']."')</script>";

    echo "<script>";
    echo "context.beginPath();";
    echo "context.arc(".$x_pin.",".$z_pin.",3,0,Math.PI*2);";
    echo "context.strokeStyle='#".$pins['color']."';";
    echo "context.fillStyle='#".$pins['color']."';";
    echo "context.closePath();";
    echo "context.stroke();";
    echo "context.fill();";
    echo "context.textAlign='center';";
    echo "context.fillText('".$label."',".$x_pin.",".$typeadjust.");";
    echo "</script>";
  }
}
?>
<script>
  function myFunction() {
    location.reload();
  }
</script>
