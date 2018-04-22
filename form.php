<?php

// Create and include a configuration file with the database connection
include('config.php');

// Include functions for application
include('functions.php');

// Get type of form either add or edit from the URL (ex. form.php?action=add) using the newly written get function
$action = $_GET['action'];

// Get the insect isbn from the URL if it exists using the newly written get function
$insectid = get('insectid');

// Initially set $insect to null;
$insect = null;

// Initially set $insect_categories to an empty array;
$insect_categories = array();

// If insect isbn is not empty, get insect record into $insect variable from the database
//     Set $insect equal to the first insect in $insects
// 	   Set $insect_categories equal to a list of categories associated to a insect from the database
if(!empty($insectid)) {
	$sql = file_get_contents('sql/getInsect.sql');
	$params = array(
		'insectid' => $insectid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$insects = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	$insect = $insects[0];
	
	// Get insect categories
	$sql = file_get_contents('sql/getInsectCategories.sql');
	$params = array(
		'insectid' => $insectid
	);
	$statement = $database->prepare($sql);
	$statement->execute($params);
	$insect_categories_associative = $statement->fetchAll(PDO::FETCH_ASSOC);
	
	foreach($insect_categories_associative as $category) {
		$insect_categories[] = $category['categoryid'];
	}
}

// Get an associative array of categories
$sql = file_get_contents('sql/getCategories.sql');
$statement = $database->prepare($sql);
$statement->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC); 

// If form submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$insectid = $_POST['insectid'];
	$name = $_POST['name'];
	$insect_categories = $_POST['insect-category'];
	$genus = $_POST['genus'];
    $species = $_POST['species'];
	$price = $_POST['insect-price'];
    $src = $_POST['image-source'];
	
	if($action == 'add') {
		// Insert insect
		$sql = file_get_contents('sql/insertInsect.sql');
		$params = array(
			'insectid' => $insectid,
			'name' => $name,
			'genus' => $genus,
            'species' => $species,
			'price' => $price,
            'src' => $src
		);
	
		$statement = $database->prepare($sql);
		$statement->execute($params);
		
		// Set categories for insect
		$sql = file_get_contents('sql/insertInsectCategory.sql');
		$statement = $database->prepare($sql);
		
		foreach($insect_categories as $category) {
			$params = array(
				'insectid' => $insectid,
				'categoryid' => $category
			);
			$statement->execute($params);
		}
	}
	
	elseif ($action == 'edit') {
		$sql = file_get_contents('sql/updateInsect.sql');
        $params = array( 
            'insectid' => $insectid,
			'name' => $name,
			'genus' => $genus,
            'species' => $species,
			'price' => $price,
            'src' => $src
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
        //remove current category info 
        $sql = file_get_contents('sql/removeCategories.sql');
        $params = array(
            'insectid' => $insectid
        );
        
        $statement = $database->prepare($sql);
        $statement->execute($params);
        
        //set categories for insect
        $sql = file_get_contents('sql/insertInsectCategory.sql');
        $statement = $database->prepare($sql);
        
        foreach($insect_categories as $category) {
            $params = array(
                'insectid' => $insectid,
                'categoryid' => $category
            );
            $statement->execute($params);
        };	
	}
	
	// Redirect to insect listing page
	header('location: index.php');
}

// In the HTML, if an edit form:
	// Populate textboxes with current data of insect selected 
	// Print the checkbox with the insect's current categories already checked (selected)
?>

    <!doctype html>
    <html lang="en">

    <head>
        <title>Inverts</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <link href="layout/styles/framework.css" rel="stylesheet" type="text/css" media="all">
        <link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
    </head>

    <body>

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
            <h1>Manage Insect</h1>
            <form action="" method="POST">
                <div class="form-element">
                    <label>Insect ID:</label>
                    <?php if($action == 'add') : ?>
                    <input type="text" name="insectid" class="textbox" value="<?php echo $insect['insectid'] ?>" />
                    <?php else : ?>
                    <input readonly type="text" name="insectid" class="textbox" value="<?php echo $insect['insectid'] ?>" />
                    <?php endif; ?>
                </div>
                <div class="form-element">
                    <label>Name:</label>
                    <input type="text" name="name" class="textbox" value="<?php echo $insect['name'] ?>" />
                </div>
                <div class="form-element">
                    <label>Genus:</label>
                    <input type="text" name="genus" class="textbox" value="<?php echo $insect['genus'] ?>" />
                </div>
                <div class="form-element">
                    <label>Species:</label>
                    <input type="text" name="species" class="textbox" value="<?php echo $insect['species'] ?>" />
                </div>
                <div class="form-element">
                    <label>Category:</label>
                    <?php foreach($categories as $category) : ?>
                    <?php if(in_array($category['categoryid'], $insect_categories)) : ?>
                    <input checked class="radio" type="checkbox" name="insect-category[]" value="<?php echo $category['categoryid'] ?>" /><span class="radio-label"><?php echo $category['name'] ?></span><br />
                    <?php else : ?>
                    <input class="radio" type="checkbox" name="insect-category[]" value="<?php echo $category['categoryid'] ?>" /><span class="radio-label"><?php echo $category['name'] ?></span><br />
                    <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <div class="form-element">
                    <label>Price:</label>
                    <input type="number" step="any" name="insect-price" class="textbox" value="<?php echo $insect['price'] ?>" />
                </div>
                <div class="form-element">
                    <label>Image:</label>
                    <input type="file" step="any" name="image-source" value="browse" accept="img/*" />
                </div>
                <div class="form-element">
                    <input type="submit" class="button" />&nbsp;
                    <input type="reset" class="button" />
                </div>
                <br>
                <hr>
                <br>
                <strong><p><a href="index.php"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a></p></strong>
            </form>
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
