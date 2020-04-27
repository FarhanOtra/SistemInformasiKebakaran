<?php

include 'koneksi.php';

$sql  = "SELECT ST_AsGeoJSON(geom) AS geometry FROM kecamatan";   
$geojson = array(
	'type'=> 'FeatureCollection',    
	'features'  => array()   
);

$query = mysqli_query($conn,$sql); 
  while($rows=mysqli_fetch_assoc($query)){    
  	$feature = array(     
  		"type" => 'Feature',
  		'geometry' => json_decode($rows['geometry'],true),
  		 );    
  		array_push($geojson['features'], $feature);   
  }   echo json_encode($geojson); 

?>