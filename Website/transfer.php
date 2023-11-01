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
echo'
  <li><a href="debit.php"><i class="fa fa-cubes"></i><!--<span class="badge pull-right">9</span>-->Track Bus</a></li>
  <li class="active"><a href="transfer.php"><i class="fa fa-users"></i>Check Bus</a></li>
  <li><a href="account_summary.php"><i class="fa fa-users"></i>Travelt Summary</a></li>
  ';
?>

        </ul>
      </div>


<!--/.navbar-collapse -->

      <div class="templatemo-content-wrapper">
        <div class="templatemo-content">
<div class="row margin-bottom-30">
            <div class="col-md-12">
<?php echo'
<ul class="nav nav-pills">

                <li class="active"><a href="javascript:;" data-toggle="modal" data-target="#confirmModal"><i class="fa fa-sign-out"></i>Logout</a></li>
              </ul>
            </div>
          </div>

<h1 align="center"> Transfer</h1>';



?>


<!--
<html>
<head><link rel="stylesheet" href="main.css"/></head>
<body>

	<form action="transfer.php" method="POST" onsubmit="return validateForm()">
		Amount*:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" value="" name="Amount"><br><br>
		Account number*:&nbsp;&nbsp;<input type="text" value="" name="Acc_no2"><br><br>

		<input type="submit" value="Submit">
	</form>
-->

	<script type="text/javascript">
		function validateForm() {
 			var amount = document.forms[0]["Amount"].value;
			

			if ( amount == null || amount == "" || ) {
	        		alert("Fields with * are compulsory");
        			return false;

    				}
			}
	</script>

</body>
</html>


<?php


if(isset($_POST['Amount']) && !empty($_POST['Amount'])){


@$Emp_id=$_SESSION['emp_id'];
@$atm=$_SESSION['atm'];
@$pin=$_SESSION['pin'];
//echo $_SESSION['atm'];
//print_r("$atm");
//echo $pin;



	$time=time();
	$date=date("Y/m/d",$time);
	$amount=$_POST['Amount'];

	if($amount>0){

		


		//echo $acc_no;
		$query3="SELECT * FROM bus_pass WHERE Bus_id=$amount";
		$query3_data=mysqli_query($con, $query3);

		if(mysqli_num_rows($query3_data)==1){
			$query3_row=mysqli_fetch_assoc($query3_data);
			$a=$query3_row['NoPass'];

		
          //  echo "yo bro";
					echo '<br>'.'<span style="color:#0F0691;"><h2>Passenger Fetch Successful</h2>';//.$query1_data;
					echo '<h4>Bus id :</h4>'.$amount.'<h4>Passenger nos:</h4>'.$a.'<h4></h4>';			}
				else {
					echo '<br>'.'<h2>Couldnot Fetch</h2>';}
}}
				echo '
		<form role="form" action="transfer.php" id="templatemo-preferences-form" method="POST" onsubmit="return validateForm()">
                <div class="row">
                  <div class="col-md-6 margin-bottom-15">
                    <label for="Amount" class="control-label">Enter Bus ID</label>
                    <input type="number" class="form-control" id="Amount" name="Amount" placeholder="Enter Bus Id" >
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
			

			if ( amount == null || amount == ""  ) {
	        		alert(" All Fields  are compulsory");
        			return false;

    				}
			}
	</script>

		';


//<a href="index.php"><h1>home</h1></a>
//<a href="logout.php"><h1>logout</h1></a>
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
