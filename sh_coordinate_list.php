<?php
// include 'db_bridge.php';
// already included in index
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
          <th>Shared by:</th>
          <th>Coordinate</th>
          <th>Class</th>
          <th>System</th>
          <th>Region</th>
          <th>Galaxy</th>
          <th>Platform</th>
        </tr>
      </thead>
      <tbody>
<?php
$num_rec_per_page=10;
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $num_rec_per_page;
$sql = "SELECT * FROM `omnt_coords` LIMIT $start_from, $num_rec_per_page";
$query = $link->query($sql);

while ( $pins = $query->fetch_assoc() ) {
?>
    <tr class="lists">
      <td><?php echo $pins['username']; ?></td>
      <td><?php echo $pins['x'].":".$pins['y'].":".$pins['z'].":".$pins['w']; ?></td>
      <td><?php echo $pins['class']; ?></td>
      <td><?php echo $pins['system']; ?></td>
      <td><?php echo $pins['region']; ?></td>
      <td><?php echo $pins['galaxy']; ?></td>
      <td><?php echo $pins['platform']; ?></td>
    </tr>
<?php } ?>
      </tbody>
    </table>
<?php
$sql = "SELECT * FROM `omnt_coords`";
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
