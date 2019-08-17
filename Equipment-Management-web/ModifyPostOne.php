<!doctype html> <html> <center> <head> <title>소프트웨어학부 공동기기실</title>
 <meta charset="utf-8"> </head>

 <style>
 .Title{text-decoration: none; color:#000051; font-size:50px;  font-family: "배달의민족 한나체 Pro"; text-align: center;  border-bottom:10px solid white; margin:0; padding:20px; }
 .Normal{color:black; text-decoration: none; font-size: 20px;}
 .Watching{color:green; font-size: 20px;}
 body{margin:0; background-color: #D6F0FF;}
 ol{ height: 1500px; border-right:5px solid #000051; width:250px; padding:0px; background-color: white;  text-align: left; }
 #GridForMenuAndArticle{display: grid; grid-template-columns: 450px 300px;  margin-top : 40px; }
 #article{ text-align: left; padding-top : 10px; font-family: "맑은 고딕"; font-size:20px; width: 1700px; color :black;}

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
     <button class="cbtn" onclick="location.href = 'Modify.php'" > 기자재 정보 수정 </button>
     <button class="btn hover1" onclick="location.href = 'Discard.php'" > 기자재 폐기 </button>
     <hr style="border: dashed 3px #000051;">
     <button class="btn hover1" onclick="location.href = 'Rental.php'" > 대여 </button>
     <button class="btn hover1" onclick="location.href = 'Return.php'" > 반납 </button>
     <button class="btn hover1" onclick="location.href = 'Extension.php'" > 대여 연장 </button>
     <button class="btn hover1" onclick="location.href = 'RentalView.php'" > 대여 현황 조회 </button>
   </ol>
     <div id="article">

       <form action="ModifyPostOne.php" method="post">
         물품 종류 선택 : <input type = "text" name="p_name" placeholder="눌러서 선택하세요" list = "ProductType" style = "font-size : 15pt; width : 250px;">
         <datalist id = "ProductType">
           <option value = "모니터">
           <option value = "실습실 컴퓨터">
           <option value = "PC 테이블">
           <option value = "회의용 의자">
           <option value = "LED 모니터">
           <option value = "컴퓨터">
           <option value = "노트북 컴퓨터">
           <option value = "서버">
           <option value = "프린터 과금 관리 프로그램">
         </datalist>
         물품 번호 입력  : <input type = "number" name="p_id" style = "font-size : 15pt; width : 250px;">
         수정할 항목 : <input type = "text" name="Column_Choice" placeholder="눌러서 선택하세요" list = "Column_List" style = "font-size : 15pt; width : 250px;">
         <datalist id = "Column_List">
           <option value = "물품명">
           <option value = "모델명">
           <option value = "규격사양">
           <option value = "수량">
           <option value = "사용부서명">
           <option value = "사용부서코드">
           <option value = "책임자명">
           <option value = "위치내역">
           <option value = "구입금액">
           <option value = "취득일자">
           <option value = "폐기일자">
           <option value = "변동 사항">
           <option value = "비고">
           <option value = "TAG">
         </datalist>
         <input type = "submit" value="검색하기" style = "font-size : 20pt; background-color : white; color : #0D3EA3; padding-left:30px; padding-right:30px; margin-left:50px; margin-top:40px;">
       </form>

       <?php
       $conn = mysqli_connect("localhost", "root", "000000", "sw");

       $pname=$_POST['p_name'];
       $pid=$_POST['p_id'];
       $CC=$_POST['Column_Choice'];

			 if($CC == '물품명'){
				 $CCT = 'p_name';
			 }
			 else if ($CC == '모델명'){
				 $CCT = 'model_name';
			 }
			 else if ($CC == '규격사양'){
				 $CCT = 'size';
			 }
			 else if ($CC == '수량'){
				 $CCT = 'quantity';
			 }
			 else if ($CC == '사용부서명'){
				 $CCT = 'dept_name';
			 }
			 else if ($CC == '사용부서코드'){
				 $CCT = 'dept_code';
			 }
			 else if ($CC == '책임자명'){
				 $CCT = 'leader';
			 }
			 else if ($CC == '위치내역'){
				 $CCT = 'location';
			 }
			 else if ($CC == '구입금액'){
				 $CCT = 'price';
			 }
			 else if ($CC == '취득일자'){
				 $CCT = 'get_date';
			 }
			 else if ($CC == '폐기일자'){
				 $CCT = 'trash_date';
			 }
			 else if ($CC == '변동 사항'){
				 $CCT = 'changes';
			 }
			 else if ($CC == '비고'){
				 $CCT = 'adds';
			 }
			 else if ($CC == 'TAG'){
				 $CCT = 'tag';
			 }
			 echo '<p>   </p>';
			 echo '<p>   </p>';

			 if( ($pname != '') && ($pid != '') && ($CC != '')) { //해당하는 물품 종류, 물품 번호의 선택한 컬럼 값만 출력
         $query="SELECT p_name, p_id, $CCT
                 FROM defaults
                 WHERE p_name = '$pname' AND p_id = $pid";

         $result = mysqli_query($conn, $query);

         if($result){
           echo "<table border='1'> <font size=7> <tr bgcolor = '#7ED2FF'>  <th>물품번호</th> <th>물품명</th><th>$CC</th>  </tr> ";
           $n = 1;
					 if($row = mysqli_fetch_array($result)){
						 echo '<tr bgcolor = "white">';
						 echo '<td> <font size=5>' . $row['p_id'] . '</td>';
						 echo '<td> <font size=5>' . $row['p_name'] . '</td>';
						 echo '<td> <font size=5>' . $row[$CCT] . '</td>';
						 echo '</tr>';
						 $n++;
						 echo '</table>';
					 }
					 else {
						  echo '<p style = "color : black;"> 조회를 실패하였습니다. 검색 조건을 확인해주세요.</p>';
					 }
	         mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }

			 }
			else {
				 echo '<p style = "color : black;"> 조회를 실패하였습니다. 검색 조건을 확인해주세요.</p>';
			}
			 ?>
			 <br>

			 <form action="ModifyPostTwo.php" method="post">
				 <?php echo "<font size=5>".$CC;?> : <input type = "text" name="m_text" placeholder="수정할 내용을 입력하세요" style = "font-size : 15pt; width : 600px; height : 100px">
				 <input type = "hidden" name="Column_Choice" value = <?php echo $CC;?> >
				 <input type = "hidden" name="p_id" value = <?php echo $pid;?> >
				 <input type = "hidden" name="p_name" value = <?php echo $pname;?> >
				 <input type = "submit" value="수정하기" style = "font-size : 20pt; background-color : white; color : #0D3EA3; padding-left:30px; padding-right:30px; margin-left:50px; margin-top:40px;">
			 </form>

     </div>
 </div>


 </body>
 </center>
 </html>
