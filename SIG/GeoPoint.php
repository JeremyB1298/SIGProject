<?php 

    class GeoPoint {

        private $geo_poi_id;
        private $geo_poi_latitude;
        private $geo_poi_longitude;
        private $geo_poi_nom;
        private $geo_poi_partition;

        public function __construct($geo_poi_id, $geo_poi_latitude, $geo_poi_longitude, $geo_poi_nom, $geo_poi_partition) {

            $this->geo_poi_id = $geo_poi_id;
            $this->geo_poi_latitude = $geo_poi_latitude;
            $this->geo_poi_longitude = $geo_poi_longitude;
            $this->geo_poi_nom = $geo_poi_nom;
            $this->geo_poi_partition = $geo_poi_partition;
        }

    }

?>