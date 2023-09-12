<?php
  class Rents {
    private PDO $connect;

    function __construct($connect){
      $this->connect = $connect;
    }

    public function getAllObjects() {
      return $this->connect->query('SELECT * FROM "objects"')->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllRenters() {
      return $this->connect->query('SELECT * FROM "renters"')->fetchAll(PDO::FETCH_OBJ);
    }

    public function getAllRentInfos() {
      return $this->connect->query('
      SELECT "rentInfos"."id", 
      "objects"."id" as "objectId",
      "objects"."type" as "objectType",
      "renters"."id" as "renterId",
      "renters"."surname" as "renterSurname",
      
      "rentLong",
      "startingDate"
      FROM "rentInfos"
      INNER JOIN "objects" ON "rentInfos"."id" = "objects"."id"
      INNER JOIN "renters" on "rentInfos"."renterId" = "renters"."id"
      ')->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertObject($object): Array {
      return $this
        ->connect
        ->query("INSERT INTO objects (\"cost\", \"type\") VALUES ($object->cost, '$object->type') RETURNING *")
        ->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertRenter($object): Array {
      return $this
        ->connect
        ->query("INSERT INTO renters (\"surname\") VALUES ('$object->surname') RETURNING *")
        ->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertRentInfo($object): Array {
      return $this
        ->connect
        ->query("INSERT INTO \"rentInfos\" (\"objectId\", \"renterId\", \"rentLong\", \"startingDate\") 
          VALUES ($object->objectId, $object->renterId, $object->rentLong, '$object->startingDate') RETURNING *")
        ->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteObjectById($objectId) {
      return $this->connect->exec("DELETE FROM objects WHERE id=$objectId");
    }

    public function deleteRenterById($renterId) {
      return $this->connect->exec("DELETE FROM renters WHERE id=$renterId");
    }

    public function deleteRentInfoById($id) {
      return $this->connect->exec("DELETE FROM \"rentInfos\" WHERE id=$id");
    }

    public function updateObject($objectId, $params) {
      return $this->connect->exec("UPDATE objects SET cost=$params->cost, type='$params->type' WHERE id=$objectId");
    }

    public function updateRenter($id, $params) {
      return $this->connect->exec("UPDATE renters SET cost=$params->surname, type='$params->surname' WHERE id=$id");
    }

    public function updateRentInfo($id, $params) {
      return $this->connect->exec("UPDATE \"rentInfos\" SET 
        \"objectId\"=$params->objectId,
        \"renterId\"=$params->renterId,
        \"rentLong\"=$params->rentLong,
        \"startingDate\"=$params->startingDate
          WHERE id=$id
      ");
    }
  }
?>