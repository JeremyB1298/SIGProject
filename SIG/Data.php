<?php


    class Data {
        private $bdd;

        public function __construct () {
        }

        public function getGeoArcTab() {
            $bdd = new PDO('mysql:host=localhost;dbname=sigComplet;charset=utf8', 'root', 'root');
            $reponse = $bdd->query('SELECT * FROM `GEO_ARC`');
            $tableauGeoArc = array();
            while ($donnees = $reponse->fetch()) {
                //var_dump($tableauGeoArc);
                array_push($tableauGeoArc, new GeoArc($donnees['GEO_ARC_ID'], $donnees['GEO_ARC_DEB'], $donnees['GEO_ARC_FIN'], $donnees['GEO_ARC_TEMPS'], $donnees['GEO_ARC_DISTANCE'], $donnees['GEO_ARC_SENS']));    
                		
            }
            
            $reponse->closeCursor();
            return $tableauGeoArc;
        }

        public function getGeoPointTab() {
            $bdd = new PDO('mysql:host=localhost;dbname=sigComplet;charset=utf8', 'root', 'root');
            $reponse = $bdd->query('SELECT * FROM `GEO_POINT`');
            $tableauGeoPoint = array();
            while ($donnees = $reponse->fetch()) {
                //var_dump($donnees['GEO_POI_NOM']);
                array_push($tableauGeoPoint, new GeoPoint($donnees['GEO_POI_ID'], $donnees['GEO_POI_LATITUDE'], $donnees['GEO_POI_LONGITUDE'], $donnees['GEO_POI_NOM'], $donnees['GEO_ARC_PARTITION']));   	
            }
            $reponse->closeCursor();
            return $tableauGeoPoint;
        }

    }
?>