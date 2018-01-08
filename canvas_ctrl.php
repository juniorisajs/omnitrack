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

    <button id="currcoord" onclick="ConvertToDec();" type="button" class="btn btn-primary btn-sm" >Enter</button>
  </div>
  <div class="col-md-6 text-justify mywhell">
    Display:
    <form class="form-horizontal" action="" method="POST">
      <fieldset>
        <div class="col-md-6">
          <select id="mode" name="mode" class="form-control input-sm">
            <option value="systems">Star Systems</option>
            <!--<option value="pilots">Pilos</option>-->
          </select>
        </div>
        <button id="display" name="display" class="btn btn-primary btn-sm" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
      </fieldset>
    </form>
  </div>
</div>
<br>
<canvas id="c" width="1024px" height="1024px"></canvas>

<script src="js/canvas_render.js"></script>
<?php
// Default mode
$mode = 'systems';

if ($mode === 'systems') {
  $sql = "SELECT * FROM `omnt_systems`";
  $query = $link->query($sql);
}/* else if ($mode === 'pilots') {
  $sql = "SELECT * FROM `omnt_systems`"
  . " INNER JOIN `omnt_locations` ON `omnt_systems`.id=`omnt_locations`.system_id"
  . " INNER JOIN `omnt_pilots` ON `omnt_locations`.ship_id=`omnt_pilots`.pilot_id";
  $query = $link->query($sql);
}*/

if (isset($query)) {
  while ($pins = $query->fetch_assoc()) {
    // $x_pin = hexdec($pins['x']) /4;
    // $z_pin = hexdec($pins['z']) /4;
    $x_pin = ($pins['voxelx'] + 2047) / 4;
    $z_pin = ($pins['voxelz'] + 2047) / 4;
    $typeadjust = $z_pin + 17;

    $pins['color'] = 'FFFFFF';
    if ($mode === 'systems') {
      $label = $pins['namepc'] ? $pins['namepc'] : $pins['namegame'] ;
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
