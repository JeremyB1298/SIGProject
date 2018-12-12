<?php

class GeoArc {

    protected $geo_arc_id;
    private $geo_arc_deb;
    private $geo_arc_fin;
    private $geo_arc_temps;
    private $geo_arc_distance;
    private $geo_arc_sens;

    public function __construct($geo_arc_id, $geo_arc_deb,$geo_arc_fin, $geo_arc_temps, $geo_arc_distance, $geo_arc_sens) {

        $this->geo_arc_id = $geo_arc_id;
        $this->geo_arc_deb = $geo_arc_deb;
        $this->geo_arc_fin = $geo_arc_fin;
        $this->geo_arc_temps = $geo_arc_temps;
        $this->geo_arc_distance = $geo_arc_distance;
        $this->geo_arc_sens = $geo_arc_sens;
    }
    
    public function getGeoArcDeb() {
        return $this->geo_arc_deb;
    }  

    public function getGeoArcFin() {
        return $this->geo_arc_fin;
    }  

    public function setDistance($distance) {

       $this->geo_arc_distance = $distance;
    }

    public function getDistance() {
        return $this->geo_arc_distance;
    }
}
?>