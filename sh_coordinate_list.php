<?php
// include 'db_bridge.php';
// already included in index
// Get data
$str = file_get_contents('./database/galaxies.json');
$galaxies = json_decode($str, true); // decode the JSON into an associative array
$str = file_get_contents('./database/fields.json');
$fields = json_decode($str, true); // decode the JSON into an associative array
?>
<br>
<div class="container formfonts resp-table">
  <h2><i class="fa fa-flag" aria-hidden="true"></i> Shared Places </h2>
  <p>Get more information about places to go!</p>
  <hr>
  <br>

  <div class="table-responsive">
    <table class="table table-hover ">
      <thead>
        <tr>
          <th>Name</th>
          <th>PC(by)</th>
          <th>PS4(by)</th>
          <th>Region</th>
          <th>Galaxy</th>
          <th>Coordinates</th>
          <th>Glyphs</th>
          <th>Distance</th>
          <th>Spectral (color)</th>
          <th>Planets(Moons)</th>
          <th>Lifeform</th>
          <th>Economy (tier)</th>
          <th>Wealth (lvl)</th>
          <th>Sell // Buy</th>
          <th>Conflict (lvl)</th>
          <th>Version</th>
        </tr>
      </thead>
      <tbody>
<?php
$num_rec_per_page=10;
if (isset($_GET["page"])) { $page = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_rec_per_page;
$sql = "SELECT * FROM `omnt_systems` LIMIT $start_from, $num_rec_per_page";
$query = $link->query($sql);

while ( $pins = $query->fetch_assoc() ) {
  // Voxel to hex
  $x = str_pad(strtoupper(dechex($pins['voxelx'] + 2047)), 4, "0", STR_PAD_LEFT);
  $y = str_pad(strtoupper(dechex($pins['voxely'] + 127)), 4, "0", STR_PAD_LEFT);
  $z = str_pad(strtoupper(dechex($pins['voxelz'] + 2047)), 4, "0", STR_PAD_LEFT);
  $staridx = str_pad(strtoupper(dechex($pins['ssi'])), 4, "0", STR_PAD_LEFT);
  // Voxel to Glyphs
  $gidx = substr($staridx, 1);
  $gx = strtoupper(dechex((($pins['voxelx'] + 2047) + 2049) % 4096));
  $gy = strtoupper(dechex((($pins['voxely'] + 127) + 129) % 254));
  $gz = strtoupper(dechex((($pins['voxelz'] + 2047) + 2049) % 4096));
  /* Compute Distance to Center */
  // sqrt(VoxelX^2 + VoxelY^2 + VoxelZ^2) * 100 * 4
  $dist = sqrt(pow($pins['voxelx'], 2) + pow($pins['voxely'], 2) + pow($pins['voxelz'], 2)) * 100 * 4;
  // echo "<pre>Hex:".$_POST['xc'].",".$_POST['yc'].",".$_POST['zc']."</pre>";
  // echo "<pre>Dec:".hexdec($_POST['xc']).",".hexdec($_POST['yc']).",".hexdec($_POST['zc'])."</pre>";
  // echo "<pre>Voxel".(hexdec($_POST['xc'])- 2047).",".(hexdec($_POST['yc']) - 127).",".(hexdec($_POST['zc']) - 2047)."</pre>";
  // echo "<pre>Dist".$dist."</pre>";

?>
    <tr class="lists">
      <td><?php echo $pins['namegame']; ?></td>
      <td><?php echo $pins['namepc'].'('.$pins['discoveredpc'].')'; ?></td>
      <td><?php echo $pins['nameps4'].'('.$pins['discoveredps4'].')'; ?></td>
      <td><?php echo $pins['region']; ?></td>
      <td><?php echo $galaxies[$pins['galaxy']]; ?></td>
      <td><?php echo $x.":".$y.":".$z.":".$staridx; ?></td>
      <td><?php echo "0 ".$gidx." ".$gy." ".$gz." ".$gx; ?></td>
      <td><?php echo number_format($dist).'LY'; ?></td>
      <td><?php echo $pins['spectral'].' ('.$fields['color'][$pins['spectral'][0]]['label'].')'; ?></td>
      <td><?php echo $pins['planets'].'('.$pins['moons'].')'; ?></td>
      <td><?php echo $fields['lifeform'][$pins['lifeform']]['label']; ?></td>
      <td><?php echo $fields['economy'][$pins['economy']]['label']."(".$fields['economy'][$pins['economy']]['tier'].")"; ?></td>
      <td><?php echo $fields['wealth'][$pins['wealth']]['label']."(".$fields['wealth'][$pins['wealth']]['color'].")"; ?></td>
      <td><?php echo $pins['sell']."% // ".$pins['buy']."%"; ?></td>
      <td><?php echo $fields['conflict'][$pins['conflict']]['label']."(".$fields['conflict'][$pins['conflict']]['color'].")"; ?></td>
      <td><?php echo $pins['version']; ?></td>
    </tr>
<?php } ?>
      </tbody>
    </table>
<?php
$sql = "SELECT * FROM `omnt_systems`";
$rs_result = mysqli_query($link,$sql); //run the query
$total_records = mysqli_num_rows($rs_result);  //count number of records
$total_pages = ceil($total_records / $num_rec_per_page);
?>
  </div>
</div>

<nav aria-label="Page navigation">
  <ul class="pagination">
    <li>
      <span aria-hidden="true">
<?php
echo "<a href='index.php?p=2&page=1'>".'<'."</a> "; // Goto 1st page
?>
      </span>
    </li>
<?php
for ($i=1; $i<=$total_pages; $i++) {
  echo "<li><a href='index.php?p=2&page=".$i."'>".$i."</a></li> ";
};
?>
    <li>
      <span aria-hidden="true">
<?php
echo "<a href='index.php?p=2&page=$total_pages'>".'>'."</a> "; // Goto last page
?>
      </span>
    </li>
  </ul>
</nav>
