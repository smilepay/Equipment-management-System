<!doctype html> <html> <center> <head> <title>소프트웨어학부 공동기기실</title>
 <meta charset="utf-8"> </head>

 <style>
 .Title{text-decoration: none; color:#000051;  font-size:50px;  font-family: "배달의민족 한나체 Pro"; text-align: center;  border-bottom:10px solid white; margin:0; padding:20px; }
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
 <p style="margin-top:30px;"><h1> <a href = "Index.php" class="Title">소프트웨어학부 공동기기실 관리 페이지</a>
   <img src="NoonSong.png" height="100" style="text-align:bottom;"> </h1> </p>

 <div id="GridForMenuAndArticle">
   <ol>
     <button class="btn hover1" onclick="location.href = 'Index.php'"> 홈 </button>
     <button class="btn hover1" onclick="location.href = 'Upload.php'"> 기자재 파일 업로드 </button>
     <button class="cbtn" onclick="location.href = 'View.php'"> 기자재 조회 </button>
     <button class="btn hover1" onclick="location.href = 'Modify.php'" > 기자재 정보 수정 </button>
     <button class="btn hover1" onclick="location.href = 'Discard.php'" > 기자재 폐기 </button>
     <hr style="border: dashed 3px #000051;">
     <button class="btn hover1" onclick="location.href = 'Rental.php'" > 대여 </button>
     <button class="btn hover1" onclick="location.href = 'Return.php'" > 반납 </button>
     <button class="btn hover1" onclick="location.href = 'Extension.php'" > 대여 연장 </button>
     <button class="btn hover1" onclick="location.href = 'RentalView.php'" > 대여 현황 조회 </button>
   </ol>
     <div id="article">

       <form action="ViewPost.php" method="post">
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
         조회할 항목 선택 : <input type = "text" name="Column_Choice" placeholder="눌러서 선택하세요" list = "Column_List" style = "font-size : 15pt; width : 250px;">
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
         <input type = "submit" value="조회하기" style = "font-size : 20pt; background-color : white; color : #0D3EA3; padding-left:30px; padding-right:30px; margin-left:50px; margin-top:40px;">
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

			 if ( ($pname == '') && ($pid == '') && ($CC == '') ){ //1. 전체 레코드 출력
				 $query="SELECT *
								 FROM defaults
								 ORDER BY p_name";

				 $result = mysqli_query($conn, $query);

				 if($result){
					 echo  '<table border="1"> <tr bgcolor = "#7ED2FF"> <th>회사코드</th> <th>자산번호</th> <th>물품번호</th> <th>물품명</th> <th>모델명</th> <th>규격사양</th><th>수량</th><th>수용부서명</th><th>사용부서코드</th>
								 <th>책임자명</th><th>위치내역</th><th>구입금액</th><th>취득일자</th><th>폐기일자</th><th>변동사항기록</th><th>비고</th><th>TAG 발급요청</th>  </tr> ';
					 $n = 1;
					 while($row = mysqli_fetch_array($result)){
							echo '<tr bgcolor = "white">';
							echo '<td>' . $row['company_code'] . '</td>';
							echo '<td>' . $row['m_id'] . '</td>';
							echo '<td>' . $row['p_id'] . '</td>';
							echo '<td>' . $row['p_name'] . '</td>';
							echo '<td>' . $row['model_name'] . '</td>';
							echo '<td>' . $row['size'] . '</td>';
							echo '<td>' . $row['quantity'] . '</td>';
							echo '<td>' . $row['dept_name'] . '</td>';
							echo '<td>' . $row['dept_code'] . '</td>';
							echo '<td>' . $row['leader'] . '</td>';
							echo '<td>' . $row['location'] . '</td>';
							echo '<td>' . $row['price'] . '</td>';
							echo '<td>' . $row['get_date'] . '</td>';
							echo '<td>' . $row['trash_date'] . '</td>';
							echo '<td>' . $row['changes'] . '</td>';
							echo '<td>' . $row['adds'] . '</td>';
							echo '<td>' . $row['tag'] . '</td>';
							echo '</tr>';
							$n++;
					}
					echo '</table>';
					mysqli_close($conn);
				}
				 else {
					 mysqli_close($conn);
					 echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
				 }
			 }
			 else if ( ($pname == '') && ($pid == '') && ($CC != '')){ //2. 전체 물품들의 선택한 컬럼 값만 출력
				 $query="SELECT p_name, p_id, $CCT
								 FROM defaults
								 ORDER BY p_name";

				 $result = mysqli_query($conn, $query);

				 if($result){
					 echo  "<table border='1'> <tr bgcolor = '#7ED2FF'><th>물품번호</th> <th>물품명</th><th>$CC</th>  </tr> ";
					 $n = 1;
					 while($row = mysqli_fetch_array($result)){
							echo '<tr bgcolor = "white">';
							echo '<td>' . $row['p_id'] . '</td>';
							echo '<td>' . $row['p_name'] . '</td>';
							echo '<td>' . $row[$CCT] . '</td>';
							echo '</tr>';
							$n++;
					}
					echo '</table>';
					mysqli_close($conn);
				}
				 else {
					 mysqli_close($conn);
					 echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
				 }

			 }
			 else if( ($pname == '') && ($pid != '') && ($CC == '') ) { //3. 해당하는 물품 번호의 물품 정보 전체 출력
         $query="SELECT *
								 FROM defaults
                 WHERE p_id = $pid";

				 $result = mysqli_query($conn, $query);

				 if($result){
					 echo   '<table border="1"> <tr bgcolor = "#7ED2FF"> <th>회사코드</th> <th>자산번호</th> <th>물품번호</th> <th>물품명</th> <th>모델명</th> <th>규격사양</th><th>수량</th><th>수용부서명</th><th>사용부서코드</th> <th>책임자명</th><th>위치내역</th><th>구입금액</th><th>취득일자</th><th>폐기일자</th><th>변동사항기록</th><th>비고</th><th>TAG 발급요청</th>  </tr> ';
					 $n = 1;

					 while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['company_code'] . '</td>';
             echo '<td>' . $row['m_id'] . '</td>';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row['model_name'] . '</td>';
             echo '<td>' . $row['size'] . '</td>';
             echo '<td>' . $row['quantity'] . '</td>';
             echo '<td>' . $row['dept_name'] . '</td>';
             echo '<td>' . $row['dept_code'] . '</td>';
             echo '<td>' . $row['leader'] . '</td>';
             echo '<td>' . $row['location'] . '</td>';
             echo '<td>' . $row['price'] . '</td>';
             echo '<td>' . $row['get_date'] . '</td>';
             echo '<td>' . $row['trash_date'] . '</td>';
             echo '<td>' . $row['changes'] . '</td>';
             echo '<td>' . $row['adds'] . '</td>';
             echo '<td>' . $row['tag'] . '</td>';
             echo '</tr>';
             $n++;
					}
					echo '</table>';
					mysqli_close($conn);
				}
				 else {
					 mysqli_close($conn);
					 echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
				 }
			 }
			 else if (($pname == '') && ($pid != '') && ($CC != '')) { //4. 해당하는 물품 번호의 선택한 컬럼 값만 출력
         $query="SELECT p_name, p_id, $CCT
                 FROM defaults
                 WHERE p_id = $pid";

         $result = mysqli_query($conn, $query);

         if($result){
           echo "<table border='1'> <tr bgcolor = '#7ED2FF'><th>물품번호</th> <th>물품명</th><th>$CC</th>  </tr> ";
           $n = 1;
           while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row[$CCT] . '</td>';
             echo '</tr>';
             $n++;
          }
          echo '</table>';
          mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }
			 }
			 else if( ($pname != '') && ($pid == '') && ($CC == '')) {//5. 해당하는 물품 종류의 물품 정보 전체 출력
         $query="SELECT *
                 FROM defaults
                 WHERE p_name = '$pname'";

         $result = mysqli_query($conn, $query);

         if($result){
           echo '<table border="1"> <tr bgcolor = "#7ED2FF"> <th>회사코드</th> <th>자산번호</th> <th>물품번호</th> <th>물품명</th> <th>모델명</th> <th>규격사양</th><th>수량</th><th>수용부서명</th><th>사용부서코드</th> <th>책임자명</th><th>위치내역</th><th>구입금액</th><th>취득일자</th><th>폐기일자</th><th>변동사항기록</th><th>비고</th><th>TAG 발급요청</th>  </tr> ';
           $n = 1;
           while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['company_code'] . '</td>';
             echo '<td>' . $row['m_id'] . '</td>';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row['model_name'] . '</td>';
             echo '<td>' . $row['size'] . '</td>';
             echo '<td>' . $row['quantity'] . '</td>';
             echo '<td>' . $row['dept_name'] . '</td>';
             echo '<td>' . $row['dept_code'] . '</td>';
             echo '<td>' . $row['leader'] . '</td>';
             echo '<td>' . $row['location'] . '</td>';
             echo '<td>' . $row['price'] . '</td>';
             echo '<td>' . $row['get_date'] . '</td>';
             echo '<td>' . $row['trash_date'] . '</td>';
             echo '<td>' . $row['changes'] . '</td>';
             echo '<td>' . $row['adds'] . '</td>';
             echo '<td>' . $row['tag'] . '</td>';
             echo '</tr>';
             $n++;
          }
          echo '</table>';
          mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }

			 }
			 else if( ($pname != '') && ($pid == '') && ($CC != '')) { //6. 해당하는 물품 종류의 선택한 컬럼 값만 출력
         $query="SELECT p_name, p_id, $CCT
                 FROM defaults
                 WHERE p_name = '$pname'";

         $result = mysqli_query($conn, $query);

         if($result){
           echo "<table border='1'> <tr bgcolor = '#7ED2FF'><th>물품번호</th> <th>물품명</th><th>$CC</th>  </tr> ";
           $n = 1;
           while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row[$CCT] . '</td>';
             echo '</tr>';
             $n++;
          }
          echo '</table>';
          mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }

			 }
			 else if( ($pname != '') && ($pid != '') && ($CC == '')) { //7. 해당하는 물품 종류, 물품 번호의 물품 정보 전체 출력
         $query="SELECT *
                 FROM defaults
                 WHERE p_name = '$pname' AND p_id = $pid";

         $result = mysqli_query($conn, $query);

         if($result){
           echo '<table border="1"> <tr bgcolor = "#7ED2FF"> <th>회사코드</th> <th>자산번호</th> <th>물품번호</th> <th>물품명</th> <th>모델명</th> <th>규격사양</th><th>수량</th><th>수용부서명</th><th>사용부서코드</th> <th>책임자명</th><th>위치내역</th><th>구입금액</th><th>취득일자</th><th>폐기일자</th><th>변동사항기록</th><th>비고</th><th>TAG 발급요청</th>  </tr> ';
           $n = 1;
           while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['company_code'] . '</td>';
             echo '<td>' . $row['m_id'] . '</td>';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row['model_name'] . '</td>';
             echo '<td>' . $row['size'] . '</td>';
             echo '<td>' . $row['quantity'] . '</td>';
             echo '<td>' . $row['dept_name'] . '</td>';
             echo '<td>' . $row['dept_code'] . '</td>';
             echo '<td>' . $row['leader'] . '</td>';
             echo '<td>' . $row['location'] . '</td>';
             echo '<td>' . $row['price'] . '</td>';
             echo '<td>' . $row['get_date'] . '</td>';
             echo '<td>' . $row['trash_date'] . '</td>';
             echo '<td>' . $row['changes'] . '</td>';
             echo '<td>' . $row['adds'] . '</td>';
             echo '<td>' . $row['tag'] . '</td>';
             echo '</tr>';
             $n++;
          }
          echo '</table>';
          mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }

			 }
			 else { //8. 해당하는 물품 종류, 물품 번호의 선택한 컬럼 값만 출력
         $query="SELECT p_name, p_id, $CCT
                 FROM defaults
                 WHERE p_name = '$pname' AND p_id = $pid";

         $result = mysqli_query($conn, $query);

         if($result){
           echo "<table border='1'> <tr bgcolor = '#7ED2FF'><th>물품번호</th> <th>물품명</th><th>$CC</th>  </tr> ";
           $n = 1;
           while($row = mysqli_fetch_array($result)){
             echo '<tr bgcolor = "white">';
             echo '<td>' . $row['p_id'] . '</td>';
             echo '<td>' . $row['p_name'] . '</td>';
             echo '<td>' . $row[$CCT] . '</td>';
             echo '</tr>';
             $n++;
          }
          echo '</table>';
          mysqli_close($conn);
         }
         else {
           mysqli_close($conn);
           echo '<p style = "color : black;"> 조회를 실패하였습니다. 인터넷 연결을 확인해주세요.</p>';
         }
			 }

       ?>

     </div>
 </div>


 </body>
 </center>
 </html>
