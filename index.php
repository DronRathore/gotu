<?php
include_once('s.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>GOT U LOCATOR</title>
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
		margin-left: 250px;
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
		.footer{width: 100%;height: 500px;background: #737373}

	</style>

	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="GeoJSON.js"></script>
	<script type="text/javascript">
	function setGL(temp){
			var test1=temp;
			var cordchod=test1.split(" ");
			geojson_LineString["coordinates"][0][0]=parseFloat(cordchod[0]);
			geojson_LineString["coordinates"][0][1]=parseFloat(cordchod[1]);
			geojson_LineString["coordinates"][1][0]=parseFloat(cordchod[2]);
			geojson_LineString["coordinates"][1][1]=parseFloat(cordchod[3]);
			
			console.log("co-ordinates: "+geojson_LineString["coordinates"][0][0]+" "+geojson_LineString["coordinates"][0][1]+" "+geojson_LineString["coordinates"][1][0]+" "+geojson_LineString["coordinates"][1][1]+" ");
			try{
				showFeature(geojson_LineString);
			}
			catch(err){


			}
		}
		//setInterval(setGL,300);
	</script>
	
	<script type="text/javascript">

	window.coords = [];
		var map;
		currentFeature_or_Features = null;

		var geojson_Point = {
			"type": "Point",
			"coordinates": [75.859838, 26.848277]
		};

		var geojson_MultiPoint = {
			"type": "MultiPoint",
			"coordinates": [
				[75.859838,26.847620],
				[75.860298,26.8473801]
			]
		};

		var geojson_LineString = {
			"type": "LineString",
			"coordinates": [
		
			[75.859938, 26.848277],
			
			[75.860298,26.8473801],
				
				]
		};

		var geojson_MultiLineString = {
			"type": "MultiLineString",
			"coordinates": [
				[
					[75.859938, 26.848277],
				[75.860241, 26.848291],
				[75.860298,26.8473801],
				[75.856694, 26.847620]
				],[
					[75.859638, 26.848977],
				[75.860291, 26.848991],
				[75.860958,26.8475001],
				[75.856964, 26.844720]
				]
			]
		};


		var geojson_Feature = {
			"type": "Feature",
			"properties": {
				"object_type": "Road",
				"name": "Fairfield Rd."
			},
			"geometry": {
				"type": "LineString",
				"coordinates": [
					[75.859838, 26.848277],
				[75.860281, 26.848291],
				[75.860258,26.8473801],
				[75.856664, 26.847620]
				]
			}
		};

		var geojson_Feature_GeometryCollection = {
			"type": "Feature",
			"properties": {
				"name": "Fountainbrook Rd."
			},
			"geometry": {
				"type": "GeometryCollection",
				"geometries": [
					{
						"type": "Point",
						"coordinates": [75.860281, 26.848291]
					},{
						"type": "LineString",
						"coordinates": [
							[-80.661983228058659, 35.042968081213758],
							[-80.662076494242413, 35.042749414542243],
							[-80.662196794397431, 35.042626481357232],
							[-80.664238981504525, 35.041175532632963]
						]
					}
				]
			}
		};


		var roadStyle = {
			strokeColor: "#FFFF00",
			strokeWeight: 7,
			strokeOpacity: 0.75
		};

		var addressStyle = {
			icon: "img/marker-house.png"
		};

		var parcelStyle = {
			strokeColor: "#FF7800",
			strokeOpacity: 1,
			strokeWeight: 2,
			fillColor: "#46461F",
			fillOpacity: 0.25
		};

		var infowindow = new google.maps.InfoWindow();

		function init(){
			
			map = new google.maps.Map(document.getElementById('map'),{
				zoom: 18,
				center: new google.maps.LatLng(26.848277, 75.859838),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			
		}

		function clearMap(){
			if (!currentFeature_or_Features)
				return;
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(null);
						}
					}
					else{
						currentFeature_or_Features[i].setMap(null);
					}
				}
			}else{
				currentFeature_or_Features.setMap(null);
			}
			if (infowindow.getMap()){
				infowindow.close();
			}
		}
		function showFeature(geojson, style){
			//clearMap();
			currentFeature_or_Features = new GeoJSON(geojson, style || null);
			if (currentFeature_or_Features.type && currentFeature_or_Features.type == "Error"){
				document.getElementById("put_geojson_string_here").value = currentFeature_or_Features.message;
				return;
			}
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(map);
							if(currentFeature_or_Features[i][j].geojsonProperties) {
								setInfoWindow(currentFeature_or_Features[i][j]);
							}
						}
					}
					else{
						currentFeature_or_Features[i].setMap(map);
					}
					if (currentFeature_or_Features[i].geojsonProperties) {
						setInfoWindow(currentFeature_or_Features[i]);
					}
				}
			}else{
				currentFeature_or_Features.setMap(map)
				if (currentFeature_or_Features.geojsonProperties) {
					setInfoWindow(currentFeature_or_Features);
				}
			}

			document.getElementById("put_geojson_string_here").value = JSON.stringify(geojson);
		}


		function rawGeoJSON(){
			clearMap();
			currentFeature_or_Features = new GeoJSON(JSON.parse(document.getElementById("put_geojson_string_here").value));
			if (currentFeature_or_Features.length){
				for (var i = 0; i < currentFeature_or_Features.length; i++){
					if(currentFeature_or_Features[i].length){
						for(var j = 0; j < currentFeature_or_Features[i].length; j++){
							currentFeature_or_Features[i][j].setMap(map);
							if(currentFeature_or_Features[i][j].geojsonProperties) {
								setInfoWindow(currentFeature_or_Features[i][j]);
							}
						}
					}
					else{
						currentFeature_or_Features[i].setMap(map);
					}
					if (currentFeature_or_Features[i].geojsonProperties) {
						setInfoWindow(currentFeature_or_Features[i]);
					}
				}
			}else{
				currentFeature_or_Features.setMap(map);
				if (currentFeature_or_Features.geojsonProperties) {
					setInfoWindow(currentFeature_or_Features);
				}
			}
		}
		function setInfoWindow (feature) {
			google.maps.event.addListener(feature, "click", function(event) {
				var content = "<div id='infoBox'><strong>GeoJSON Feature Properties</strong><br />";
				for (var j in this.geojsonProperties) {
					content += j + ": " + this.geojsonProperties[j] + "<br />";
				}
				content += "</div>";
				infowindow.setContent(content);
				infowindow.position = event.latLng;
				infowindow.open(map);
			});
		}
	</script>

</head>
<body onload="init();">
	<div class="top">
		<a href="#" class="androidlocator">Locator Server Screen</a>
		
<a href="#" class="androidlocator" style="font-size:17px;float:right;margin-right:100px;"></a>  
		<a href="#" class="androidlocator" style="font-size:12px;float:right;margin-right:100px;">User Account module here ..</a>
		
	</div>
	<div id="left" >
		<div id="map" ></div>
	</div>
	<div id="right">
		<input type="button" value="One device" onclick="showFeature(geojson_Point);" />
		
		<input type="button" value="Multi Device" onclick="showFeature(geojson_MultiPoint);" >
	
		<input type="button" value="Single line trace" onclick="showFeature(geojson_LineString);" />
	
		<input type="button" value="Multi Line Trace" onclick="showFeature(geojson_MultiLineString);" />
	<!--<textarea id="put_geojson_string_here"></textarea>-->

</div>



	</div>
	</body>
	</html>