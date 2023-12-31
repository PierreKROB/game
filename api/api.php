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
    private $niveau; 
    private $doublon;

    public function __construct($id_perso, $nom, $puissance, $defense, $HP, $type, $niveau, $doublon)
    {
        $this->id_perso = $id_perso;
        $this->nom = $nom;
        $this->puissance = $puissance;
        $this->defense = $defense;
        $this->HP = $HP;
        $this->type = $type;
        $this->niveau = $niveau;
        $this->doublon = $doublon;
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
            "type" => $this->type,
            "level" => $this->niveau, // Include character's level
            "doublon" => $this->doublon // Include character's doublon
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
                        if (empty($url[1])) {
                            $this->getAllCharacters();
                        } else {
                            $this->getCharacters($url[1]);
                        }

                        break;
                    case "player_characters":
                        if (!empty($url[1])) {
                            $this->getCharactersByPlayer($url[1]);
                        } else {
                            throw new Exception("Player ID not provided.");
                        }
                        break;
                    case "niveaux":
                        if (empty($url[1])) {
                            $this->getNiveaux();
                        } else {
                            $this->getNiveau($url[1]);
                        } // Ajout du nouveau cas pour les niveaux
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
                $characterData['type'],
                0,
                0
            );
        }

        $characterDetails = array_map(function ($character) {
            return $character->getDetails();
        }, $characterObjects);

        sendJSON($characterDetails);
    }



    private function getCharactersByPlayer($playerId)
    {
        $query = "SELECT personnages.*, box.niveau_actuel, box.doublon
                  FROM personnages
                  INNER JOIN box ON personnages.id_perso = box.personnage_id
                  WHERE box.joueur_id = :playerId";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':playerId', $playerId, PDO::PARAM_INT);
        $stmt->execute();
        $characters = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $characterObjects = [];
        foreach ($characters as $characterData) {
            $characterLevel = $characterData['niveau_actuel'];
            $doublon = $characterData['doublon'];
            $multiplicateur = 1.0;

            if ($doublon == 1) {
                $multiplicateur = 1.1;
            } elseif ($doublon == 2) {
                $multiplicateur = 1.175;
            } elseif ($doublon == 3) {
                $multiplicateur = 1.2;
            } elseif ($doublon == 4) {
                $multiplicateur = 1.245;
            }

            // Calculate updated stats based on the character's level and doublon
            $puissance = $characterData['puissance'] * pow((1 + $characterLevel / 100), 2) * $multiplicateur;
            $defense = $characterData['defense'] * pow((1 + $characterLevel / 100), 2) * $multiplicateur;
            $HP = $characterData['HP'] * pow((1 + $characterLevel / 100), 2) * $multiplicateur;

            $characterObjects[] = new Character(
                $characterData['id_perso'],
                $characterData['nom'],
                $puissance,
                $defense,
                $HP,
                $characterData['type'],
                $characterLevel,
                $doublon
            );
        }

        $characterDetails = array_map(function ($character) {
            return $character->getDetails();
        }, $characterObjects);

        sendJSON($characterDetails);
    }




    private function getCharacters($id_perso)
    {
        $query = "SELECT personnages.*
              FROM personnages
              WHERE id_perso = :id_perso";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_perso', $id_perso, PDO::PARAM_INT);
        $stmt->execute();
        $characterData = $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() instead of fetchAll()

        if (!$characterData) {
            // If no character found with the given id, return null or an error message
            throw new Exception("Character not found with ID: $id_perso");
        }

        // Create a Character object using the fetched data
        $character = new Character(
            $characterData['id_perso'],
            $characterData['nom'],
            $characterData['puissance'],
            $characterData['defense'],
            $characterData['HP'],
            $characterData['type'],
            0,
            0
        );

        sendJSON($character->getDetails());
    }


    private function getNiveaux()
    {
        $query = "SELECT
        n.id AS id,
        n.categorie AS categorie,
        n.difficulte AS difficulte,
        JSON_ARRAYAGG(
          JSON_OBJECT(
            'id', b.id,
            'nom', b.nom,
            'hp', b.hp,
            'defense', b.defense,
            'attaque', b.attaque,
            'attaque_speciale', b.attaque_speciale,
            'dommage_reduit', b.dommage_reduit,
            'type', b.type
          )
        ) AS liste_boss
      FROM
        niveau n
      JOIN
        (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers
      ON
        JSON_UNQUOTE(JSON_EXTRACT(n.liste_boss, CONCAT('$[', numbers.n, ']'))) IS NOT NULL
      LEFT JOIN
        boss b ON b.id = JSON_UNQUOTE(JSON_EXTRACT(n.liste_boss, CONCAT('$[', numbers.n, ']')))
      GROUP BY
        n.id";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $niveaux = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($niveaux as &$niveau) {
            $niveau['liste_boss'] = json_decode($niveau['liste_boss']);
        }

        sendJSON($niveaux);
    }

    private function getNiveau($Id)
{
    // Requête pour récupérer les informations sur le niveau avec l'ID spécifié
    $query = "SELECT
        n.id AS id,
        n.categorie AS categorie,
        n.difficulte AS difficulte,
        JSON_ARRAYAGG(
            JSON_OBJECT(
                'id', b.id,
                'nom', b.nom,
                'hp', b.hp,
                'defense', b.defense,
                'attaque', b.attaque,
                'attaque_speciale', b.attaque_speciale,
                'dommage_reduit', b.dommage_reduit,
                'type', b.type
            )
        ) AS liste_boss
        FROM
        niveau n
        JOIN
        (SELECT 0 AS n UNION ALL SELECT 1 UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4) numbers
        ON
        JSON_UNQUOTE(JSON_EXTRACT(n.liste_boss, CONCAT('$[', numbers.n, ']'))) IS NOT NULL
        LEFT JOIN
        boss b ON b.id = JSON_UNQUOTE(JSON_EXTRACT(n.liste_boss, CONCAT('$[', numbers.n, ']')))
        WHERE n.id = :Id"; // Utilisation d'un paramètre nommé pour éviter les failles SQL

    $stmt = $this->db->prepare($query);
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT); // Lier l'ID en tant que paramètre nommé
    $stmt->execute();
    $niveau = $stmt->fetch(PDO::FETCH_ASSOC); // Utilisation de fetch() pour récupérer un seul niveau

    if (!$niveau) {
        // Si aucun niveau n'est trouvé avec l'ID spécifié, vous pouvez gérer une erreur ici
        throw new Exception("Niveau non trouvé avec l'ID : $Id");
    }

    // Convertir les valeurs de la colonne 'liste_boss' en JSON décodé
    $niveau['liste_boss'] = json_decode($niveau['liste_boss']);

    // Envoyer les informations du niveau au format JSON
    sendJSON($niveau);
}



    private function getEnemies($Id)
    {
        $query = "SELECT boss.*
                  FROM boss
                  WHERE boss.id = :Id";

        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        $stmt->execute();
        $enemies = $stmt->fetch(PDO::FETCH_ASSOC);

        sendJSON($enemies);
    }
}

$api = new API();
$api->handleRequest();
