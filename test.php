<?php
header("Content-Type: application/vnd.google-earth.kml+xml");
header("Content-Disposition: attachment; filename=location.kml");
$x = 14.90;
$y = 14.56;
echo('<?xml version="1.0" encoding="utf-8"?>');
?>

<kml xmlns="http://earth.google.com/kml/2.1">
  <Document>
		<Placemark>
			<Point>
				<coordinates><?php echo $x; ?>,<?php echo $y; ?></coordinates>
			</Point>
		</Placemark>
	</Document>
</kml>