<?php

class RequestModel extends Model {

  public function __construct()
  {
    parent::__construct();
  }

  public function addRequest($request_number,$requester_name,$requester_phone,$publish_date,$description,$priority,$asset)
  {
    if($this->existingRequest($request_number)) {
       $this->json->response('error', 'There is already a web request with this request #');
       return false;
    }

    if(!is_numeric($requester_phone))
    {
      $this->json->response('error', 'Please enter a valid phone number');
      return false;
    }

    $formatDate = date('Y-m-d',strtotime($publish_date));

    $sth = $this->db->prepare("INSERT into web_request
         (request_number,client,client_phone,publish_date,description,priority,status,has_asset)
         VALUES(:request_number,:requester_name,:requester_phone,:publish_date,:description,:priority,:status,:has_asset
    )");

       $sth->execute([
          ':request_number' => $request_number,
          ':requester_name' => $requester_name,
          ':requester_phone' => $requester_phone,
          ':publish_date' => $formatDate,
          ':description' => $description,
          ':priority' => $priority,
          ':status' => 1,
          ':has_asset' => $asset
        ]);

        $this->json->response('success', '');
  }


  public function openRequest()
  {
    $sth = $this->db->prepare("SELECT * FROM web_request WHERE status = 1");
    $sth->execute();

    $requests = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $requests;
  }

  public function closedRequest()
  {
    $sth = $this->db->prepare("SELECT * FROM web_request WHERE status = 0");
    $sth->execute();

    $requests = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $requests;
  }


  public function singleRequest($request_number)
  {
    $sth = $this->db->prepare("SELECT * FROM web_request WHERE request_number = :request_number");
    $sth->execute([':request_number' => $request_number]);

    $rows = $sth->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
  }



  public function existingRequest($request_number)
  {
     $sth = $this->db->prepare("SELECT * FROM web_request WHERE request_number = :request_number");
     $sth->execute([':request_number' => $request_number]);
     $sth->fetchAll(PDO::FETCH_ASSOC);

     if($sth->rowCount() > 0)
     {
       return 1;
     }
     else
     {
       return 0;
     }
  }


  public function closeRequest($request_number)
  {
    if($this->alreadyClosed($request_number) == true)
    {
       $this->json->response('error', 'This web request is already closed.');
    }
    else
    {
      $sth = $this->db->prepare("UPDATE web_request SET status=0,closed_date = CURRENT_TIMESTAMP() WHERE request_number = :request_number");
      $sth->execute([':request_number' => $request_number]);
      $this->json->response('success', 'This web request has been closed.');
    }
  }

  public function alreadyClosed($request_number)
  {
    $sth = $this->db->prepare("SELECT status FROM web_request WHERE request_number = :request_number");
    $sth->execute([':request_number' => $request_number]);
    $row = $sth->fetch(PDO::FETCH_ASSOC);

    foreach($row as $status) {
       switch($status)
       {
         case 0:
         return true;
         break;

         case 1:
         return false;
         break;
       }
    }

  }


  public function updateRequest($request_id,$requester_name,$requester_phone,$publish_date,$priority,$description)
  {
    $formatDate = date('Y-m-d',strtotime($publish_date));

    $sth = $this->db->prepare("UPDATE web_request SET client = :client, client_phone = :client_phone, publish_date = :publish_date, priority = :priority, description = :description WHERE id = :request_id");
    $sth->execute([
      ':request_id' => $request_id,
      ':client' => $requester_name,
      ':client_phone' => $requester_phone,
      ':publish_date' => $formatDate,
      ':priority' => $priority,
      ':description' => $description
    ]);

    $this->json->response('success', '');
  }

}
