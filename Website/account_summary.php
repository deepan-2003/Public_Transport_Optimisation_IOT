<?php
require_once 'server_connect.inc.php';
   /* server connection  */
require_once 'get_logged.inc.php';
/* require to be logged in */


/* check whether that session is login or not */
if(@($_SESSION['emp_id']==null || $_SESSION['emp_id']=="") && (@($_SESSION['atm']==null ||$_SESSION['atm']=="") || @($_SESSION['pin']==null ||$_SESSION['pin']=="")))
{
die(header('Location:index.php'));
}
?>




<html>
<head>
  <meta charset="utf-8">
 
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/templatemo_main.css">
  <title>Public Transport Optimization</title>
<link rel="shortcut icon" type="image/png" href="images/fav.png"/>
<link rel="stylesheet" href="pure-release-0.5.0/pure.css">
<link rel="stylesheet" href="pure-release-0.5.0/grids-responsive.css">
<link rel="stylesheet" href="css/layouts/marketing.css">
<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
  
</head>

<body>

  <?php 
echo '<div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo"><h1>Customer Workspace</h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
    </div>
    <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">';
echo'<li><a href="debit.php"><i class="fa fa-cubes"></i><!--<span class="badge pull-right">9</span>-->Track bus</a></li>


  <li><a href="transfer.php"><i class="fa fa-users"></i>Book bus</a></li>
  <li class="active"><a href="account_summary.php"><i class="fa fa-users"></i>Travel Summary</a></li>
  ';



?>
        </ul>
      </div>


<!--/.navbar-collapse --><?php echo'<style> . align{align="right"}
</style>
      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
<div class="row margin-bottom-30">
            <div class="col-md-12">
              <ul class="nav nav-pills">

                <li class="active"><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </div>
          </div>';

?>
<?php


/* account  deatails */

$acc_no=$_SESSION['emp_id'];

/* fetch mysql data from  phpmyadmin server*/


$query1="SELECT * FROM bus_trans";
$query2="SELECT name FROM customer";
$query1_data= mysqli_query($con, $query1);
$query2_data= mysqli_query($con, $query2);
/* check from array and select required data */
$query2_row=mysqli_fetch_assoc($query2_data);
$first_name =$query2_row['name'];


echo '<span style="color:#0F0691;"><h2>Name&nbsp;&nbsp;:'.$first_name.'<br>';
echo 'Customer ID&nbsp;:'.$acc_no.'<br>';
if( mysqli_num_rows($query1_data)!=0){
 echo '<div class="table-responsive">'.

      '<table class="table table-striped table-hover table-bordered">'.
                  '<thead>'.
                    '<tr>'.
                      '<th>#</th>'.
                      '<th>Transaction</th>'.
                      '<th>Date</th>'.
                      '<th>Bus_id</th>'.
                      '<th>Emp_id</th>'.
                      '<th>Source_lat</th>
                      <th>Source_long</th>
                      <th>Destination_lat</th>
                      <th>Destination_long</th>
					  
                    </tr>
                  </thead>';

	$i=0;
	echo '<tbody>';
	while($query1_row=mysqli_fetch_assoc($query1_data)){
		$i+=1;
		$trans_id=$query1_row['Trans_id'];
		$date=$query1_row['Date'];
		$bus_id=$query1_row['Bus_id'];
		$src_1=$query1_row['Sour_lat'];
		$src_2=$query1_row['Sour_lon'];
		$dest_1=$query1_row['Dest_lat'];
		$dest_2=$query1_row['Desc_lon'];
		$emp_id=$acc_no;

$color='success';
		


		echo' <tr class='.$color.'>
                      <td>'.$i.'</td>
                      <td>'.$trans_id.'</td>
                      <td>'.$date.'</td>
                      <td>'.$bus_id.'</td>
                      <td>'.$emp_id.'</td>
		      <td>'.$src_1.'</td>
		      <td>'.$src_2.'</td>
		      <td>'.$dest_1.'</td>
		      <td>'.$dest_2.'</td>
                      </tr>';

			}
		echo '<br>'.'Total number of transactions:   '.$i;
		}

        else {
		echo '<h4>No Transactions have been made</h4>';
		}

//<a href="index.php"><h1>home</h1></a>
//<a href="logout.php"><h1>logout</h1></a>
echo '      <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Are you sure you want to sign out?</h4>
            </div>
            <div class="modal-footer">
              <a href="logout.php" class="btn btn-primary">Yes</a>
              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>


    </div>
</div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/templatemo_script.js"></script>

';

?>


  </body>
</html>
