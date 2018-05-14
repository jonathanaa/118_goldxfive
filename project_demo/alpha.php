<?php
include 'db_connection.php';
$conn=mysqli_connect($servername,$username,$password,$dbname);

mysqli_query($conn,"set names utf8");
if($_GET['ID']==null)
{
$_GET['ID']="2";
}
$sql="select * from producer where ID=".$_GET['ID'];
        $result=$conn->query($sql);
        $row=$result->fetch_assoc();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
    crossorigin="anonymous">

    <style>
    .jumbotron{
      margin-bottom:0px;
    }
    .navbar{
      background-color: rgba(33, 196, 55, 0.555);
    }
    </style>
</head>

<body>



  <div class="jumbotron jumbotron-fluid bg-success text-white text-center" >
    <div class="container ">

      <h1 class="display-1">示範電子商城</h1>

      <p class="lead">希望竹子能讓你的生活更好.....</p>
    </div>
  </div>
  <nav class="navbar navbar-toggleable-sm navbar-inverse flex-column">
    <div class="container">
      <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="mainNav">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" id="navbar1" onclick="removeActive()" href="#description" data-toggle="tab">業者資訊</a>
          <a class="nav-item nav-link" id="navbar2" onclick="removeActive()" href="#specification" data-toggle="tab">商品資訊</a>
          <a class="nav-item nav-link" id="navbar3" onclick="removeActive()" href="#carbon" data-toggle="tab">炭足跡</a>
        </div>
      </div>
    </div>
  </nav>



 <!-- 20171202更新 --> 
  <script>
    function removeActive() {
      var my_id1 = document.getElementById("navbar1");
      var my_id2 = document.getElementById("navbar2");
      var my_id3 = document.getElementById("navbar3");
      if(my_id1.className=="nav-item nav-link active")
      my_id1.className = "nav-item nav-link";
      if(my_id2.className=="nav-item nav-link active")
      my_id2.className = "nav-item nav-link";
      if(my_id3.className=="nav-item nav-link active")
      my_id3.className = "nav-item nav-link";
    } 
  </script>
<!-- 20171202更新 --> 

<!-- 20171204 更新 -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="first-slide" src="123.jpg " alt="First slide" style="width:100%;">
      
    </div>
    <div class="carousel-item">
      <img class="second-slide center" src="123.jpg" style="width:100%;" alt="Second slide">

    </div>
    <div class="carousel-item">
      <img class="third-slide" src="123.jpg  " alt="Third slide" style="width:100%;">
      
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
 <!-- 20171204 更新 -->

  <div class="container">
    <div class="row">
      <div class="tab-content py-5">
        <div class="tab-pane active" id="description">
          <h3>產品名稱:<?php echo $row["name"];?></h3>
		  <h3>製造商:<?php echo $row["shop"];?></h3>
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-3">
                <img src="../46/beta/upload/<?php echo $row["picture_name"]?>" class=" img-fluid " />
              </div>
              <div class="col-md-6 col-sm-9">
                <p>產品介紹
                </p>
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="specification">
          <h3>產品規格</h3>
          <p>介紹產品</p>
          <div class="container">
            <div class="row">
              <div class="col-12">
                <img src="123.jpg " class=" img-fluid " />
              </div>
            </div>
          </div>
        </div>
        <div class="tab-pane" id="carbon">
          <h3>炭足跡</h3>
          <div class="container">
            <div class="row">
              <div class="col-6">
                <img src="carbonfoot.jpg " class=" img-fluid " />
              </div>
              <div class="col-6">
                <img src="carbonfoot.jpg " class=" img-fluid " />
              </div>
            </div>

          </div>
          <hr color="#227700" size="10">
          <div class="container">
            <div class="row">
              <h3><span data-toggle = "tooltip" title="--炭軌跡" class="text">竹子小百科</span></h3>
            </div>
            <div class="row">
              <div class="col-6">
                炭軌跡主要是在說明植物可以在成長過程中將多少的碳變成植物本身的指數，根據老師給我們的論文中提到，一公斤的竹炭所產生的碳軌跡為0.54公斤，這意味著，每種植一公斤的竹子，可以將0.5公斤的CO2作為竹子的本身(轉換率為50%)，相較於其他的植物(僅35%的轉換率)有相當大的落差，若能將大多數的產品改作竹子，可以多為地球盡一份心力
              </div>
              <div class="col-6">
                這裡是動畫
              </div>
            </div>
            <br>
            <br>
            <div class="row">
              <div class="col-12">
                <table border="1" style="width:100%;">
                  <tr>
                    <td>產品碳足跡</td>
                    <td>產品碳軌跡</td>
                  </tr>
                  <tr>
                    <td>計算過的碳足跡數字</td>
                    <td>計算過的碳軌跡數字</td>
                  </tr>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  




  <!--
  <div class="container ">
    
    <div class="row ">
      <div class="col-md-3 col-lg-6 ">
        <div class="card ">
          <div class="card-block bg-success text-white ">
            <h3 class="card-title ">title</h3>
            <p>this is a card</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-lg-6 ">
        <div class="card ">
          <div class="card-block bg-success text-white ">
            <h3 class="card-title ">title</h3>
            <p>this is a card</p>
          </div>
        </div>
      </div>
      <div class="col-md-3 col-lg-6 ">
        <div class="card ">
          <div class="card-block bg-success text-white ">
            <h3 class="card-title ">title</h3>
            <p>this is a card</p>
          </div>
        </div>

      </div>
      <div class="col-md-3 col-lg-6 ">
        <div class="card ">
          <div class="card-block bg-success text-white ">
            <h3 class="card-title ">title</h3>
            <p>this is a card</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <h2 class="display-4 text-center py-5 my-4 ">產品介紹</h2>

  <nav class="nav justify-content-center nav-pills flex-column flex-md-row ">
    <a class="nav-link active " href="#" data-toggle="tab">產品描述</a>
    <a class="nav-link" href="#" data-toggle="tab">產品規格</a>
    <a class="nav-link" href="#" data-toggle="tab">問與答</a>
    <a class="nav-link" href="#" data-toggle="tab">竹子小百科</a>
  </nav>
-->
  <!-- jQuery first, then Tether, then Bootstrap JS. -->
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js " integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n "
    crossorigin="anonymous "></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js " integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb "
    crossorigin="anonymous "></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js " integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn "
    crossorigin="anonymous "></script>

</body>
<?php  $conn->close();?>
</html>