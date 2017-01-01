<?php
session_start();
$_SESSION['next'] = "1-3.php"; //CHANGE
include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
} else {
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $t = date('Y-m-d H:i:s', time());
    $sql = "INSERT INTO logs (id, url, start) VALUES ('" . $_SESSION['id'] . "','$url', '$t')";
///////////////// this is first page didn't use priv page

    if ($conn->query($sql) === true) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        header("location: next.php");
    }
    if (!$_SESSION['see_next']) {
        $t1 = time();
        $t2 = date('Y-m-d H:i:s', $t1);
        $sql = "UPDATE logs SET end='$t2' WHERE id='" . $_SESSION['id'] . "' and url='" . $_SESSION['previous'] . "'";
        $conn->query($sql);
    }

    $_SESSION['see_next'] = FALSE;
    $_SESSION['previous'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // current page
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

    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="container">
                <h3 dir="rtl" id="yui_3_17_2_2_1441439259925_322" style="text-align: justify;">عنوان درس: روش مکمل
                    2</h3>

                <p dir="RTL" id="yui_3_17_2_2_1441439259925_316" style="text-align: justify;">با توجه به آنچه تا کنون
                    فراگرفته اید، ممکن است فکر کنيد که طراح يک رايانه مي&shy; تواند هر رشته بيتی را به هر عدد صحيحی که
                    خود مي&shy;خواهد اختصاص دهد. شما درست فکر کرده&shy; اید. ليکن اين روش مي&shy;تواند مشکلات زيادی در
                    طراحی و ساخت يک مدار منطقی برای جمع دو عدد صحيح ايجاد نمايد. به همين علت است که روش&shy; های
                    مقدار-علامت و روش مکمل يک هر دو مناسب برای عمل جمع نبوده و طراحی مدارات منطقی جمع برای اين&shy; دو
                    مشکل مي&shy; باشد. بدين علت، طراحان کامپيوتر که از قبل مي&shy; دانستند که چگونه مدار منطقی جمع دو
                    عدد را طراحی کنند، بدنبال نمايشی از اعداد بودند که بتوان جمع اعداد را با ساده &shy;سازی مدار منطقی
                    انجام داد. لذا روش مکمل دو بوجود آمد که اکنون در تمامی رايانه&shy; های توليد شده، استفاده مي &shy;شود.</p>

                <p dir="RTL" style="text-align: justify;"><strong>سوال : چرا روش مكمل&nbsp; 2 براي نمايش اعداد انتخاب
                        شده است؟</strong></p>

                <p dir="rtl" style="text-align: justify;">پاسخ:&nbsp; اعداد صحيح مثبت را مي توان بسادگی بر مبنای موقعيت
                    مکانی بيت&shy; ها نشان داد. با داشتن 5 &nbsp;بيت، ما دقيقا نصف دو به توان 5 نمايش ممکن را برای نمايش
                    0 و اعداد صحيح مثبت بين 1 تا 1- 2<sup>5</sup> استفاده مي&shy; کنيم. انتخاب روش نمايش اعداد منفی بر
                    مبنای اين ايده است که تا حد امکان مدارهای منطقی را ساده نگاه داشت، به بيان ديگر سعی شود که نمايش
                    مطابق با روش کنونی جمع باشد که تقريبا در تمامی رايانه های موجود شبيه می &shy;باشد. واحدی که در
                    ريزپردازنده رايانه مسئوليت جمع را دارد بنام واحد عمليات رياضی و خوانده میشود.</p>

                <p dir="RTL" style="text-align: justify;">به طور کلی روش مکمل 2 روشی است برای نمایش منفی اعداد در مبنای
                    دو. برای اينکه نمايش &nbsp;A &nbsp;) &nbsp;-A عددی مخالف صفر است) را بدانیم می&shy; بایست تمامی بيت&shy;
                    های &nbsp;A را معکوس کرده، به بيانی مکمل یک &nbsp;آنرا بدست آورد، و سپس نمايش حاصل را با 1 جمع
                    نماييم. نمايش بدست آمده نمايش مكمل دو A- &nbsp;مي&shy; باشد.</p>

                <p dir="RTL" style="text-align: justify;">مثال: مکمل دو عدد 101101 را بدست آورید.</p>

                <p dir="RTL" style="text-align: justify;">در ابتدا مکمل یک عدد را که با معکوس کردن هر بیت حاصل می شود،&nbsp;
                    بدست می آوریم. مکمل یک برابر است با 010010 . حال این عدد را با یک جمع می کنیم. 010011 مکمل 2 مورد
                    نظر ما خواهد بود.&nbsp;</p>

            </div>
            <a href="1-3.php" class="btn btn-info" role="button">ادامه درس </a>
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
