<?php  
	include '../php/connect.php';
?>
<!--Carousel Wrapper-->
<div id="carousel-example-1z" class="carousel slide carousel-fade z-depth-3" data-ride="carousel">
    <!--Indicators-->
    <ol class="carousel-indicators">
        <?php  
        	$active = 1;
        	$x = 0;
        	$sql = mysql_query("SELECT * FROM carousel_settings");
        	while($fetch = mysql_fetch_assoc($sql)){
        		?>
        			<li data-target="#carousel-example-1z" data-slide-to="<?php echo $x; ?>" class="
        				<?php  
        					if($active == 1){
        						echo "active";
        					}
        				?>
        				"></li>
        		<?php
        		$active = 0;
        		$x++;
        	}
        ?>
    </ol>
    <!--/.Indicators-->
    <!--Slides-->
    <div class="carousel-inner" role="listbox">
        <?php  
        	$active = 1;
        	$sql = mysql_query("SELECT * FROM carousel_settings");
        	while($fetch = mysql_fetch_assoc($sql)){
        		$image = "data:image/jpeg;base64,".base64_encode($fetch['slide']);
        		?>
        		<div class="carousel-item <?php  
        			if($active == 1){
        				echo "active";
        			}
        		?>">
		            <img class="d-block w-100" src="<?php echo $image; ?>">
		        </div>
        		<?php
        		$active = 0;
        	}
        ?>
    </div>
    <!--/.Slides-->
    <!--Controls-->
    <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
    <!--/.Controls-->
</div>
<!--/.Carousel Wrapper-->
<br>
<div class="container">
	<div class="jumbotron wow fadeIn">
		<h1 class="display-3 pink-text text-center mc">Dolce Atelier</h1>
		<p class="lead text-center mc h3-responsive pink-text darken-3">"Sweeten your own style"</p>
		<!-- <hr class="my-4 bg-pink darker-2"> -->
		<?php  
			$sql = mysql_query("SELECT featuredprod FROM settings");
			$fetch = mysql_fetch_assoc($sql);
			$prodid = $fetch['featuredprod'];
			if($prodid != 0){
				$sql = mysql_query("SELECT title, image, description FROM product WHERE productID = '$prodid'");
				$fetch = mysql_fetch_assoc($sql);
				$title = $fetch['title'];
				$description = $fetch['description'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				?>
					<h3 class="display-5 pink-text p-4"><i class="fa fa-diamond" aria-hidden="true"></i> <strong>Featured Product</strong></h3>
					<div class="container">
						<div class="row">
							<div class="col-lg-6 view hm-zoom animated pulse infinite" align="center">
								<img src="<?php echo $image; ?>" style="height: 300px; width: 100%;" class="img-responsive wow fadeIn"><br>
							</div>
							<div class="col-lg-6">
								<p class="h1-responsive border border-pink p-4 pink-text rounded" style="height: 90px"><i class="fa fa-bookmark" aria-hidden="true"></i> Title: <?php echo $title; ?></p>
								<p class="h2-responsive border border-pink p-4 pink-text rounded" style="height: 160px"><i class="fa fa-info" aria-hidden="true"></i> Description: <?php echo $description; ?></p>
							</div>
						</div>
					</div>
				<?php
			}
		?>
	</div>
</div>
<br>
<div class="container-fluid wow fadeInUp">
	<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-5">
			<!--Panel-->
			<blockquote class="blockquote bq-warning">
			    <p class="bq-title">Announcement <i class="fa fa-rss" aria-hidden="true"></i></p>
			    <?php  
		    		$sql = mysql_query("SELECT announcement FROM settings");
					$fetch = mysql_fetch_assoc($sql);
					$txt = $fetch['announcement'];
		    	?>
			    <p style="white-space: pre-wrap;"><?php echo $txt; ?></p>
			</blockquote>
		</div>
		<div class="col-lg-5">
			<blockquote class="blockquote bq-primary">
			    <p class="bq-title">Work Hours <i class="fa fa-magic" aria-hidden="true"></i></p>
			    <?php  
		    		$sql = mysql_query("SELECT workhour FROM settings");
					$fetch = mysql_fetch_assoc($sql);
					$txt = $fetch['workhour'];
			    ?>
			    <p style="white-space: pre-wrap;"><?php echo $txt; ?></p>
			</blockquote>
		</div>
		<div class="col-lg-1"></div>
	</div>
</div>

<br>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4">
			<div class="view overlay hm-blue-slight z-depth-3">
			    <img class="img-thumbnail img-responsive wow bounceInUp" src="img/dolce/cupcake.jpg" style="max-height: 500px; width: 100%;" href="products.php">
			    <div class="mask flex-center waves-effect waves-light">
			        <p class="white-text"><img src="img/overlay/cupcake.jpg" class="thumbnailoverlay"></p>
			    </div>
			</div>
			
		</div>
		<div class="col-lg-4">
			<div class="view overlay hm-blue-slight z-depth-3">
			    <img class="img-thumbnail img-responsive wow tada" src="img/dolce/mug.jpg" style="max-height: 500px; width: 100%;">
			    <div class="mask flex-center waves-effect waves-light">
			        <p class="white-text"><img src="img/overlay/mug.jpg" class="thumbnailoverlay"></p>
			    </div>
			</div>
		</div>
		<div class="col-lg-4">
			<div class="view overlay hm-blue-slight z-depth-3">
			    <img class="img-thumbnail img-responsive wow fadeInUp" src="img/dolce/mugwithcake.jpg" style="max-height: 500px; width: 100%;">
			    <div class="mask flex-center waves-effect waves-light">
			        <p class="white-text"><img src="img/overlay/mugwithcake.jpg" class="thumbnailoverlay"></p>
			    </div>
			</div>
		</div>
	</div>
</div>

<br>

<div class="container-fluid">
	<div class="row"">
		<div class="col-lg-6">
			<div class="view hm-zoom z-depth-3 waves-effect waves-light">
				<img class="img-thumbnail img-responsive wow pulse" src="img/dolce/13.jpg" style="max-height: 500px; width: 100%">
			</div>
		</div>
		<div class="col-lg-6 wow fadeInLeft d-flex justify-content-around">
			<blockquote class="blockquote bq-primary">
			    <h2 class="display-5 indent blue-text text-center"><br><br>Every time you order from Dolce Atelier, you are making sure that you are getting the best Zamboangueños products that are so sweet and so delicious. Ordering from Dolce Atelier will definitely set the mood no matter what time of the day.</h1><br>
			    <div class="d-flex justify-content-center">
			    	<a href="products.php" class="btn btn-outline-primary waves-effect">Order Now</a>
			    </div>
			</blockquote>
		</div>
	</div>
</div>

<br><br>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-6 wow fadeInLeft d-flex justify-content-around">
			<blockquote class="blockquote bq-danger">
			    <h2 class="display-5 indent pink-text text-center"><br><br>Wherever you are, you can bring smiles to your family and friends by sending them these sweets and tasty cakes with design mugs.</h1><br>
			    <div class="d-flex justify-content-center">
			    	<a href="products.php" class="btn btn-outline-pink waves-effect">Order Now</a>
			    </div>
			</blockquote>
		</div>
		<div class="col-lg-6">
			<div class="view hm-zoom z-depth-3 waves-effect waves-light">
				<img class="img-thumbnail img-responsive wow pulse" src="img/dolce/12.jpg" style="max-height: 500px; width: 100%">
			</div>
		</div>
	</div>
	<br>
	<div class="row">
		<div class="col-lg-4"><img src="img/step1.png" class="stepbox img-responsive wow fadeInLeft"></div>
		<div class="col-lg-4"><img src="img/step2.png" class="stepbox img-responsive wow fadeInUp"></div>
		<div class="col-lg-4"><img src="img/step3.png" class="stepbox img-responsive wow fadeInRight"></div>
	</div>
</div>
<script>
	new WOW().init();
</script>