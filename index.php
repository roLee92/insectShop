<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get search term from URL using the get function
$term = get('search-term');

// Get a list of insects using the searchinsects function
// Print the results of search results
// Add a link printed for each insect to insect.php with an passing the isbn
// Add a link printed for each insect to form.php with an action of edit and passing the isbn
$insects = searchInsects($term, $database);
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
            <h1>Mantids and more!</h1>
            <form method="GET" class="search">
                <input type="text" name="search-term" placeholder="Search..." class="searchinput"/>
                <input type="submit" class="btnsearch" />
            </form>
            <br>
            <hr>
            <br>
            <br>
            <p>
                Hey there <strong><?php echo $customer01->customerName; ?>!</strong>
            </p>
            <br>
            <?php foreach($insects as $insect) : ?>
            <img src="img/<?php echo $insect['src'];?>" style="width: 300px;" />
            <p>
                <?php echo $insect['name']; ?><br />
                <strong>$<?php echo $insect['price']; ?></strong> <br />
                <a href="form.php?action=edit&insectid=<?php echo $insect['insectid'] ?>">Edit Insect</a><br />
                <a href="insect.php?insectid=<?php echo $insect['insectid'] ?>">View Insect</a>
            </p>
            <?php endforeach; ?> 
            <br>
            <hr>
            <br>
            <strong><p><a href="form.php?action=add"><i class="fa fa-plus" aria-hidden="false"></i> Add an Insect</a></p></strong>
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
