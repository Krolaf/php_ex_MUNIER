<?php
class Data{
    // Attributs privés pour stocker la connexion et les paramètres de la BDD
    private $pdo = null;
    private $host = "127.0.0.1";
    private $name_bdd = "NAME_BDD";
    private $user_bdd = "root";
    private $password_bdd = "";
    private $error_serveur = "Erreur lors de la connexion au serveur.";
    private $error_bdd = "Erreur lors de la sélection de la base de données.";

    // Constructeur
    public function __construct(){
        try {
            // Connexion au Serveur de BDD via PDO
            $dsn = "mysql:host={$this->host};dbname={$this->name_bdd};charset=utf8mb4";
            $this->pdo = new PDO($dsn, $this->user_bdd, $this->password_bdd);

            // Configuration pour gérer les erreurs en mode exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Encodage UTF-8
            $this->pdo->exec("SET CHARACTER SET 'utf8mb4';");
            $this->pdo->exec("SET collation_connection = 'utf8mb4_general_ci';");

            // echo "Connexion réussie à la base de données."; // Confirmation de la connexion

        } catch (PDOException $e) {
            // Gestion des erreurs de connexion
            die($this->error_serveur . " Détails: " . $e->getMessage());
        }
    }

    // Méthode pour exécuter une requête SQL
    public function query($sql){
        try {
            if (!empty($sql)) {
                $result = $this->pdo->query($sql);
                return $result;
            }
        } catch (PDOException $e) {
            echo "Erreur dans la requête SQL : " . $e->getMessage();  // Affichage de l'erreur SQL
            return false;
        }
    }

    // Méthode pour exécuter une requête simple (SELECT avec un seul résultat attendu)
    public function simple_query($sql){
        $result = $this->query($sql);
        if($result) {
            $rows = $result->fetchAll(PDO::FETCH_ASSOC);
            if(count($rows) == 1) {
                return $rows[0];
            }
            return $rows;
        }
        return false;
    }

    // Insertion dans la base de données
    public function sql_insert($table, $data){
        $columns = implode('`, `', array_keys($data));
        $values = implode(', ', array_map([$this->pdo, 'quote'], array_values($data)));
        $sql = "INSERT INTO `$table` (`$columns`) VALUES ($values);";
        $this->query($sql);
        return $this->pdo->lastInsertId();
    }

    // Mise à jour dans la base de données
    public function sql_update($table, $id, $data, $id_field_name = 'id'){
        $set = [];
        foreach ($data as $key => $value) {
            $set[] = "`$key` = " . $this->pdo->quote($value);
        }
        $sql = "UPDATE `$table` SET " . implode(', ', $set) . " WHERE `$id_field_name` = " . $this->pdo->quote($id) . " LIMIT 1;";
        return $this->query($sql);
    }

    // Suppression d'un enregistrement dans la base de données
    public function sql_delete($table, $id, $id_field_name = 'id'){
        $sql = "DELETE FROM `$table` WHERE `$id_field_name` = " . $this->pdo->quote($id) . " LIMIT 1;";
        return $this->query($sql);
    }

    // Récupération des données à partir d'une requête SQL
    public function get_data($sql){
        $result = $this->query($sql);
        if($result) {
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    // Récupération des informations à partir d'un ID
    public function build_r_from_id($table, $id){
        $sql = "SELECT * FROM `$table` WHERE id = " . $this->pdo->quote($id) . ";";
        $result = $this->query($sql);
        if($result) {
            return $result->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
?>
