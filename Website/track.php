
<?php
/**
 * Created by PhpStorm.
 * User: SUJAN HASAN
 * Date: 3/25/2019
 * Time: 12:48 AM
 */
?>
<?php
include 'lib/config.php';
include 'lib/mydatabase.php';
require 'home.php';
$db=new Database();

$output="";
echo "<h1>'$atm_no'</h1>";
$query="SELECT * FROM buses WHERE Bus_id='$atm_no'";
$result= $db->getLocation($con, $query);
if(mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_assoc($result)){
        $output.="<input type='text' id='lat_loc' value='".$row['lat']."'>";
        $output.="<input type='text' id='lan_loc' value='".$row['lon']."'>";
    }
    echo $output;
}

?>
