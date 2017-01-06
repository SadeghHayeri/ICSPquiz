<?php
session_start();
$_SESSION['next'] = "2-e3.php";
$_SESSION['current_q'] = "2-q3";
$_SESSION['ans'] = -1;
include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
} else {
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $t = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO logs (id, url, start) VALUES ('" . $_SESSION['id'] . "','$url', '$t')";
///////////////// this is final page dont have next page////////////////////

    if ($conn->query($sql) === true) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        if (!isset($_POST['ans'])) {
//            header("location: next.php");
        }
    }
    if (!$_SESSION['see_next']) {
        $t1 = time();
        $t2 = date('Y-m-d H:i:s', $t1);
        $sql = "UPDATE logs SET end='$t2' WHERE id='" . $_SESSION['id'] . "' and url='" . $_SESSION['previous'] . "'";
        $conn->query($sql);
    }

    $_SESSION['see_next'] = FALSE;
    $_SESSION['previous'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // current page

    $sql = "INSERT INTO questions (id, question, answer, visit) VALUES ('" . $_SESSION['id'] . "','" . $_SESSION['current_q'] . "', -1,1)";
    $conn->query($sql);
    $sql = "SELECT * FROM questions WHERE id='" . $_SESSION['id'] . "' and question='" . $_SESSION['current_q'] . "'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if($row['answer'] != -1){
        header("location: next.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CECM94</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            padding-top: 70px;
            /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
        }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="#"><b>  <?php print($_SESSION['username']) ?> </b></a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>

<!-- Page Content -->
<div class="container">
    <?php

    if (isset($_POST['ans'])) {
        $res = @trim($_POST['optradio']);

        if ($res == "") {
            echo '<div style="text-align: center; color: red;">"لطفا یکی از گزینه ها را انتخاب نمایید"</div>';
        } else if ($res == "4") {
            $sql = "UPDATE questions SET answer=1 WHERE id='" . $_SESSION['id'] . "' and question='" . $_SESSION['current_q'] . "'";
            $conn->query($sql);
            $_SESSION['ans'] = 1;
            header("location:" . $_SESSION['next'] . "");
        } else {
            $sql = "UPDATE questions SET answer=0 WHERE id='" . $_SESSION['id'] . "' and question='" . $_SESSION['current_q'] . "'";
            $conn->query($sql);
            $_SESSION['ans'] = 0;
            header("location:" . $_SESSION['next'] . "");
            /*
            $sql = "SELECT reset from questions where id='".$_SESSION['id']."' and question='".$_SESSION['current_q']."'";
            $result = $conn->query($sql);
            $row = mysqli_fetch_assoc($result);

            if($row['reset']!=0){
              header( "location:".$_SESSION['next']."" );
            }
            else{
              header("location: wrong.php");
            }
            */
            //header("location: wrong.php");
            /*if(!$_SESSION['reset']){
              header("location: wrong.php");
            }
            else{
              header( "location:".$_SESSION['next']."" );
            }*/
        }

    }

    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
          <p dir="rtl" style="text-align: justify;"><strong>سوال : </strong>خروجی قطعه کد زیر کدام است؟</p>
          <img src="img/3.png" alt="">
          <!-- <p dir="rtl" style="text-align: justify;">با اجرای <img src="img/Screen Shot 2016-12-14 at 6.18.51 PM.png" alt=""> کدام یک از اتفاقات زیر رخ خواهد داد؟</p> -->

            <form role="form" id="myForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" style="direction: rtl; text-align: right">
                <div class="radio">
                    <label><input id="check" type="radio" name="optradio" value="1" style="margin-right: -18px;">Error: cannot convert from void** to int**</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio" value="2" style="margin-right: -18px;">No output</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio" value="3" style="margin-right: -18px;">Garbage value</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="optradio" value="4" style="margin-right: -18px;">0</label>
                </div>
                <input type="submit" class="btn btn-info" name="ans" value="ارسال پاسخ">
                <a href="2-h3.php" class="btn btn-info" role="button"> راهنمایی</a>
                <!-- <a href="end_effort.php" class="btn btn-info" role="button"> خاتمه آزمون</a> -->
            </form>

        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script>
  $(document).ready( function() {
    setTimeout(function () {
      $('#check').prop("checked", true)
      $('#myForm').submit();
    }, 1000 * 60 * 3);
  });
</script>
</body>

</html>
