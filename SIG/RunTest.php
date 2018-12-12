<?php
require("Dijkstra.php");
require("GeoArc.php");
require("GeoPoint.php");
require("Data.php");
require("InitDistance.php");
require("Distance.php");

	    
	//var_dump($tabGeoPoint);
/*
 * Author: doug@neverfear.org
 */

function runTest() {


	$data = new Data();
	$tabGeoArc = $data->getGeoArcTab();

	$tabGeoPoint = $data->getGeoPointTab();
	$distance = new Distance();

	foreach ($tabGeoArc as $key) {
		$fin = $data->getGeoPointById($key->getGeoArcFin());
		$deb = $data->getGeoPointById($key->getGeoArcDeb());
		if($fin[0]->getPartition() == 1 && $deb[0]->getPartition() == 1)
		$key->setDistance($distance->getDistance($deb[0]->getLat(), $fin[0]->getLat(), $deb[0]->getLong(), $fin[0]->getLong()));
	}

	$g = new Graph();
	foreach ($tabGeoArc as $key) {
		$fin = $data->getGeoPointById($key->getGeoArcFin());
		$deb = $data->getGeoPointById($key->getGeoArcDeb());
		$g->addedge($deb[0]->getName(), $fin[0]->getName(), $key->getDistance());
	}
	list($distances, $prev) = $g->paths_from("Revermont");
	
	$path = $g->paths_to($prev, "Verlaine");
	
	print_r($path);
	
}


runTest();

