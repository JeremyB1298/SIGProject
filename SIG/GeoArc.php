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
    
    public function getGeoArcId() {
        return $this->geo_arc_id;
    }

    public function distanceTo($lat1, $lon1, $lat2, $lon2, $unit){
        echo'function distance';
        $rlat1 = Math.PI * $lat1/180;
        $rlat2 = Math.PI * $lat2/180;
        $rlon1 = Math.PI * $lon1/180;
        $rlon2 = Math.PI * $lon2/180;
     
        $theta = $lon1-$lon2;
        $rtheta = Math.PI * theta/180;
     
        $dist = Math.Sin($rlat1) * Math.Sin($rlat2) + Math.Cos($rlat1) * Math.Cos($rlat2) * Math.Cos($rtheta);
        $dist = Math.Acos(dist);
        $dist = $dist * 180/Math.PI;
        $dist = $dist * 60 * 1.1515;
     
        if ($unit=="K") { $dist = $dist * 1.609344; }
        if ($unit == "M") { $dist = $dist * 1.609344 * 1000; }
        if ($unit == "N") { $dist = $dist * 0.8684; }
        return $dist;
    }

}
?>