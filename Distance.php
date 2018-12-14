<?php 
class Distance {

    private $dist;

    public function __construct() {

    }

    public function getDistance($lat1, $lat2, $lon1, $lon2) {

        $unit = 'M';
            
            $rlat1 = pi() * $lat1/180;
            $rlat2 = pi() * $lat2/180;
            $rlon1 = pi() * $lon1/180;
            $rlon2 = pi() * $lon2/180;
            
            $theta = $lon1-$lon2;
            $rtheta = pi() * $theta/180;
    
            $dist = sin($rlat1) * sin($rlat2) + cos($rlat1) * cos($rlat2) * cos($rtheta);
            $dist = acos($dist);
            $dist = $dist * 180/pi();
            $dist = $dist * 60 * 1.1515;
         
            if ($unit=="K") { $dist = $dist * 1.609344; }
            if ($unit == "M") { $dist = $dist * 1.609344 * 1000; }
            if ($unit == "N") { $dist = $dist * 0.8684; }

            return $dist;
    }
}
?>