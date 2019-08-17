<!doctype html> <html> <center> <head> <title>소프트웨어학부 공동기기실</title>
<meta charset="utf-8"> </head>

<style>
.Title{text-decoration: none; color:#000051;  font-size:50px;  font-family: "배달의민족 한나체 Pro"; text-align: center;  border-bottom:10px solid white; margin:0; padding:20px; }
.Normal{color:black; text-decoration: none; font-size: 20px;}
.Watching{color:green; font-size: 20px;}
body{margin:0; background-color: #D6F0FF;}
ol{ height: 1500px; border-right:5px solid #000051; width:250px; padding:0px; background-color: white;  text-align: left; }
#GridForMenuAndArticle{display: grid; grid-template-columns: 450px 300px;  margin-top : 40px; }
#article{ text-align:center; padding-top : 10px; font-family: "배달의민족 한나체 Air"; padding-left:20px; font-size:40px; width: 1000px; color :black;}

.btn { display:block; width:250px; height:50px; line-height:40px; border:1px white solid;  background-color: white; text-align:left; cursor: pointer; color: black; font-family: "배달의민족 한나체 Air"; font-size: 30px; transition:all 0.4s;}
.cbtn { display:block; width:250px; height:50px; line-height:40px; border:1px white solid;  background-color: #0D3EA3; text-align:left; cursor: pointer; color: white; font-family: "배달의민족 한나체 Air"; font-size: 30px; transition:all 0.4s;}
.btn:hover{color:white;}
.hover1:hover{ box-shadow:250px 0 0 0 #5AAEFF inset; }
</style>

<body>
<p style="margin-top:30px;"><h1> <a href = "Index.php" class="Title">소프트웨어학부 공동기기실 관리 페이지</a> <img src="NoonSong.png" height="100";> </h1> </p>

<div id="GridForMenuAndArticle">
  <ol>
    <button class="cbtn" onclick="location.href = 'Index.php'"> 홈 </button>
    <button class="btn hover1" onclick="location.href = 'Upload.php'"> 기자재 파일 업로드 </button>
    <button class="btn hover1" onclick="location.href = 'View.php'"> 기자재 조회 </button>
    <button class="btn hover1" onclick="location.href = 'Modify.php'" > 기자재 정보 수정 </button>
    <button class="btn hover1" onclick="location.href = 'Discard.php'" > 기자재 폐기 </button>
    <hr style="border: dashed 3px #000051;">
    <button class="btn hover1" onclick="location.href = 'Rental.php'" > 대여 </button>
    <button class="btn hover1" onclick="location.href = 'Return.php'" > 반납 </button>
    <button class="btn hover1" onclick="location.href = 'Extension.php'" > 대여 연장 </button>
    <button class="btn hover1" onclick="location.href = 'RentalView.php'" > 대여 현황 조회 </button>
  </ol>
    <div id="article">
      <p>소프트웨어학부 기자재 관리 페이지 방문을 환영합니다</p>
      <img src="WelcomeNoonSong.gif"; height="300px";>
    </div>
</div>


</body>
</center>
</html>
