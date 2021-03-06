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
//        header("location: next.php");
    }

    $_SESSION['see_next'] = FALSE;
    $_SESSION['previous'] = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; // current page
}
?>
<!-- test! -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="font/Sample.css">
    <script type="text/javascript" src="jquery.js"></script>

    <script type="text/javascript" src="unslider-min.js"></script>
    <link rel="stylesheet" href="unslider.css">

</head>
<body>
<div class="topBar">
    <div class="box">
        <!-- <a href="logout_page.php">‌<p>خروج</p></a> -->
        ‌<p><?php print($_SESSION['username']) ?></p>
    </div>
</div>

<div class="main">
    <div class="tree">
        ‌
        <ul>

            <li>
                اشاره‌گر
                <ul>
                    <li id="poDef" class="c0 active">تعریف</li>
                    <li id="poOp" class="c1">عملگر اشاره‌گر و رفرنس</li>
                    <li id="poNul" class="c2">اشاره‌گر به Null</li>
                </ul>
            </li>

            <li>
                آرایه‌ها
                <ul>
                    <li id="ArDef" class="c3">تعریف</li>
                    <li id="Macro" class="c4">ماکرو‌ها و پارامتر‌ها</li>
                </ul>
            </li>

            <li id="Ans" class="c5">
                آزمون و تحلیل سوالات
            </li>


        </ul>

    </div>
    <div class="text">

        <div class="my-slider">
            <ul>

                <li>
                    <div class="progress p0"></div>
                    <p>
                    <p style="font-weight: bold;">پوینتر (یا اشاره‌گر) ‪چیست؟‬</p>

                    پوینر آدرسی از مموری است که در آن object (مانند متغیرها و ...) قرار دارد‪.‬ با استفاده از پوینترها
                    می‌توان به طور غیرمستقیم به این objectها دسترسی پیدا کرد.
                    در زبان C آرگومان‌های توابع ‪"‬passed by value‪"‬ هستند یعنی کپی از مقدار هر یک از آرگومان ها با
                    فراخوانی شدن تابع در push ،run‪-‬time stack می‌شود. بنابراین هر تغییری که در حین اجرای تابع روی
                    متغیرهای ورودی رخ دهد با بازگشت از تابع و پاک شدن بخش‌هایی از run‪-‬time stack که مربوط به تابع
                    فراخوانده شده است از بین خواهد رفت.
                    مثال از نحوه‌ی استفاده از پوینتر در زبان C:
                    </p>
                    <pre style="direction: ltr;text-align: left;"> int  *ptr;</pre>
                    <p>
                        علامت ‪"*"‬ نشانه‌ی پوینتر است. در اینجا پوینتری به نام ptr از جنس int تعریف شده‌است.
                        نحوه‌ی مقداردهی پوینترها:
                    </p>
                    <pre style="direction: ltr;text-align: left;">
int *ptr;
int object;
ptr = &object;
                    </pre>
                    <p>
                        قطعه کد زیر را در نظر میگیریم:
                        هدف این کد جابه جایی محتوای دو متغیر valueA و valueB است. اما چون در زبان c آرگومان های توابع by
                        value به تابع پاس داده میشوند, پس از بازگشت از تابع مقادیر متغیر ها تغییر نیافته باقی میمانند.
                    </p>
                    <pre style="direction: ltr;text-align: left;float: left ">
void Swap (int firstVal, int secondVal);
int main()
{
                int valueA = 3;
                int valueB = 4;
                printf("Before Swap");
                printf("valueA = %d and valueB = %d \n", valueA, valueB);

                Swap(valueA, valueB);
                printf("After Swap");
                printf("valueA = %d and valueB = %d\n", valueA, valueB);
}
void Swap (int firstVal, int secondVal)
{
                int tempVal;
                tempVal = firstVal;
                firstVal = secondVal;
                secondVal = tempVal;
}
                    </pre>
                    <img src="img/Screen Shot 2016-12-14 at 7.15.57 PM.png" style="float: right; padding-top: 50px;"
                         alt="">

                    <div class="nextPage" id="p1">مبحث بعدی</div>
                </li>
                <li>
                    <div class="progress p25"></div>


                    <p>
                    <p style="font-weight: bold;">اپراتور پوینترها :</p>
                    ۱‫.‬ address operator‪ یا "&"‬ :
                    که آدرس حافظه‌ی عملوند خود را مشخص می‌کند
                    ۲‫.‬indirection operator یا deference operator یا ‪"‬*‪"‬ :
                    که می‌توان با آن به طور غیرمستقیم به مقدار object) memory object ای که پوینتر حاوی آدرس آن در حافظه
                    است) دست یافت.
                    یعنی در قطعه کد بالا ‪*‬ptr و object معادل هستند. به طور مثال داریم :
                    *ptr = *ptr +1 معادل است با object = object + 1
                    </p>

                    <br>
                    <img src="img/pp.jpg" alt="">

                    <br>
                    <p>
                    <p style="font-weight: bold;">pass by refrence</p>
                    حال که در مورد پوینتر ها اطلاعات لازم را به دست آوردید سعی کنید که مفهوم را استنتاج کنید

                    وقتی آرگومان‌های توابع پوینتر باشند مقداری که به run‪-‬time stack افزوده می‌شود برابر با آدرس
                    خانه‌ای از حافظه است که مقدار متغیر در آن قرار دارد پس با جابه‌جا کردن مقادیری که پوینترها به آن
                    اشاره می‌کنند مقدار متغیرها در حافظه تغییر می‌یابند.
                    شرط لازم برای اینکه ‪"‬pass by refrence‪"‬ برای آرگومان‌های یک تابع مفهوم داشته باشد این است که
                    آرگومان‌ها یا باید متغیر باشند و یا memory object باشند (یعنی باید آدرس داشته باشند)
                    </p>
                    <div>
                        <div style="float: left">
                    <pre style="text-align: left; direction: ltr">
#include <stdio.h>
void NewSwap (int *firstVal, int *secondVal);

int main()
{
            int valueA = 3;
            int valueB = 4;

            printf("Before Swap ");

            printf("valueA = %d and valueB = %d\n", valueA, valueB);

            NewSwap(&valueA, &valueB);
            printf("After Swap ");
            printf("valueA = %d and valueB = %d\n" , valueA, valueB);
}
void NewSwap (int *firstVal, int *secondVal)
{
            int tempVal;
            tempVal = *firstVal;
            *secondVal = tempVal;
}
                    </pre>
                        </div>
                        <div style="float: right; padding-top: 50px;">
                            <img src="img/Screen Shot 2016-12-14 at 7.16.25 PM.png" alt="">
                        </div>
                    </div>
                    <div class="nextPage" id="p2">مبحث بعدی</div>
                </li>
                <li>
                    <div class="progress p50"></div>

                    <p>
                    <h4>null pointer :</h4>
                    پاره‌ای از موارد لازم است پوینتر ما به هیچی یا همان null‪ ‬ اشاره کند که در ساختمان داده‌های dynamic
                    کاربرد‌ دارد.(linked list ها که در آینده با آن‌ها بیشتر آشنا خواهید از جمله‌ کاربرد آن‌ می‌باشد)
                    نکته : هیچ memory object ای نمی‌تواند در خانه ی 0 قرار بگیرد
                    سوال اشکال کد زیر چیست و چه اتفاقی در حال رخ دادن است؟
                    <pre style="direction: ltr;text-align: left;"> scanf("%d",input);</pre>
                    با استفاده از دستور scanf از کاربر مقدار ورودی گرفته می‌شود ولی به جای اینکه این مقدار را در متغیر
                    input قرار دهد آن را در خانه ای که آدرس آن محتوای متغیر input است ورودی را قرار می دهد که این مقدار
                    توسط کامپایلر به طور رندوم هنگام allocate کردن متغیر به آن مقداردهی شده است. این مقدار ممکن است خارج
                    از دسترس برنامه، غیرقابل نوشتن باشد و یا ...
                    بنابراین تا زمان اجرا نمی تونیم پیشبینی کنیم چه اتفاقی دقیقا می‌افتد و ممکن است برنامه crash کند.


                    <img src="./img/null.jpg" class="nullImg">

                    <br><br>
                    <h4>پاره‌ای از توضیحات درمورد pointer‪'‬s syntax</h4>
                    <p>
                    <pre style="direction: ltr;text-align: left;">type *ptr;</pre>
                    <p>
                        در دستور بالا type می تواند از جنس نوع‌های پیش فرض باشد و یا از نوع‌هایی باشد که در برنامه تعریف
                        شده اند‫ (predefined).‬
                        قوانین مربوط به نام‌گذاری پوینترها همانند قوانین نام‌گذاری متغیرهاست.
                        اگر اسم پوینتر به دنبال ‪"*"‬ بیاید دیگر متغیر حاصل از جنس type است و دیگر با آن تفاوتی ندارد.

                        چگونه می‌توان از پوینترها در برگرداندن مقادیر متغیرها بهره برد؟
                        از return value برای ارزیابی عملکرد تابع خود استفاده کنید
                    </p>
                    <div class="nextPage" id="p3">مبحث بعدی</div>
                </li>
                <li>
                    <div class="progress p75"></div>

                    <p>
                    <p style="font-weight: bold;">تعریف</p>
                    آرایه لیستی از داده‌هاست که پشت سر هم در مموری قرار دارند. برای دسترسی به داده‌ی خاصی از آرایه باید
                    به اولین خانه ایندکس ۰ بدهیم و به ازای هر عضو یک واحد به آن اضافه کنیم.
                    جنس تمامی اعضای آرایه‌ها یکسان می‌باشد که در هنگام تعریف کردن مشخص می‌شود.
                    نحوه ‌ی تعریف آرایه‌ها :
                    <img src="img/aa.png" alt="">
                    <pre style="direction: ltr;text-align: left;">type array_name [size];</pre>
                    <br>
                    ابتدا type آرایه را باید مشخص کنیم سپس نام آن آورده می‌شود و size آن که طول آرایه را مشخص می‌کند که
                    جنس آن باید constant باشد.
                    ایندکس‌های یک آرایه‌ی n تایی از 0 تا n‪-‬1 می‌باشد، یعنی برای دسترسی به خانه‌ی k ام آرایه‌ی a داریم
                    : a‪[‬k‪-‬1‪]‬.
                    اگر متغیر arr متغیری local باشد حافظه از allocate، run‪-‬time stack می‌شود.<br><br>
                    <pre style="direction: ltr;text-align: left;">base pointer of an array is array_name[0]</pre>

                    </p>

                    <div class="nextPage" id="p4">محبث بعد</div>
                </li>
                <li>
                    <div class="progress p100"></div>

                    <p>

                    <p style="font-weight: bold">ماکروها چیستند و فایده‌ی آن‌ها چیست؟</p>

                    ماکروها همان مقادیر ثابتی هستند که معمولا در ابتدای فایل برنامه (قبل از main) وجود دارند و به طور
                    معمول با حروف بزرگ نمایش داده می‌شوند syntax آن به صورت زیر است:
                    <pre style="direction: ltr;text-align: left;"><span
                                style="font-size: 23px">#</span>define MACRO 5</pre>
                    با کامپایل شدن کد، کامپایلر به جای تمامی MACRO های موجود در کد مقدار آن را قرار می‌دهد.
                    اگر از ماکروها در کد استفاده نکنیم و مقدار آن‌ها را مستقیما استفاده کنیم با تغییر مقدار تعیین شده
                    باید در تمامی موارد استفاده شده مقدار عوض شود اما با استفاده از ماکرو کافی است مقدار در تعریف ماکرو
                    آپدیت شود و کد را دوباره کامپایل کنیم.
                    </p>

                    <p>
                        <br>
                    <p style="font-weight: bold">آرایه‌ها و پارامترها</p>
                    همان طور که متغیرها می‌توانستند آرگومان ورودی توابع باشند آرایه‌ها نیز این قابلیت را دارند، اگر طول
                    آرایه ای که آرگومان ورودی تابع است زیاد باشد کپی کردن آن در استک ممکن است زمان زیادی در execution
                    time را به خود اختصاص دهد بنابراین بهتر است که با refrence این کار صورت بگیرد. در برنامه‌های C
                    آرایه‌ها به طور دیفالت by refrence به توابع پاس داده می‌شوند همان‌طور که در مثال مشاهده می‌کنید
                    syntax فرستادن آرایه‌ ای که آرگومان یک تابع است به طور معمول خود با ‪[‬ ‪]‬ نمی باشد. در زبان C اسم
                    آرایه معادل با رفرنس (آدرس خانه‌ی حافظه‌ای که در آن قرار دارد) به عنصر base آن می‌باشد یعنی داریم:
                    <pre style="direction: ltr;text-align: left;">
type array_name[SIZE];
array_name = &array_name[0];
                        </pre>
                    و همچنین جنس اسم آرایه ‪*‬type است.
                    پس با فراخوانی تابعarray‪_name ‬ در run‪-‬time stack کپی می‌شود و ما reference به سر آرایه را در
                    استک خود خواهیم داشت. (یعنی دسترسی by refrence).
                    حال چگونه تنها یک عنصر آرایه را با value و یا با refrence به تابع پاس دهیم؟

                    </p>

                    <br>
                    <p style="font-weight: bold">رشته ها</p>
                    <p style="clear: right; white-space: nowrap !important">
                        در زبان string ،C مجموعه‌ای از کاراکترهاست که بین ‪"‬ ‪"‬ قرار می‌گیرد کامپایلر به انتهای آن
                        کاراکتر ‪'\0' ‬ را اضافه می‌کند و در آرایه‌ای از جنس char آن را ذخیره می‌کند، پس در آرایه‌ای به
                        سایز n حداکثر طول string که می‌تواند در آن ذخیره شود برابر است با n‪-‬1 .
                        <br>
                    </p>

                    <div class="nextPage" id="p5">تحلیل سوالات</div>
                </li>
                <li>
                    <p>قطعه کد زیر بین پرسش‌های اول تا چهارم مشترک است بنابراین ابتدا به بررسی آن‌ها می‌پردازیم.
                        پس از اجرای مقادیر هر یک از متغیرها به صورت زیر خواهد بود.
                    </p>
                    <p>
                    <pre style="direction: ltr;text-align: left;float: left;">
                            char** ptr= NULL;
                            char* ptr1[4];
                            char listOfChars[4] = {'a','b','c','d'};
                            int i;
                            char* list[5]=
                    {"An", "exam", "on", "Halloween", "night!!!!"};
                            char** p;
                            p = list;
                        </pre>
                    <img src="img/1.png" alt="" style="float: right;">
                    </p>
                    <p style="clear: left">

                        پرسش اول :
                        با توجه به اینکه ‪*(‬p‪+‬1‪)‬ پوینتر است و listOfChar ‪[‬1‪] ‬ از جنس کاراکتر می‌باشد در واقع آدرس خود اشاره‌گر را تغییر داده‌ایم و به قسمتی از حافظه که در دسترس ما نیست اشاره می‌کند.
                        پرسش دوم:
                        به درستی کامپایل خواهد شد اما در زمان اجرا با پیغام bus error‪:‬ 10 برنامه کراش خواهد کرد علت این امر آن است که list به صورت آرایه‌ای ۵ تایی از جنس char‪*‬ تعریف شده است پس از مقداردهی اولیه‌ی آن نمی‌توانیم اعضای آن را تغییر بدهیم
                        قسمت سوم:
                        نیز به درستی کامپایل خواهد شد اما در هنگام اجرا چون listOfChar دارای ۴ عضو است حداکثر اندیس قابل دسترسی آن برابر با ۳ خواهد بود (مقادیر ۰ تا ۳) بنابراین هنگامی که می‌خواهیم به listOfChar‪+‬4 دسترسی بیابیم در واقع از محدوده‌ی حافظه‌ی اختصاص داده شده به برنامه خارج گشتیم.

                        اگر بخواهیم قطعه کد c در سوال سه را به گونه‌ای تغییر دهیم که امکان تعویض کاراکتر i ام یک string از مجموعه‌ای از آنها داشته باشیم. باید به صورت زیر عمل کنیم.</p>
                    <pre style="direction: ltr;text-align: left;">char list[5][]={"An", "exam", "on", "Halloween", "night!!!!"};
char **list = (char**) malloc(5 * sizeof (char*));
char ** list = {"An", "exam", "on", "Halloween", "night!!!!"};
                    </pre>
                    <p>
                        و در آخر نیز باید حافظه‌ای را که توسط malloc کردن تخصیص داده‌ایم را آزاد کنیم یعنی:
                    </p>
                    <pre style="direction: ltr;text-align: left;float: left;">
    free(list);
</pre>
                    <p>پرسش چهارم:
                        مشکل، برابر نبودن جنس طرفین تساوی است. در سمت راست char*‪*‬ داریم و در سمت دیگر آن را با char ‪[const]‬ می‌خواهیم مقداردهی کنیم که امکان پذیر نیست.

                        پرسش پنجم:
                        فایل استاندارد شامل تمام هدرفایل های (کتابخانه‌های) استاندارد می‌باشد.
                        مانند stdio، stdlib و ...
                    </p>
                    <a href="2-q1.php">
                        <div class="nextPage btnGreen" id="p6">آزمون</div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- slider -->
        <script>
            jQuery(document).ready(function ($) {
                var slider = $('.my-slider').unslider({
                    animation: 'fade',
                    nav: false,
                    arrows: false,
                    animateHeight: true,
                });

                var activeIndex = 0;
                slider.on('unslider.change', function(event, index, slide) {
                    $('.c' + activeIndex).removeClass('active');
                    activeIndex = (index!=-1)?index:5;
                    // alert(index + " " + activeIndex);
                    $('.c' + activeIndex).addClass('active');
                });



                $('.nextPage').click(function () {
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                })

                $('#poDef').click(function () {
                    slider.data('unslider').animate(0)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });

                $('#poOp').click(function () {
                    slider.data('unslider').animate(1)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $('#p1').click(function () {
                    slider.data('unslider').animate(1)
                });

                $('#poNul').click(function () {
                    slider.data('unslider').animate(2)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $('#p2').click(function () {
                    slider.data('unslider').animate(2)
                });

                $('#ArDef').click(function () {
                    slider.data('unslider').animate(3)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $('#p3').click(function () {
                    slider.data('unslider').animate(3)
                });

                $('#Macro').click(function () {
                    slider.data('unslider').animate(4)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $('#p4').click(function () {
                    slider.data('unslider').animate(4)
                });

                $('#Ans').click(function () {
                    slider.data('unslider').animate(5)
                    $('html, body').animate({
                        scrollTop: 0
                    }, 1000);
                });
                $('#p5').click(function () {
                    slider.data('unslider').animate(5)
                });


            });
        </script>

    </div>
</div>
</div>
</body>
</html>
