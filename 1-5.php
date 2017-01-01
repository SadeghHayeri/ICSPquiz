<?php
session_start();
$_SESSION['next'] = "1-q1.php"; //CHANGE
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
                <h3 dir="rtl" style="text-align: justify;">عنوان درس: جمع و تفريق اعداد باینری</h3>

                <div class="box contents" dir="rtl" id="yui_3_17_2_2_1442312328006_431">
                    <div class="no-overflow" id="yui_3_17_2_2_1442312328006_430">
                        <p id="yui_3_17_2_2_1442312328006_429" style="text-align: justify;">جمع دو عدد باينری همانند جمع
                            دو عدد دسيمال (دهدهی) با جمع از راست به چپ و ستون به ستون انجام مي&shy; گيرد. اگر جمع دو
                            مقدار باعث ايجاد رقم انتقالی گردد، آن رقم به ستون بعدی سمت چپ اضافه مي&shy; گردد. نکته قابل
                            توجه اين است که ALU &nbsp;نمی &shy;داند که دو رشته بيت&shy; هايی که جمع مي&shy; کند چه
                            مقاديری را نشان مي&shy; دهند. ALU فقط اين دو عدد را&nbsp; بدون توجه به مقادير نمايش داده شده
                            توسط اين دو رشته بيت جمع مي&shy; کند. &nbsp;لذا بسيار مفيد خواهد بود اگر نمايش عدد
                            بگونه &shy;ای باشد که نتيجه جمع توسط ALU خود نمایش صحیح عدد باشد. مثلا در يک نمايش خوب، وقتی
                            يک عدد با منفی خود جمع گردد، نتيجه عمل صفر بشود. به بيان ديگر اگر ورودی به ALU &nbsp;اعداد
                            &nbsp;A- &nbsp;و A باشند، خروجی ALU باید 00000 باشد. بدين منظور روش نمايش مکمل 2 طراحی
                            گرديده بگونه&shy; ای که اگر يک عدد با منفی خود جمع گردد، عدد خروجی معادل صفر در نمايش مکمل
                            دو مي&shy; باشد.</p>

                        <p style="text-align: justify;">مثال: عدد &nbsp;00101 نمايش عدد 5+ است 11011 نمايش عدد 5- مي&shy;باشد
                            که جمع اين&shy; دو معادل صفر مي &shy;شود.</p>

                        <p style="text-align: justify;">نكته: توجه دقیق به نمایش 1- و 0، 11111 &nbsp;و00000 ، ضروريست.
                            هنگاميکه عدد &nbsp;1، با نمايش مکمل دو 00001 ، را &nbsp;با 1- با نمايش مکمل دو11111 ، جمع مي&shy;
                            کنيم، حاصل 00000 مي &shy;باشد. وليکن يک بيت انتقالی هم نتيجه اين عمل در انتها، سمت چپ، خواهد
                            بود. اين بيت انتقالی نتيجه &shy;ای در جمع ندارد، يعنی جمع 1 و &nbsp;1- بايد 00000 &nbsp;شود
                            نه 100000. لذا بيت انتقالی در نظر گرفته نمي&shy; شود. در واقع بيت انتقالی سمت چپ در مکمل دو
                            بی تاثير بوده و همواره دور ريخته مي &shy;شود.</p>

                        <p style="text-align: justify;">مثال: &nbsp;نمايش مکمل دو عدد 13- چيست؟</p>

                        <ul style="text-align: right;">
                            <li style="text-align: justify;">فرض کنید A مساوی 13+&nbsp; است. لذا نمايش باينری آن معادل
                                01101 ميباشد.
                            </li>
                            <li style="text-align: justify;">معکوس شده، يا مکمل، A مساوی 10010 می&shy; باشد.</li>
                            <li style="text-align: justify;">با اضافه کردن 1 مکمل دو آن بدست می &shy;آید یعنی 10011
                                &nbsp;</li>
                            <li style="text-align: justify;">برای اثبات صحت عمل، مي &shy;توان 13 را با &nbsp;13- جمع
                                نمود:
                            </li>
                        </ul>

                        <p style="text-align: justify;">01101</p>

                        <p style="text-align: justify;">10011</p>

                        <p style="text-align: justify;">---------</p>

                        <p style="text-align: justify;">00000</p>

                        <p style="text-align: justify;">ممکن است که متوجه شده باشيد که هنگام جمع 01101 و 10011 ، بعلاوه
                            توليد &nbsp;00000 ALU يک بيت انتقالی توليد مي&shy; کند که بيشتر از 5 بيت مي&shy; شود. به
                            بيان ديگر جمع 01101 و 10011 در واقع معادل 100000 مي &shy;باشد. و ليکن، همانطور که قبلا هم
                            بيان شد، در مکمل 2 اين بيت انتقالی اضافی در نظر گرفته نمي&shy; شود. تا اين مرحله، ما با 5
                            بيت 15 عدد مثبت و 15 عدد منفی را نمايش داده&shy; ايم. همچنين يک نمايش برای 0 داريم. از آنجا
                            که تعداد بیت&shy;ها 5 می &shy;باشد، یعنی K=5 ، باید بتوانیم 32 &nbsp;مقدار متفاوت را نمايش
                            دهيم در حاليکه تا اينجا ما فقط 31 (15+15+1) عدد را نمايش داده &shy;ايم. &nbsp;نمايش
                            باقيمانده 100000 است.</p>

                        <p style="text-align: justify;">سوال: بنظر شما چه عددی را به نمايش100000 &nbsp;اختصاص دهيم؟</p>

                        <p style="text-align: justify;">پاسخ: ما متوجه شده ایم که 1- معادل 11111 ، 2- معادل 11110 ، 3-
                            معادل 11101 ، ... و 15- معادل 10001 می &shy;باشد. توجه کنید، همانند نمايش اعداد مثبت، هنگامي
                            که از &nbsp;1- تا 15- مي &shy;رويم،انگار ALU &nbsp;عدد &nbsp;00001 را از نمایش عدد کم می&shy;
                            کند. لذا منطقی است که 100000 را معادل 1-15-(100000=00001-100001) یعنی 16- بگیریم.</p>

                        <p style="text-align: justify;">نکته: کامپيوتری به نام LC-3) &nbsp;Little Computer 3) وجود دارد
                            كه بر روی اعداد 16 بیتی کار می&shy; کند. لذا اعداد صحیح مکمل 2 در آن می&shy;توانند بین32768
                            - و 32767 را نمایش دهند</p>

                        <div class="box contents" id="yui_3_17_2_2_1442314691660_427">
                            <div class="no-overflow" id="yui_3_17_2_2_1442314691660_426">
                                <p style="text-align: justify;">عمليات رياضی بر روی اعداد باينری مکمل 2 خيلی شبيه به
                                    عمليات رياضی بر روی اعداد دسيمال است. جمع دو عدد از سمت راست به چپ انجام مي&shy;
                                    گيرد که هر بار دو رقم با هم جمع مي &shy;شوند. در هر مرحله يک نتيجه جمع و يک رقم
                                    انتقالی توليد مي&shy; گردد. در اعداد باينری، بجای ايجاد رقم انتقالی بعد از 9 (چرا که
                                    9 بزرگترين رقم دسيمال است)، رقم انتقالی بعد از 1 توليد مي گردد ( 1 بزرگترين رقم
                                    باينری مي باشد.)</p>

                                <p style="text-align: justify;">مثال<b>:</b> بر مبنای نمايش 5 بيتی، جمع اعداد 11 و 3
                                    چيست؟</p>

                                <p style="text-align: justify;">نمايش باينري عدد 11 :&nbsp;&nbsp;&nbsp; 01011</p>

                                <p style="text-align: justify;">نمايش باينري دو عدد 3 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    00011</p>

                                <p style="text-align: justify;">جمع دو عدد، که مساوی 14 است: 01110</p>

                                <p style="text-align: justify;">تفريق دو عدد همان جمع يکی با منفی عددی است که کم مي
                                    شود.</p>

                                <p style="text-align: justify;">به بيان ديگر A-B مساوي&nbsp;&nbsp;<span
                                        dir="LTR">A+(-B)</span> ميباشد.</p>

                                <p style="text-align: justify;">مثال<b>:</b> نتيجه 9-14 چيست؟</p>

                                <p style="text-align: justify;">نمايش باينري عدد 14:&nbsp; 01110</p>

                                <p style="text-align: justify;">نمايش باينري عدد9:&nbsp; 01001</p>

                                <p style="text-align: justify;">اول بايد مکمل دو 9- را بدست آورد: &nbsp;10111</p>

                                <p style="text-align: justify;">جمع 14 با 9- مي شود:</p>

                                <p style="text-align: justify;">01110</p>

                                <p style="text-align: justify;">10111</p>

                                <p style="text-align: justify;">--------</p>

                                <p style="text-align: justify;">00101</p>

                                <p style="text-align: justify;">که مساوی 5 مي باشد</p>

                                <p id="yui_3_17_2_2_1442314691660_425" style="text-align: justify;">توجه کنيد که رقم
                                    انتقالی انتهايی در نظر گرفته نمي شود.</p>

                                <p style="text-align: justify;">مثال:مقدار عبارت زير را محاسبه كنيد.</p>

                                <div class="box contents">
                                    <div class="no-overflow">
                                        <p style="text-align: justify;">X= 01110111</p>

                                        <p style="text-align: justify;">Y= 00111111</p>

                                        <p style="text-align: justify;">?= X-Y</p>

                                        <p style="text-align: justify;">?= X+Y</p>

                                        <p style="text-align: justify;">پاسخ:</p>

                                        <p style="text-align: justify;">X= 01110111</p>

                                        <p style="text-align: justify;">Y= 00111111</p>

                                        <p style="text-align: justify;">------------------</p>

                                        <p style="text-align: justify;">&nbsp;X+Y= 10110010</p>

                                        <p style="text-align: justify;">برای محاسبه x-y ابتدا باید مکمل 2 عدد y را
                                            بیابیم. در واقع x-y همان ( X+(-y است. مکمل 2 عدد Y هم از مکمل 1 کردن Y و جمع
                                            آن با یک حاصل می شود. مکمل 1 عدد Y هم از معکوس کردن بیت به بیت عدد Y بدست می
                                            آید. یعنی مکمل یک Y می شود 11000000 و اگر با یک جمع شود حاصل 11000001 می
                                            شود. پس حاصل x-y برابر با 11000001 است.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <a href="1-q1.php" class="btn btn-info" role="button"> سوال اول</a>
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
