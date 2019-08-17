<?php

    error_reporting(E_ALL);
    ini_set('display_errors',1);

    include('dbcon.php');
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if( ($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['submit']) || $android)
    {

    $p_id=$_POST['p_id'];
    $p_name=$_POST['p_name'];
    $r_check=$_POST['r_check'];
    $r_studentID=$_POST['r_studentID'];
    $r_date=$_POST['r_date'];
    $extension_check=$_POST['extension_check'];
    $extension_date=$_POST['extension_date'];

    $p_id = (int)$p_id;
    $r_check = (int)$r_check;
    $r_studentID = (int)$r_studentID;
    $extension_check = (int)$extension_check;
   echo $r_check;
        if(empty($p_id)){
            $errMSG = "이름을 입력하세요.";
        }
        else if(empty($r_studentID)){
            $errMSG = "나라를 입력하세요.";
        }

        if(!isset($errMSG))
        {
            try{
   echo $r_check;
   echo $r_studentID;
   echo $r_date;
   echo $extension_check;
   echo $extension_date;
            $stmt = $con->prepare("UPDATE Rent SET r_check = '$r_check', r_studentID = '$r_studentID', r_date = '$r_date', extension_check = '$extension_check', extension_date = '$extension_date' WHERE p_id = '$p_id'" );
                    $stmt->bindParam(':p_id', $p_id);
       $stmt->bindParam(':p_name', $p_name);
       $stmt->bindParam(':r_check', $r_check);
                    $stmt->bindParam(':r_studentID', $r_studentID);
                    $stmt->bindParam(':r_date', $r_date);
                    $stmt->bindParam(':extension_check', $extension_check);
       $stmt->bindParam(':extension_date', $extension_date);

                if($stmt->execute())
                {
                    $successMSG = "새로운 사용자를 추가했습니다.";
                }
                else
                {
                    $errMSG = "사용자 추가 에러";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage());
            }
        }

    }
?>

<html>
   <body>
        <?php
        if (isset($errMSG)) echo $errMSG;
        if (isset($successMSG)) echo $successMSG;
        ?>

        <form action="<?php $_PHP_SELF ?>" method="POST">
            p_id: <input type = "text" name = "p_id" />
            p_name: <input type = "text" name = "p_name" />
            r_check: <input type = "text" name = "r_check" />
            r_studentID: <input type = "text" name = "r_studentID" />
           r_date: <input type = "text" name = "r_date" />
           extension_check: <input type = "text" name = "extension_check" />
           extension_date: <input type = "text" name = "extension_date" />
            <input type = "submit" name = "submit" />
        </form>

   </body>
</html>
