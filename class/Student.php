<?php
include("DBConnection.php");
class Student 
{
  private $db;
  public $_id;
  public $_name;
  public $_surname;
  public $_sidiCode;
  public $_taxCode;

  public function __construct() {
    $this->db = new DBConnection();
    $this->db = $this->db->returnConnection();
  }
  
  public function find($id){
    $sql = "SELECT * FROM student WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }

  public function getId(){
    $sql ="SELECT MAX(id) FROM `student` ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->store_result();
    $result = $result + 1;
    return $result ;
  }
  
  public function addStudent($name,$surname,$sidiCode,$taxCode){
    $sql = "INSERT INTO `student` (name, surname, sidi_code, tax_code) VALUES (:name, :surname, :sidi_code, :tax_code)";
    //INSERT INTO student (name, surname, sidi_code, tax_code) VALUES ("4","nameBello","surname","2343423","dedseefsfe");{"id":"71","name":"Toruccio","surname":"Bartolucci","sidi_code":"6110630","tax_code":"LBNNDR04E13D612E"}
    //curl --header "Content-Type: application/json" --request POST --data {"""_name""":"""nameBello""","""_surname""":"""surnameBello""","""_sidiCode""":"""452121""","""_taxCode""":"""RJDIJEIJWEJ9FDIEF"""} http://localhost:8080/student.php
    $stmt = $this->db->prepare($sql);
    $data = [
      'name' => $name,
      'surname' => $surname,
      'sidi_code' => $sidiCode,
      'tax_code' => $taxCode
    ];
    $stmt->execute($data);
  }
  // curl --header "Content-Type: application/json" --request DELETE --data {"""_id""":67} http://localhost:8080/student.php
  public function removeStudent($id){
    $sql ="DELETE FROM `student` WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
  }
  //curl --header "Content-Type: application/json" --request PUT --data {"""_id""":64,"""_name""":"""nameModificato""","""_surname""":"""surnameModificato""","""_sidiCode""":"""11111111""","""_taxCode""":"""22r9dewodm3"""} http://localhost:8080/student.php
  public function changeStudent($id,$name,$surname,$sidiCode,$taxCode){
    $sql ="UPDATE `student` SET name=:name,surname=:surname,sidi_code=:sidi_code,tax_code=:tax_code WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id,
      'name' => $name,
      'surname' => $surname,
      'sidi_code' => $sidiCode,
      'tax_code' => $taxCode
    ];
    $stmt->execute($data);
  }

  public function removeColl($id){
    $sql ="DELETE FROM `student_class` WHERE id_student=:id_student";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id_student' => $id
    ];
    $stmt->execute($data);
  }
  
  public function all(){
    $sql = "SELECT * FROM student";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}
?>
