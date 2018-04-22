<!DOCTYPE html>

    <html>

    <head>
        <title>Inverts</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="layout/styles/framework.css" rel="stylesheet" type="text/css" media="all">
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    </head>

    <body id="top">






        <!-- Top Background Image Wrapper -->
        <div class="bgded overlay" style="background-image:url('images/demo/backgrounds/01.png');">

            <div class="wrapper row1">
                <?php include('header.php'); ?>
            </div>

            <div id="pageintro" class="hoc clear">

                <div class="flexslider basicslider">
                    <ul class="slides">
                        <li>
                            <article>
                                <p class="heading">Welcome to Inverts Mantids and More!</p>
                                <h2 class="heading">An Online Insect/Mantis Catalog!</h2>
                            </article>
                        </li>
                    </ul>
                </div>

            </div>

        </div>






        <div class="page">
            
            <?php include('about.php'); ?>

        </div>






        <?php include('footer.php'); ?>







        <a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
        <!-- JAVASCRIPTS -->
        <script src="layout/scripts/jquery.min.js"></script>
        <script src="layout/scripts/jquery.backtotop.js"></script>
        <script src="layout/scripts/jquery.mobilemenu.js"></script>
        <script src="layout/scripts/jquery.flexslider-min.js"></script>
    </body>

    </html>
