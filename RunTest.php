<?php
header("Content-Type: application/vnd.google-earth.kml+xml");
header("Content-Disposition: attachment; filename=location.kml");
echo('<?xml version="1.0" encoding="utf-8"?>');
?>
 <kml xmlns="http://earth.google.com/kml/2.2">
  <Document> 
  <name>Sig Project </name>
  <description> Project of Thomas and Jeremy </description>
  
  <?php
  echo"<Style id=\"busLineIcon1\">
  <IconStyle id=\"busLineIcon1\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l1/90587-1-fre-FR/L1_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon2\">
  <IconStyle id=\"busLineIcon2\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l2/90524-1-fre-FR/L2_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon3\">
  <IconStyle id=\"busLineIcon3\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l3/90533-1-fre-FR/L3_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon4\">
  <IconStyle id=\"busLineIcon4\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l4/90542-1-fre-FR/L4_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon5\">
  <IconStyle id=\"busLineIcon5\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne/ligne-5a/87925-4-fre-FR/Ligne-5A_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon6\">
  <IconStyle id=\"busLineIcon6\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l6/90560-1-fre-FR/L6_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon7\">
  <IconStyle id=\"busLineIcon7\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l7/90569-1-fre-FR/L7_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo"<Style id=\"busLineIcon21\">
  <IconStyle id=\"busLineIcon11\">
  <Icon>
  <href>http://tub-bourg.fr/var/ezwebin_site/storage/images/mediatheque/images/picto-ligne-18x18/l21/90578-1-fre-FR/L21_format_18x18.png</href>
  </Icon>
  </IconStyle>
  </Style>";
  echo "<Style id=\"trajet\">
  <LineStyle>
  <color>0000ff</color>
  <width>4</width>
  </LineStyle>
  <PolyStyle>
  <color>ff0000</color>
  <width>20</width>
  </PolyStyle>
  </Style>";
 
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

	$arret1 = $_GET['a'];
	$arret2 = $_GET['b'];

	$data = new Data();
	$tabGeoArc = $data->getGeoArcTab();

	$tabGeoPoint = $data->getGeoPointTab();
	$distance = new Distance();

	foreach ($tabGeoArc as $key) {
		$fin = $data->getGeoPointById($key->getGeoArcFin());
		$deb = $data->getGeoPointById($key->getGeoArcDeb());
		$key->setDistance($distance->getDistance($deb[0]->getLat(), $fin[0]->getLat(), $deb[0]->getLong(), $fin[0]->getLong()));
	}

	$g = new Graph();
	foreach ($tabGeoArc as $key) {
		$fin = $data->getGeoPointById($key->getGeoArcFin());
		$deb = $data->getGeoPointById($key->getGeoArcDeb());
		//var_dump($deb[0]->getName() . " / " . $fin[0]->getName());
		$g->addedge($deb[0]->getName(), $fin[0]->getName(), $key->getDistance());
	}
	list($distances, $prev) = $g->paths_from($arret1);
	$path = $g->paths_to($prev, $arret2);
	$tabPointChemin = $data->getTabPoint($path);

	$tabLigne = [1,2,3,4,5,6,7,21];
	foreach ($tabGeoPoint as $key) {
			
			echo"<Placemark>
			<name>" . $key->getName() . "</name>
			<styleUrl>#busLineIcon" . $key->getPartition() ."</styleUrl>	
			<Point>";
			echo"	<coordinates>" . $key->getLong() . "," . $key->getLat() . "</coordinates>
			</Point>";
		echo "</Placemark>";
		
	}
	foreach ($tabLigne as $ligne) {
		foreach ($tabGeoArc as $key) {
			
			$fin = $data->getGeoPointById($key->getGeoArcFin());
			$deb = $data->getGeoPointById($key->getGeoArcDeb());
			if($fin[0]->getPartition() == $ligne && $deb[0]->getPartition() == $ligne ) {

				echo"<Placemark>
				<LineString>
				 <coordinates>";
				print $deb[0]->getLong() .  " , " .  $deb[0]->getLat() . ' ' . $fin[0]->getLong() . " , " . $fin[0]->getLat() ;
				 echo"</coordinates>
				</LineString>
				</Placemark>";

			}
		}
	}
	echo"<Placemark> 
				<name>Trajet</name>
				<styleUrl>#trajet</styleUrl>
				<LineString>
				 <coordinates>";
				 foreach ($tabPointChemin as $key) {
					echo $key->getLong() . " , " . $key->getLat() . ' ';
				 }
				 echo"</coordinates>
				</LineString>
				</Placemark>";
				
						
}
      runTest();


		
		
		
		
		
		?>
	</Document>
</kml>

