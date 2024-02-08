<!doctype html>
<html lang="ru">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Игра города</title>
        <meta name="description" content="Responsive HTML5 Template" />
        <meta name="keywords" content="Onepage, creative, modern, bootstrap 5, multipurpose, clean" />
        <meta name="author" content="Shreethemes" />
        <meta name="website" content="https://shreethemes.in" />
        <meta name="email" content="support@shreethemes.in" />
        <meta name="version" content="1.0.0" />
        <!-- favicon -->
        <link href="images/favicon.ico" rel="shortcut icon">
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
        <link href="assets/css/tobii.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
        <link href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" rel="stylesheet">
        <!-- Custom  Css -->
        <link href="assets/css/style.min.css" rel="stylesheet" type="text/css" id="theme-opt" />
    </head>
    <body>        
        <!-- Start -->
        <section class="position-relative">
            <div class="bg-overlay"></div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 p-0">
                        <div class="d-flex flex-column min-vh-100 justify-content-center px-md-5 py-5 px-4">
                            <div class="text-center">
                                <a href=""><img src="images/logo-icon-64.png" alt=""></a>
                                <?php if(isset($_SESSION['points'])){
                                    ?> <p class="text-white para-desc mx-auto mt-2 mb-0">Ваши очки: <?php echo $_SESSION['points']; ?></p> <?php
                                }else{
                                    ?> <p class="text-white para-desc mx-auto mt-2 mb-0">Ваши очки: 0</p> <?php
                                } ?>
                            </div>
                            <div class="title-heading text-center my-auto">
                                <div class="wave-effect coming-soon fw-bold display-3 text-white">
                                    <?php if(!empty($_SESSION['named'])){
                                        for ($a = 0; $a < mb_strlen($_SESSION['city'], 'utf-8'); $a++){
                                            ?>
                                            <span style="--a:<?php $a ?>"><?php echo mb_substr($_SESSION['city'],$a,1,'UTF-8');  ?></span>
                                            <?php
                                        }
                                    }else{ ?>
                                        <span style="--a:1">Г</span>
                                        <span style="--a:2">О</span>
                                        <span style="--a:3">Р</span>
                                        <span style="--a:4">О</span>
                                        <span style="--a:5">Д</span>
                                    <?php } ?>
                                </div>
                                
                                <?php if(isset($_SESSION['text'])){ ?>
                                    <p class="text-white para-desc mx-auto mt-2 mb-0"><?php echo $_SESSION['text']; ?></p>
                                <?php }else{ ?>
                                    <p class="text-white para-desc mx-auto mt-2 mb-0">Введите название города и нажмите «Старт»</br>После чего, система продолжит игру</p>
                                <?php } ?>
            
                                <div class="subcribe-form mt-4 pt-2">
                                    <form id="start" method="post">
                                        <input type="text" name="city" class="bg-white opacity-6 rounded shadow" required placeholder="Название города">
                                        <button type="button" id="btn" class="btn btn-primary">Старт</button>
                                    </form>
                                </div>
            
                                <p class="text-white-50 mt-3"><span class="text-danger fw-bold">*</span>Если название города заканчивается на буквы “й”, “ъ”, “ы”, “ь”, то для продолжения игры нужно использовать предпоследнюю букву.</p>
                                <p class="text-white-50 mt-3"><span class="text-danger fw-bold">*</span>Внизу отображается список городов, которые уже назывались</p>
                                <?php if(!empty($_SESSION['named'])){
                                    for ($a = 1; $a <= count($_SESSION['named']); $a++){
                                        ?> <a style="color:hsla(200,100%,40%,0.9); font-size:18px;"><?php echo $_SESSION['named'][$a]; ?></a> <?php                                                                                                                                      
                                    }
                                } ?>
                            </div>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </section><!--end section-->
        <!-- End -->   

        <!-- JAVASCRIPTS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>
        <script src="assets/js/tobii.min.js"></script>
        <script src="assets/js/contact.js"></script>
        <script src="assets/js/feather.min.js"></script>
        <!-- Custom -->
        <script src="assets/js/app.js"></script>
    </body>
</html>
