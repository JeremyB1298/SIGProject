<?php 
class Distance {

    private $dist;

    public function __construct() {

    }

    /*public function getDistance($lat1, $lat2, $lon1, $lon2) {

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
    }*/

    public function getDistance($lat1, $lat2, $long1, $long2) {

        $n = 0.7289686274;
        $C = 11745793.39;
        $e = 0.08248325676;
        $Xs = 600000;
        $Ys = 8199695.768;

        
        $GAMMA0 = (3600*2) + (60*20) + 14.025;
        $GAMMA0 = $GAMMA0/(180*3600)*pi();
        $lat = floatval($lat1)/(180*3600)*pi();
        $long = floatval($long1)/(180*3600)*pi();
        $L = 0.5*log((1+sin($lat))/(1-sin($lat)))-$e/2*log((1+$e*sin($lat))/(1-$e*sin($lat)));
        $R = $C*exp((-$n)*$L);
        
        $GAMMA = $n*($long-$GAMMA0);
        
        $Long1 = $Xs+($R*sin($GAMMA));
        $Lat1 = $Ys-($R*cos($GAMMA));

        $GAMMA0 = (3600*2) + (60*20) + 14.025;
        $GAMMA0 = $GAMMA0/(180*3600)*pi();
        $lat = floatval($lat2)/(180*3600)*pi();
        $long = floatval($long2)/(180*3600)*pi();
        $L = 0.5*log((1+sin($lat))/(1-sin($lat)))-$e/2*log((1+$e*sin($lat))/(1-$e*sin($lat)));
        $R = $C*exp((-$n)*$L);
        
        $GAMMA = $n*($long-$GAMMA0);
        
        $Long2 = $Xs+($R*sin($GAMMA));
        $Lat2 = $Ys-($R*cos($GAMMA));

        return sqrt( pow( ($Lat1 - $Lat2) ,2) + pow( ($Long1 - $Long2) ,2) );
    }
}
?>