<?php
session_start();
$_SESSION['next']="1-2.php"; //CHANGE

include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
}
$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
$t=date('Y-m-d H:i:s',time());
$sql = "INSERT INTO logs (id, url, start)
VALUES ('".$_SESSION['id']."','$url', '$t')"; 
///////////////// this is first page didn't use priv page

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    //echo "Error: " . $sql . "<br>" . $conn->error;
    header("location: next.php");
}

$_SESSION['see_next']= FALSE;
$_SESSION['previous']="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']; // current page

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
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
            <div class="col-lg-12 text-center" >
                <div class="container" >
                    <p dir="rtl" id="yui_3_17_2_2_1441434397925_318" style="text-align: justify;"><span id="yui_3_17_2_2_1441434397925_317"><span id="yui_3_17_2_2_1441434397925_316">با سلام دانشجوی عزیز</span></span></p>

<p dir="rtl" style="text-align: justify;"><span><span>به سیستم کلاس یادگیری آنلاین خوش آمدید. دقت نمایید تمام رفتار شما در این سیستم ثبت می گردد و قابل مشاهده توسط اساتید محترم می باشد. لذا تفاوتی بین این جلسه از کلاس آنلاین و کلاس حضوری نمی باشد. خواهشمند است با دقت مطالب را مطالعه و سوالات را پاسخ دهید. حضور شما در این جلسه کلاس و نمرات شما در این جلسه، در نمره نهایی پایان ترم تاثیر </span><span>گذار است. پس لطفا دقت کافی نمایید. قابل ذکر است در انتخاب هر کدام از مسیرهای پیشنهادی در هر صفحه اختیار با شماست و میتوانید هر مسیری را به دلخواه انتخاب نمایید. در هر مرحله از فرآیند آموزش شما امکان اتمام کلاس را دارید و این مسئله در محاسبه نمره نهایی شما تاثیری ندارد.</span></span></p>

<p dir="rtl" style="text-align: justify;"><span><span>با آرزوی موفقیت</span></span></p>


                </div>
                <a href= <?php echo $_SESSION['next']; ?>
                 class="btn btn-info" role="button">شروع درس</a>
                
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
