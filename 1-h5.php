<?php
session_start();
include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
} else {
///////////////////////
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $sql = "INSERT INTO logs (id, url) VALUES ('" . $_SESSION['id'] . "','$url')";

    if ($conn->query($sql) === TRUE) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
    }

    if (empty($_SESSION['current_q'])) {
        print("مسیر نا درست");
    } else {
        $sql = "UPDATE questions SET hint=1 WHERE id='" . $_SESSION['id'] . "' and question='" . $_SESSION['current_q'] . "'";
        $conn->query($sql);
        $sql2 = "DELETE FROM `logs` WHERE id='" . $_SESSION['id'] . "' and `url`='" . $_SESSION['previous'] . "'";
        $conn->query($sql2);
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
        $res = @trim($_POST['hintradio']);

        if ($res == "") {
            echo '<div style="text-align: center; color: red;">"لطفا یکی از گزینه ها را انتخاب نمایید"</div>';
        } else {
            $sql = "UPDATE questions SET hint_rate=$res  WHERE id='" . $_SESSION['id'] . "' and question='" . $_SESSION['current_q'] . "'";
            $conn->query($sql);
            $page = $_SESSION['current_q'] . ".php";
            header("location:" . $page . "");
        }
    }

    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="container">
                <p dir="rtl" style="text-align: justify;"><strong>"راهنمایی":</strong>در همه ی برنامه های خود از فایل استاندارد استفاده میکنید :)</p>

                <p dir="rtl" style="text-align: justify;">این میزان راهنمایی تا چه حد برای شما مفید بود؟</p>


                <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="radio">
                        <label><input type="radio" name="hintradio" value="1">خیلی کم</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="hintradio" value="2">کم</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="hintradio" value="3">متوسط</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="hintradio" value="4">زیاد</label>
                    </div>
                    <div class="radio">
                        <label><input type="radio" name="hintradio" value="5">خیلی زیاد</label>
                    </div>
                    <input type="submit" class="btn btn-info" name="ans" value="بازگشت به سوال">
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<!-- jQuery Version 1.11.1 -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>
