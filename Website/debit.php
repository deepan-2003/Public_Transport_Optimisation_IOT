<?php
require 'server_connect.inc.php';
require 'get_logged.inc.php';
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



<?php 
echo '<body>
  <div id="main-wrapper">
    <div class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <div class="logo"><h1>ATM Workspace</h1></div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
    </div>';
echo' <div class="template-page-wrapper">
      <div class="navbar-collapse collapse templatemo-sidebar">
        <ul class="templatemo-sidebar-menu">

  <li class="active"><a href="debit.php"><i class="fa fa-cubes"></i><!--<span class="badge pull-right">9</span>-->Track Bus</a></li>


  <li><a href="transfer.php"><i class="fa fa-users"></i>Check Bus</a></li>
  <li><a href="account_summary.php"><i class="fa fa-users"></i>Travel Summary</a></li>


        </ul>
      </div>';


echo '  <div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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





<!--/.navbar-collapse -->
<?php 
 echo'<div class="templatemo-content-wrapper">
        <div class="templatemo-content">

	<div class="row margin-bottom-30">
            <div class="col-md-12">
              <ul class="nav nav-pills">

                <li class="active"><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </div>
          </div>';



?>



<?php if(isset($_POST['Amount']) && !empty($_POST['Amount'])){

		$atm_no=$_POST['Amount'];
		$pin=$_POST['PIN'];
		$query1="SELECT Bus_id FROM buses WHERE Bus_id='$atm_no'";	//query to check weather atm number and pin

		if($query1_data = mysqli_query($con, $query1)){

			if(mysqli_num_rows($query1_data)==1){
					$_SESSION['atm']=$atm_no;
					$row1 = mysqli_fetch_assoc($query1_data);
					$acc_no = $row1['Acc_no'];
					$_SESSION['acc_no']=$acc_no;
					header("Location:bus.php?vari='$atm_no'");

			}

			else if(mysqli_num_rows($query1_data)==0){
					echo '<script>alert("Invalid BUS NUMBER ");</script>';

				}
		}

	  
}

?>
<?php
echo '<h1 align="center"> Track Bus</h1>
<form role="form" action="debit.php" id="templatemo-preferences-form" method="POST" onsubmit="return validateForm()">
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="Amount" class="control-label">Bus ID</label>
                    <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Enter Bus ID">
                  </div>
</div>

<div class="row templatemo-form-buttons">
                <div class="col-md-12">
                  <button type="submit" class="btn btn-primary">Check</button>
                  <button type="reset" class="btn btn-default">Reset</button>
                </div>
              </div>
</form>
<script type="text/javascript">
function validateForm() {
	var amount = document.forms[0]["Amount"].value;

	if ( amount == null || amount == "") {
	        alert("Fields with * are compulsory");
	        return false;
            }
	}
</script>';
?>



</body>
</html>
