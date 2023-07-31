<?php

class Formation {
    private $id;
    private $categorie;

    public function __construct($id, $categorie) {
        $this->id = $id;
        $this->categorie = $categorie;
    }

    // Getters and setters (if needed)

    public function afficherDetails() {
        echo "Affichage de la formation avec l'ID : " . $this->id;
    }
}

class API {
    public function handleRequest() {
        try {
            if (!empty($_GET['demande'])) {
                $url = explode("/", filter_var($_GET['demande'], FILTER_SANITIZE_URL));
                switch ($url[0]) {
                    case "formations":
                        if (empty($url[1])) {
                            $this->getFormations();
                        } else {
                            $this->getFormationsByCategorie($url[1]);
                        }
                        break;
                    case "formation":
                        if (!empty($url[1])) {
                            $this->getFormationById($url[1]);
                        } else {
                            throw new Exception("Vous n'avez pas renseigné le numéro de formations");
                        }
                        break;
                    default:
                        throw new Exception("La demande n'est pas valide, vérifiez l'url");
                }
            } else {
                throw new Exception("problème de récupération de données.");
            }
        } catch (Exception $e) {
            $erreur = [
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ];
            print_r($erreur);
        }
    }

    private function getFormations() {
        echo "Liste des formations";
    }

    private function getFormationsByCategorie($categorie) {
        echo "Liste des formations par catégories";
    }

    private function getFormationById($id) {
        // Ici, vous pouvez créer un objet Formation et utiliser sa méthode afficherDetails() pour afficher les détails de la formation.
        $formation = new Formation($id, "Catégorie de la formation");
        $formation->afficherDetails();
    }
}

// Utilisez ces classes dans votre index.php ou tout autre point d'entrée de votre application
$api = new API();
$api->handleRequest();

?>
