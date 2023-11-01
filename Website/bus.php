<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Public Transport Optimization</title>
    <link rel="shortcut icon" type="image/png" href="images/fav.png"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="pure-release-0.5.0/pure.css">
	<link rel="stylesheet" href="pure-release-0.5.0/grids-responsive.css">
	<link rel="stylesheet" href="css/layouts/marketing.css">
	<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    <script src="js/ajax.js"></script>
  </head>
 <body background="images/back.jpg">
 <div class="header">
    <div class="home-menu pure-menu pure-menu-open pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="http://localhost/Bus/home.php">PUBLIC TRANSPORT OPTIMISATION</a>

        <ul>
            <li class="pure-menu-selected"><a href="http://localhost/Bus/home.php">Home</a></li>
            <li><a href="http://localhost/Bus/home.php">Bus</a></li>
            <li><a href="#">Customer</a></li>
           <li><a href="#">About us </a></li>
        </ul>
    </div>
</div>
  	<div class="container">
	  <div class="row">
	    <div class="col-sm">
	    	<div class="heading">
	    		<h3> BUS TRACKING</h3>
  		  		<p>IOT based Project</p>
	    	</div>
	    </div>
	  </div>
	</div>
	
	<div class="container-fluid" id="map1">
		<div class="row">
			<div class="col" id="val">
		      <p>google map comming...</p>
		    </div>
		</div>
	</div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div id="map"></div>
            </div>
        </div>
    </div>
	
	<div class="container">
	    <div class="row">
            <div class="col" id="foot">
                <p>
                    &copy; An IoT product of <a href="https://just.edu.bd">JUST</a>
                </p>
            </div>
            <div class="col" id="foot">
                <p>
                    <a href="developer.html">CreditS</a>
                </p>
            </div>
	    </div>
	</div>

    <div id="busLocation">

    </div>
<?php
include 'lib/config.php';
include 'lib/mydatabase.php';

$db=new Database();
$atm_no=$_GET['vari'];
$output="";
echo "<h1>$atm_no</h1>";
$query="SELECT * FROM buses WHERE Bus_id=$atm_no";
$result=$db->getLocation($query);
if(mysqli_num_rows($result)>0){
    while ($row=mysqli_fetch_assoc($result)){
        $output.="<input type='text' id='lat_loc' value='".$row['lat']."'>";
        $output.="<input type='text' id='lan_loc' value='".$row['lon']."'>";
    }
    echo $output;
}

?>


    <script>
        // Initialize and add the map
        function showLocation() {
           
        };

        function initMap() {

            var lat=$('#lat_loc').val();
            var lan=$('#lan_loc').val();
			
            var a=parseFloat(lat);
            var b=parseFloat(lan);
            var uluru = {lat: a, lng: b};
            var map = new google.maps.Map(document.getElementById('map1'), {zoom: 15, center: uluru});
            var marker = new google.maps.Marker({position: uluru, map: map});
        }
        
        $(document).ready(function () {
            //showLocation();
            //initMap();
            setInterval(function () {
                showLocation();
                initMap();
            },5000);
        });
    </script>
    <!--Load the API from the specified URL
    * The async attribute allows the browser to render the page while the API loads
    * The key parameter will contain your own API key (which is not needed for this tutorial)
    * The callback parameter executes the initMap() function
    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA4BeCaxyC7OS6fRAiwZrN60UqMXI3i3Ns&callback=initMap">
    </script>

<!--    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>