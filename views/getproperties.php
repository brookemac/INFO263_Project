<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 100%
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px
}

th {text-align: left;}
</style>
</head>
<body>

<?php
require_once "../database/database_client.php";
$q = $_GET['q'];



mysqli_select_db($mysqli, 'info263_front_project');
$sql = "SELECT * FROM info263_front_project.vw_display_view WHERE event_name like '%{$q}%'";
$result = mysqli_query($mysqli, $sql);

echo "<table>
<tr>
<th>Event-name</th>
<th>Cluster-Name</th>
<th>Date</th>
<th>Time</th>
<th>Activate</th>
<th>Machine-group</th>
<th>Time-offset</th>
<th>Event-id</th>
<th>Group-id</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row["event_name"] . "</td>";
    echo "<td>" . $row['cluster_name'] . "</td>";
    echo "<td>" . $row['date'] . "</td>";
    echo "<td>" . $row['time'] . "</td>";
    echo "<td>" . $row['activate'] . "</td>";
    echo "<td>" . $row['machine_group'] . "</td>";
    echo "<td>" . $row['time_offset'] . "</td>";
    echo "<td>" . $row['event_id'] . "</td>";
    echo "<td>" . $row['group_id'] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($mysqli);
?>
</body>
</html>


