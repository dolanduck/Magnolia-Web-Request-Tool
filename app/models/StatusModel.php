<?php


class StatusModel extends Model {
  public function __construct() {
    parent::__construct();
  }

  public function postStatus($status, $request_number)
  {
    $userId = $_SESSION['userID'];
    $qry = $this->db->prepare("SELECT * FROM members WHERE id = :id");
    $qry->execute([':id' => $userId]);

    $users = $qry->fetchAll(PDO::FETCH_ASSOC);

      foreach($users as $user)
      {
        $fullname = $user['full_name'];
      }

       $sth = $this->db->prepare("INSERT into status (status_content,posted_by,request_number) VALUES (:status_content,:posted_by,:request_number)");
       $sth->execute([
         ':status_content' => $status,
         ':posted_by' => $fullname,
         ':request_number' => $request_number
       ]);

       $this->json->response('success', '');
  }

  public function showStatus($request_number)
  {
    $sth = $this->db->prepare("SELECT * FROM status WHERE request_number = :request_number ORDER by id DESC");
    $sth->execute([':request_number' => $request_number]);
    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }

  public function removeStatus($status_id)
  {
    $sth = $this->db->prepare("DELETE from status WHERE id = :status_id");
    $sth->execute([':status_id' => $status_id]);
    $this->json->response('success', '');
  }
}
