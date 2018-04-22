<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions
include('functions.php');

// Get the insect insectid from the url
$insectid = get('insectid');

// Get a list of insects from the database with the insectid passed in the URL
$sql = file_get_contents('sql/getInsect.sql');
$params = array(
	'insectid' => $insectid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$insects = $statement->fetchAll(PDO::FETCH_ASSOC);

// Set $insect equal to the first insect in $insects
$insect = $insects[0];

// Get categories of insect from the database
$sql = file_get_contents('sql/getInsectCategories.sql');
$params = array(
	'insectid' => $insectid
);
$statement = $database->prepare($sql);
$statement->execute($params);
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);

/* In the HTML:
	- Print the insect title, author, price
	- List the categories associated with this insect
*/
?>

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
            <h1>
                <?php echo $insect['name'] ?>
            </h1>
            <img src="img/<?php echo $insect['src'];?>" style="width: 300px;" />
            <p>
                <?php echo $insect['genus']; ?><br />
                <?php echo $insect['species']; ?><br />
                <?php echo $insect['price']; ?><br />
            </p>

            <ul>
                <?php foreach($categories as $category) : ?>
                <li>
                    <?php echo $category['name'] ?>
                </li>
                <?php endforeach; ?>
            </ul>

            <br>
            <a href="index.php">Go Back</a>

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
