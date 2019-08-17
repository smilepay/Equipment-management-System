<!doctype html> <html> <center> <head> <title>소프트웨어학부 공동기기실</title>
<meta charset="utf-8"> </head>

<style>
.Title{text-decoration: none; color:#000051; font-size:50px;  font-family: "배달의민족 한나체 Pro";text-align: center;  border-bottom:10px solid white; margin:0; padding:20px; }
.Normal{color:black; text-decoration: none; font-size: 20px;}
.Watching{color:green; font-size: 20px;}
body{margin:0; background-color: #D6F0FF;}
ol{ height: 1500px; border-right:5px solid #000051; width:250px; padding:0px; background-color: white;  text-align: left; }
#GridForMenuAndArticle{display: grid; grid-template-columns: 450px 300px;  margin-top : 40px; }
#article{ text-align: left; padding-top : 10px; font-family: "맑은 고딕"; font-size:15px; width: 1700px; color :black;}

.btn { display:block; width:250px; height:50px; line-height:40px; border:1px white solid;  background-color: white; text-align:left; cursor: pointer; color: black; font-family: "배달의민족 한나체 Air"; font-size: 30px; transition:all 0.4s;}
.cbtn { display:block; width:250px; height:50px; line-height:40px; border:1px white solid;  background-color: #0D3EA3; text-align:left; cursor: pointer; color: white; font-family: "배달의민족 한나체 Air"; font-size: 30px; transition:all 0.4s;}
.btn:hover{color:white;}
.hover1:hover{ box-shadow:250px 0 0 0 #5AAEFF inset; }
</style>

<body>
<p style="margin-top:30px;"><h1> <a href = "Index.php" class="Title">소프트웨어학부 공동기기실 관리 페이지</a> <img src="NoonSong.png" height="100" style="text-align:bottom;"> </h1> </p>

<div id="GridForMenuAndArticle">
  <ol>
    <button class="btn hover1" onclick="location.href = 'Index.php'"> 홈 </button>
    <button class="btn hover1" onclick="location.href = 'Upload.php'"> 기자재 파일 업로드 </button>
    <button class="btn hover1" onclick="location.href = 'View.php'"> 기자재 조회 </button>
    <button class="btn hover1" onclick="location.href = 'Modify.php'" > 기자재 정보 수정 </button>
    <button class="cbtn" onclick="location.href = 'Discard.php'" > 기자재 폐기 </button>
    <hr style="border: dashed 3px #000051;">
    <button class="btn hover1" onclick="location.href = 'Rental.php'" > 대여 </button>
    <button class="btn hover1" onclick="location.href = 'Return.php'" > 반납 </button>
    <button class="btn hover1" onclick="location.href = 'Extension.php'" > 대여 연장 </button>
    <button class="btn hover1" onclick="location.href = 'RentalView.php'" > 대여 현황 조회 </button>
  </ol>
  <div id="article">

		<?php
 	 $conn = mysqli_connect("localhost", "root", "000000", "sw");

 	 $pname=$_POST['p_name'];
 	 $pid=$_POST['p_id'];
 	 $TrashDate=(string)$_POST['d_date'];

	 $query="UPDATE defaults
					 SET trash_date = '$TrashDate'
					 WHERE p_name like '$pname%' AND p_id = $pid";

 		 $result = mysqli_query($conn, $query);

		 if($result){
			 echo "<font size = 7> <<폐기 완료>>"; echo "<br />\n";
			 echo "<font size = 6> 물품명 : $pname"; echo "<br />\n";
			 echo "<font size = 6> 물품 번호 : $pid"; echo "<br />\n";
			 echo "<font size = 6> 폐기 날짜 : $TrashDate"; echo "<br />\n";
			 mysqli_close($conn);
		 }
		 else {
			 mysqli_close($conn);
			 echo '<p style = "color : black;"> 폐기 처리를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
		 }
 	 ?>

  </div>
</div>


</body>
</center>
</html>
