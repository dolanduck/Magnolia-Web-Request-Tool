<?php

class HomeModel extends Model {
  public function __construct()
  {
    parent::__construct();
  }

  public function fetchData($data)
  {
    $userId = $_SESSION['userID'];

    $sth = $this->db->prepare("SELECT * FROM members WHERE id = :id");
    $sth->execute([':id' => $userId]);

    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);

    foreach($rows as $row)
    {
      return $row[$data];
    }
  }


}

?>
