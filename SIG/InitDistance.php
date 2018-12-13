<?php
/**** Conversion latitude,longitude en coordonnée lambert 93 ****/      
//variables:     
$a=6378137; //demi grand axe de l'ellipsoide (m)     
$e=0.08181919106; //première excentricité de l'ellipsoide     
$l0=$lc=deg2rad(3);     
$phi0=deg2rad(46.5); //latitude d'origine en radian     
$phi1=deg2rad(44); //1er parallele automécoïque     
$phi2=deg2rad(49); //2eme parallele automécoïque          
$x0=700000; //coordonnées à l'origine     
$y0=6600000; //coordonnées à l'origine    
$latitude = 14.78152;
$longitude = 16.78912;      
$phi=deg2rad($latitude);     
$l=deg2rad($longitude);          
//calcul des grandes normales     
$gN1=$a/sqrt(1-$e*$e*sin($phi1)*sin($phi1));     
$gN2=$a/sqrt(1-$e*$e*sin($phi2)*sin($phi2));          
//calculs des latitudes isométriques     
$gl1=log(tan(pi()/4+$phi1/2)*pow((1-$e*sin($phi1))/(1+$e*sin($phi1)),$e/2));     
$gl2=log(tan(pi()/4+$phi2/2)*pow((1-$e*sin($phi2))/(1+$e*sin($phi2)),$e/2));     
$gl0=log(tan(pi()/4+$phi0/2)*pow((1-$e*sin($phi0))/(1+$e*sin($phi0)),$e/2));     
$gl=log(tan(pi()/4+$phi/2)*pow((1-$e*sin($phi))/(1+$e*sin($phi)),$e/2));          
//calcul de l'exposant de la projection     
$n=(log(($gN2*cos($phi2))/($gN1*cos($phi1))))/($gl1-$gl2);//ok          
//calcul de la constante de projection     
$c=(($gN1*cos($phi1))/$n)*exp($n*$gl1);//ok          
//calcul des coordonnées     
$ys=$y0+$c*exp(-1*$n*$gl0);          
$x93=$x0+$c*exp(-1*$n*$gl)*sin($n*($l-$lc));     
$y93=$ys-$c*exp(-1*$n*$gl)*cos($n*($l-$lc));
//echo('latitude' . $x93);
//echo('longitude' . $y93);
?>