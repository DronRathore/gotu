<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>GeoJSON to Google Maps</title>
	<style type="text/css">
	body{margin:0px;
			padding: 0px; 
		}
	.top{background: #a6f9ea;
		width: 100%;
		height: 80px;
	}
	.androidlocator{text-decoration: none;
		font-weight: bold;
		font:30px "Bauhaus 93";color:#5e5e5e;
		font-size: 35px;
		margin-left: 200px;
	}
		#left{
			width: 100%;
			height: 500px;
			float:none;
		}
		#right{
			width: 100%;
			height: 100px;
			float:left;
			padding: 0px;
			background: #d9fff8
		}
		#right div{
			margin-bottom: 4px;
		}
		#right textarea{
			height: 150px;
			width: 300px;
		}
		#map{
			height:100%;
		}
		#infoBox {
			width:300px;
		}
		.footer{width: 100%;
			height: 500px;
			background: #737373;
		}
		.login{width: 70%;
			height: 500px;
			box-shadow: 3px 4px 2px #000;
			margin-left:200px ;
			background: #000;
			

		}
		.login-table{

			width: 60%;
			height: 90%;
		
			margin-left: 20%;
		}
		.login-text{text-decoration: none;
		font-weight: bold;
		font:30px "Bauhaus 93";color:#5e5e5e;
		font-size: 18px;}

	</style>

	

</head>
<body>
	<div class="top">
		<a href="#" class="androidlocator">Locator Server Screen</a>

		
<a href="#" class="androidlocator" style="font-size:17px;float:right;margin-right:100px;">Login to acess the locator </a>
		
	</div>
	<div class="login" >
		<div class="login-table">
			<form action="login-exec.php" method="POST">
				<br><br><br><br>
				<p class="login-text">Username: <input type="text" name="username"></p>
				<p class="login-text">Password: <input type="password" name="password"></p>
				<input type="submit" value="Login" class="login-text" style="margin-left:120px;">
			</form>
		</div>
	</div>
	
		<div class="footer">
			<center><a href="#" class="androidlocator">Android Application Part, Login Module and Footer Content Coming Soon 

				By Nishant Singh And Rishabh Vinod </a></center>
		</div> 


	</div>
	</body>
	</html>