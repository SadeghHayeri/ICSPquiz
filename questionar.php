<?php
session_start();
$_SESSION['next'] = "logout_page.php";
$_SESSION['current_q'] = "questionar";

include('connection.php');
if (empty($_SESSION['id'])) {
    header("location: index.php");
} else {
///////////////////////
    $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $sql = "INSERT INTO logs (id, url) VALUES ('" . $_SESSION['id'] . "','$url')";

    if ($conn->query($sql) === true) {
        //echo "New record created successfully";
    } else {
        //echo "Error: " . $sql . "<br>" . $conn->error;
        if (!(isset($_POST['ans']) || isset($_POST['end']))) {
//            header("location: end_effort.php");
        }
    }

    if (empty($_SESSION['current_q'])) {
        print("مسیر نا درست");
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

    <title>نظرسنجی</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/custom.css" rel="stylesheet">

    <!-- Jq -->

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
                    <a href="#"><b> </b></a>
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
    if (isset($_POST['ans']) || isset($_POST['end'])) {
        $res = array();
        $res[1] = trim($_POST['satis_1']);
        $res[2] = trim($_POST['satis_2']);
        $res[3] = trim($_POST['satis_3']);
        $res[4] = trim($_POST['satis_4']);
        $res[5] = trim($_POST['satis_5']);
        $hasEmptyField = false;
        foreach ($res as $v)
            if ($v == "")
                $hasEmptyField = true;
        if ($hasEmptyField) {
            echo '<div style="text-align: center; color: red;">"لطفا یکی از گزینه ها را انتخاب نمایید"</div>';
        } else {
            $counter = 1;
            foreach ($res as $v) {
                $sql = "INSERT INTO questions (id, question, answer, visit) VALUES ('" . $_SESSION['id'] . "', 'satis_".$counter."', '".$v."', 1)";
                if($conn->query($sql) == false)
                    die ($conn->error);
                $counter ++;
            }
            if (isset($_POST['end'])) {
                header("location: end_effort.php");
            } else {
                header("location:" . $_SESSION['next'] . "");
            }
        }
    }

    ?>
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="container">
                <!-- <img src="image/mbti.png" class="img-responsive"> -->
                <p dir="rtl" style="text-align: center;"><span style="font-size:18px;"><strong><span
                                    style="color: rgb(34, 34, 34); font face=" tahoma, sans-serif";  font-family: tahoma,sans-serif; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; display: inline ! important; float: none; background-color: rgb(255, 255, 255);"> پرشسنامه‌ی رضایتمندی کاربر </span></strong></span>
                </p>


                <p dir="rtl" style="text-align: justify;"><font face="tahoma, sans-serif"
                                                                style="color: rgb(34, 34, 34); font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: auto; text-align: start; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; background-color: rgb(255, 255, 255);"></font>
                    <span style="font face=" tahoma, sans-serif"; font-size: 12.8px; font-style: normal; font-variant:
                    normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px;
                    text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width:
                    0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51); line-height: 20px; text-align:
                    justify; background-color: rgb(255, 255, 255);">کاربر گرامی </span></p>

                <p dir="rtl" style="text-align: justify;"><span style="font face=" tahoma, sans-serif"; "font-size:
                    12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal;
                    orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing:
                    0px; -webkit-text-stroke-width: 0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51);
                    line-height: 20px; text-align: justify; background-color: rgb(255, 255, 255);"> لطفا پرشسنامه‌ی زیر
                    را با صادقت تکمیل نمایید. </span>
                    <span style="font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51); line-height: 20px; text-align: justify; background-color: rgb(255, 255, 255);"> </span>
                    <!-- <span style="font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51); line-height: 20px; text-align: justify; background-color: rgb(255, 255, 255);"> </span> -->
                    <!-- <span style="font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51); line-height: 20px; text-align: justify; background-color: rgb(255, 255, 255);"></span> -->
                    <!-- <span style="font-size: 12.8px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 1; word-spacing: 0px; -webkit-text-stroke-width: 0px; font-family: tahoma, sans-serif; color: rgb(51, 51, 51); line-height: 20px; text-align: justify; background-color: rgb(255, 255, 255);"></span> -->
                </p>

                <form role="form" method="post" id="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div dir="RTL" style="text-align: justify;">
                        <p><br></P>
                        <!--number 1-->
                        <p>1-محیط آموزشی حاضر را تا چه اندازه جذاب می‌دانید؟</p>
                        <label class="radio-inline">
                            <input type="radio" name="satis_1" value="1"> خیلی کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_1" value="2"> کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_1" value="3"> زیاد
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_1" value="4"> خیلی زیاد
                        </label>
                        <p><br></P>
                        <!--number 2-->
                        <p>2- محیط آموزشی حاضر تا چه اندازه به ویژگی‌های شخصیتی شما نزدیک بود؟</p>
                        <label class="radio-inline">
                            <input type="radio" name="satis_2" value="1"> خیلی کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_2" value="2"> کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_2" value="3"> زیاد
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_2" value="4"> خیلی زیاد
                        </label>
                        <p><br></P>
                        <!--number 3-->
                        <p>3- محیط آموزشی حاضر، تا چه اندازه وضعیت احساسی شما را درحین فرآیند یادگیری
                            <b><u>درک</u></b>
                            نمود؟</p>
                        <label class="radio-inline">
                            <input type="radio" name="satis_3" value="1"> خیلی کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_3" value="2"> کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_3" value="3"> زیاد
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_3" value="4"> خیلی زیاد
                        </label>
                        <p><br></p>
                        <!--number 4-->
                        <p>4- محیط آموزشی حاضر، تا چه اندازه (با توجه به وضعیت احساسی شما، درحین فرآیند یادگیری) واکنش
                            درست نشان داد؟</p>
                        <label class="radio-inline">
                            <input type="radio" name="satis_4" value="1"> خیلی کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_4" value="2"> کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_4" value="3"> زیاد
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_4" value="4"> خیلی زیاد
                        </label>
                        <p><br></p>
                        <!--number 5-->
                        <p>5- از نظر شما این محیط آموزشی تا چه اندازه می‌تواند در بهبود فرآیند یادگیری اشاره‌گرها موثر
                            واقع شود؟</p>
                        <label class="radio-inline">
                            <input type="radio" name="satis_5" value="1"> خیلی کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_5" value="2"> کم
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_5" value="3"> زیاد
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="satis_5" value="4"> خیلی زیاد
                        </label>
                    </div>
                    <input type="submit" class="btn btn-info" name="ans" id="button" onclick="return RadioValidator();"
                           value="خاتمه">
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

<SCRIPT LANGUAGE="JAVASCRIPT">
    function RadioValidator() {
        var ShowAlert = '';
        var AllFormElements = window.document.getElementById("form").elements;
        for (i = 0; i < AllFormElements.length; i++) {
            if (AllFormElements[i].type == 'radio') {
                var ThisRadio = AllFormElements[i].name;
                var ThisChecked = 'No';
                var AllRadioOptions = document.getElementsByName(ThisRadio);
                for (x = 0; x < AllRadioOptions.length; x++) {
                    if (AllRadioOptions[x].checked && ThisChecked == 'No') {
                        ThisChecked = 'Yes';
                        break;
                    }
                }
                var AlreadySearched = ShowAlert.indexOf(ThisRadio);
                if (ThisChecked == 'No' && AlreadySearched == -1) {
                    ShowAlert = 'شما به سوال' + ShowAlert + ThisRadio + ' پاسخ نداده اید\n';
                    if (ShowAlert != '') {
                        alert(ShowAlert);
                        return false;
                    }
                }
            }
        }
        if (ShowAlert != '') {
            alert(ShowAlert);
            return false;
        }
        else {
            return true;
        }
    }
</SCRIPT>

</body>

</html>
