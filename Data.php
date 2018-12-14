<?php


    class Data {
        private $bdd;

        public function __construct () {
        }

        public function getGeoArcTab() {
            $bdd = new PDO('mysql:host=17ruecroixberthet.freeboxos.fr;dbname=sigComplet;charset=utf8', 'root', 'sCr7GD47x6');
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
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=sigComplet;charset=utf8', 'root', 'sCr7GD47x6');
            $reponse = $bdd->query('SELECT * FROM `GEO_POINT`');
            $tableauGeoPoint = array();
            while ($donnees = $reponse->fetch()) {
                //var_dump($donnees['GEO_POI_NOM']);
                array_push($tableauGeoPoint, new GeoPoint($donnees['GEO_POI_ID'], $donnees['GEO_POI_LATITUDE'], $donnees['GEO_POI_LONGITUDE'], $donnees['GEO_POI_NOM'], $donnees['GEO_POI_PARTITION']));   	
            }
            $reponse->closeCursor();
            return $tableauGeoPoint;
        }

        public function getGeoPointByUniqueName(){
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=sigComplet;charset=utf8', 'root', 'sCr7GD47x6');
            $reponse = $bdd->query('SELECT DISTINCT `GEO_POI_NOM` FROM `GEO_POINT`');
            $tableauGeoPoint = array();
            while ($donnees = $reponse->fetch()) {
                //var_dump($donnees['GEO_POI_NOM']);
                array_push($tableauGeoPoint, $donnees['GEO_POI_NOM']);   	
            }
            $reponse->closeCursor();
            return $tableauGeoPoint;
        }

        public function getGeoPointById($id) {
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=sigComplet;charset=utf8', 'root', 'sCr7GD47x6');
            $reponse = $bdd->query('SELECT * FROM `GEO_POINT` WHERE GEO_POI_ID = ' . $id);
            $tableauGeoPoint = array();
            while ($donnees = $reponse->fetch()) {
                //var_dump($donnees['GEO_POI_NOM']);
                array_push($tableauGeoPoint, new GeoPoint($donnees['GEO_POI_ID'], $donnees['GEO_POI_LATITUDE'], $donnees['GEO_POI_LONGITUDE'], $donnees['GEO_POI_NOM'], $donnees['GEO_POI_PARTITION']));   	
            }
            $reponse->closeCursor();
            return $tableauGeoPoint;
        }

        public function getTabPoint($arrayTitle) {
            $bdd = new PDO('mysql:host=127.0.0.1;dbname=sigComplet;charset=utf8', 'root', 'sCr7GD47x6');
            $arrayPoint = array();
            foreach ($arrayTitle as $key) {
                $reponse = $bdd->query('SELECT * FROM `GEO_POINT` WHERE GEO_POI_NOM = "' . $key . '"');
                $donnees = $reponse->fetch();
                array_push($arrayPoint, new GeoPoint($donnees['GEO_POI_ID'], $donnees['GEO_POI_LATITUDE'], $donnees['GEO_POI_LONGITUDE'], $donnees['GEO_POI_NOM'], $donnees['GEO_POI_PARTITION']));   	
            }
            $reponse->closeCursor();
            return $arrayPoint;
        }

    }
?>
