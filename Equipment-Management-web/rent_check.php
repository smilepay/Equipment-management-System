<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');
    $fp = fopen("p_id.txt","r");
    while( !feof($fp) )
          $p_id = fgets($fp);
    fclose($fp);
    $p_id=substr($p_id, 1, 7);

    $stmt = $con->prepare(" select r.p_name, r.p_id, s.s_name, r.r_studentID,s.s_phone, r.r_date from rent r, student s where r.r_studentID ='$p_id' and r.r_studentID = s.s_id;");
    $stmt->execute();

    if ($stmt->rowCount() > 0)
    {
        $data = array();

        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);

            array_push($data,
                array('p_id'=>$p_id,
                'p_name'=>$p_name,
   's_name' =>$s_name,
                'r_studentID'=>$r_studentID,
   's_phone' => $s_phone,
   'r_date' => $r_date
   ));
        }

        header('Content-Type: application/json; charset=utf8');
        $json = json_encode(array("webnautes"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        echo $json;
    }

?>
