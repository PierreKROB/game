<?php
function getConnexion()
{
    return new PDO("mysql:host=localhost;dbname=krpi8598_diarabattle;charset=utf8", "krpi8598_admin", "Afrique2015!");
}

function sendJSON($infos)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    echo json_encode($infos, JSON_UNESCAPED_UNICODE);
}


class Character
{
    private $id_perso;
    private $nom;
    private $puissance;
    private $defense;
    private $HP;
    private $type;

    public function __construct($id_perso, $nom, $puissance, $defense, $HP, $type)
    {
        $this->id_perso = $id_perso;
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->defense = $defense;
        $this->HP = $HP;
        $this->type = $type;
    }

    // Getters (No setters since we don't need to modify character details for this API)

    public function getDetails()
    {
        return [
            "id" => $this->id_perso,
            "name" => $this->nom,
            "power" => $this->puissance,
            "defense" => $this->defense,
            "hp" => $this->HP,
            "type" => $this->type
        ];
    }
}

class API
{
    private $db;

    public function __construct()
    {
        $this->db = getConnexion();
    }

    public function handleRequest()
    {
        try {
            if (!empty($_GET['request'])) {
                $url = explode("/", filter_var($_GET['request'], FILTER_SANITIZE_URL));
                switch ($url[0]) {
                    case "characters":
                        $this->getAllCharacters();
                        break;
                    case "characters_by_player":
                        if (!empty($url[1])) {
                            $this->getCharactersByPlayer($url[1]);
                        } else {
                            throw new Exception("Player ID not provided.");
                        }
                        break;
                    case "niveaux": // Ajout du nouveau cas pour les niveaux
                        $this->getNiveaux();
                        break;
                    default:
                        throw new Exception("Invalid request, check the URL.");
                }
            } else {
                throw new Exception("Data retrieval problem.");
            }
        } catch (Exception $e) {
            $error = [
                "message" => $e->getMessage(),
                "code" => $e->getCode()
            ];
            print_r($error);
        }
    }

    private function getAllCharacters()
    {
        $query = "SELECT * FROM personnages"; // Updated query to select all columns (*)

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $characterObjects = [];
        foreach ($characters as $characterData) {
            $characterObjects[] = new Character(
                $characterData['id_perso'], // Correct column name: 'id_perso' instead of 'id'
                $characterData['nom'],      // Correct column name: 'nom' instead of 'name'
                $characterData['puissance'], // Correct column name: 'puissance' instead of 'power'
                $characterData['defense'],
                $characterData['HP'],       // Correct column name: 'HP' instead of 'hp'
                $characterData['type']
            );
        }

        $characterDetails = array_map(function ($character) {
            return $character->getDetails();
        }, $characterObjects);

        sendJSON($characterDetails);
    }



    private function getCharactersByPlayer($playerId)
    {
        $query = "SELECT personnages.*
                  FROM personnages
                  INNER JOIN box ON personnages.id_perso = box.personnage_id
                  WHERE box.joueur_id = :playerId";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $characterObjects = [];
        foreach ($characters as $characterData) {
            $characterObjects[] = new Character(
                $characterData['id_perso'],
                $characterData['nom'],
                $characterData['puissance'],
                $characterData['defense'],
                $characterData['HP'],
                $characterData['type']
            );
        }

        $characterDetails = array_map(function ($character) {
            return $character->getDetails();
        }, $characterObjects);

        sendJSON($characterDetails);
    }

    private function getNiveaux() {
        $query = "SELECT * FROM niveau";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

        sendJSON($niveaux);
    }
}

$api = new API();
$api->handleRequest();
