<?php 
	session_start();
	include 'connect.php';
	$action = $_POST['action'];
	function fetchdata($category){
		$output = '';
		if($category == "cupcake"){
			$sql = mysql_query("SELECT * FROM product WHERE category = 'Cupcake'");
            if(mysql_num_rows($sql) == 0){
            	$output .= 
                "<tr>
                    <td colspan='4'><h1><center>No Products found</center></h1></td>
                </tr>";
            }
            else{
            	while($fetch = mysql_fetch_assoc($sql)) {
	                $prodid = $fetch['productID'];
	                $title = $fetch['title'];
	                $description = $fetch['description'];
	                $price = $fetch['price'];
	                $image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
	                $category = $fetch['category'];
	                $output .=
	                    "<tr id='prodtable' data-id='".$prodid."'>
	                        <td hidden class='productID'>".$prodid."</td>
	                        <td hidden class='image'>".$image."</td>
	                        <td class='title'>".$title."</td>
	                        <td hidden class='category'>".$category."</td>
	                        <td class='description'>".$description."</td>
	                        <td class='price'>".$price."</td>
	                        <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-info showproduct waves-effect' data-toggle='modal' data-target='#viewproductmodal'><i class='fa fa-sticky-note-o' aria-hidden='true'></i> View</button><button type='button' class='btn btn-sm btn-warning editproduct waves-effect' data-toggle='modal' data-target='#editprodmodal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button><button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deleteprodmodal'><i class='fa fa-trash' aria-hidden='true'></i>Delete</button></td>
	                    </tr>";
	            }
            }           
		}
		else if($category == "mug"){
			$sql = mysql_query("SELECT * FROM product WHERE category = 'Mug'");
            if(mysql_num_rows($sql) == 0){
            	$output .= 
                "<tr>
                    <td colspan='4'><h1><center>No Products found</center></h1></td>
                </tr>";
            }
            else{
            	while($fetch = mysql_fetch_assoc($sql)) {
	                $prodid = $fetch['productID'];
	                $title = $fetch['title'];
	                $description = $fetch['description'];
	                $price = $fetch['price'];
	                $image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
	                $category = $fetch['category'];
	                $output .=
	                    "<tr id='prodtable' data-id='".$prodid."'>
	                        <td hidden class='productID'>".$prodid."</td>
	                        <td hidden class='image'>".$image."</td>
	                        <td class='title'>".$title."</td>
	                        <td hidden class='category'>".$category."</td>
	                        <td class='description'>".$description."</td>
	                        <td class='price'>".$price."</td>
	                        <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-info showproduct waves-effect' data-toggle='modal' data-target='#viewproductmodal'><i class='fa fa-sticky-note-o' aria-hidden='true'></i> View</button><button type='button' class='btn btn-sm btn-warning editproduct waves-effect' data-toggle='modal' data-target='#editprodmodal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button><button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deleteprodmodal'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></td>
	                    </tr>";
	            }
            } 
		}
		else if($category == "mugwithcake"){
			$sql = mysql_query("SELECT * FROM product WHERE category = 'Mug with Cake'");
            if(mysql_num_rows($sql) == 0){
            	$output .= 
                "<tr>
                    <td colspan='4'><h1><center>No Products found</center></h1></td>
                </tr>";
            }
            else{
            	while($fetch = mysql_fetch_assoc($sql)) {
	                $prodid = $fetch['productID'];
	                $title = $fetch['title'];
	                $description = $fetch['description'];
	                $price = $fetch['price'];
	                $image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
	                $category = $fetch['category'];
	                $output .=
	                    "<tr id='prodtable' data-id='".$prodid."'>
	                        <td hidden class='productID'>".$prodid."</td>
	                        <td hidden class='image'>".$image."</td>
	                        <td class='title'>".$title."</td>
	                        <td hidden class='category'>".$category."</td>
	                        <td class='description'>".$description."</td>
	                        <td class='price'>".$price."</td>
	                        <td class='d-flex justify-content-center'><button type='button' class='btn btn-sm btn-info showproduct waves-effect' data-toggle='modal' data-target='#viewproductmodal'><i class='fa fa-sticky-note-o' aria-hidden='true'></i> View</button><button type='button' class='btn btn-sm btn-warning editproduct waves-effect' data-toggle='modal' data-target='#editprodmodal'><i class='fa fa-pencil-square-o' aria-hidden='true'></i> Edit</button><button type='button' class='btn btn-sm btn-danger waves-effect' data-toggle='modal' data-target='#deleteprodmodal'><i class='fa fa-trash' aria-hidden='true'></i> Delete</button></td>
	                    </tr>";
	            }
            } 
		}
		return $output;
	}

	if($action == "addproduct"){
		$title = mysql_escape_string($_POST['title']);
		$description = mysql_escape_string($_POST['description']);
		$category = mysql_escape_string($_POST['category']);
		$price = mysql_escape_string($_POST['price']);
		$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		mysql_query("INSERT INTO product(title, image, description, category, price) VALUES('$title', '$image', '$description', '$category', '$price')");
		$obj['cupcake'] = fetchdata("cupcake");
		$obj['mug'] = fetchdata("mug");
		$obj['mugwithcake'] = fetchdata("mugwithcake");
		echo json_encode($obj);
	}
	if($action == "checkproduct"){
		$title = mysql_escape_string($_POST['title']);
		$sql = mysql_query("SELECT * FROM product WHERE title = '$title'");
		if(mysql_num_rows($sql) > 0){
			echo true;
		}
		else{
			echo false;
		}
	}

	if($action == "checkproductedit"){
		$prodid = mysql_escape_string($_POST['prodid']);
		$title = mysql_escape_string($_POST['title']);
		$sql = mysql_query("SELECT * FROM product WHERE title = '$title' AND productID != '$prodid'");
		if(mysql_num_rows($sql) > 0){
			echo json_encode(true);
		}
		else{
			echo json_encode(false);
		}
	}

	if($action == "editproductwithnewimage"){
		$prodid = mysql_escape_string($_POST['prodid']);
		$title = mysql_escape_string($_POST['title']);
		$description = mysql_escape_string($_POST['description']);
		$category = mysql_escape_string($_POST['category']);
		$price = mysql_escape_string($_POST['price']);
		$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		mysql_query("UPDATE product SET title = '$title', description = '$description', category = '$category', price = '$price', image = '$image' WHERE productID = '$prodid'");
		$obj['cupcake'] = fetchdata('cupcake');
		$obj['mug'] = fetchdata('mug');
		$obj['mugwithcake'] = fetchdata('mugwithcake');
		echo json_encode($obj);
	}

	if($action == "editproduct"){
		$prodid = mysql_escape_string($_POST['prodid']);
		$title = mysql_escape_string($_POST['title']);
		$description = mysql_escape_string($_POST['description']);
		$category = mysql_escape_string($_POST['category']);
		$price = mysql_escape_string($_POST['price']);
		mysql_query("UPDATE product SET title = '$title', description = '$description', category = '$category', price = '$price' WHERE productID = '$prodid'");
		$obj['cupcake'] = fetchdata('cupcake');
		$obj['mug'] = fetchdata('mug');
		$obj['mugwithcake'] = fetchdata('mugwithcake');
		echo json_encode($obj);
	}

	if($action == "deleteprod"){
		$prodid = mysql_escape_string($_POST['prodid']);
		$oldimage = mysql_escape_string($_POST['oldimage']);
		$category = mysql_escape_string($_POST['category']);
		mysql_query("DELETE FROM product WHERE productID = '$prodid'");
		mysql_query("DELETE FROM cart WHERE productID = '$prodid'");
		$sql = mysql_query("SELECT * FROM settings WHERE featuredprod = '$prodid'");
		if(mysql_num_rows($sql) > 0){
			mysql_query("UPDATE settings SET featuredprod = '0'");
		}
		echo fetchdata($category);
	}

	if($action == "showall"){
		$itemrow = 1;
		$output = '';
		$sql = mysql_query("SELECT * FROM product ORDER BY productID ASC");
		if(mysql_num_rows($sql) == 0){
			$output .= '<br><br><br><div class="col-lg-12"><p class="text-center h1-responsive blue-text">No products on this category <i class="fa fa-meh-o" aria-hidden="true"></i></p></div>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$prodid = $fetch['productID'];
				$title = $fetch['title'];
				$description = $fetch['description'];
				$category = $fetch[	'category'];
				$price = $fetch['price'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$button = "'btnaddtocart".$prodid."'";
				if($itemrow == 1){
					$output .= '<div class="row animated fadeIn">';
				}
				$output .= '<div class="col-lg-4">
								<div class="card">
							    <div class="view overlay hm-white-slight">
							        <img src="'. $image . '" class="cardimg">
							        <a>
							            <div class="mask waves-effect waves-light"></div>
							        </a>
							    </div>

							    <!--Card content-->
							    <div class="card-body">
							    	<h6 class="pink-text"><i class="fa fa-tag" aria-hidden="true"></i> &#8369;' . $price . '</h5>
							        <!--Title-->
							        <h4 class="card-title infodisplay" style="height: 50px;"><span data-toggle="tooltip" data-placement="right" title="'.$title.'"><i class="fa fa-sticky-note" aria-hidden="true"></i></span> ' . $title . '</h4>
							        <!--Text-->
							        
							        <h5 class="card-text infodisplay" style="height: 87px;"><span data-toggle="tooltip" data-placement="right" title="'.$description.'" style="height: 200px;"><i class="fa fa-info-circle" aria-hidden="true"></i></i></span> ' . $description . '</h4>
							        <button class="btn btn-primary waves-effect ld-over-inverse" id="btnaddtocart'. $prodid . '" onclick="addtocart(' .$prodid. ', '.$button.' )" style="width: 100%;"><span><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</span>
							        <div class="ld ld-ball ld-bounce"></div>
							        </button>
							    </div>
								</div><br> 
							</div>';
				$itemrow++;
				if($itemrow % 4 == 0){	
					$itemrow = 1;
					$output .= '</div>';
					$output .='<br>';
				}		
			}
		}
		$_SESSION['category'] = $action;
		echo $output;
	}
	if($action == "showcupcake"){
		$itemrow = 1;
		$output = '';
		$sql = mysql_query("SELECT * FROM product WHERE category = 'Cupcake' ORDER BY productID ASC");
		if(mysql_num_rows($sql) == 0){
			$output .= '<br><br><br><div class="col-lg-12"><p class="text-center h1-responsive blue-text">No products on this category <i class="fa fa-meh-o" aria-hidden="true"></i></p></div>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$prodid = $fetch['productID'];
				$title = $fetch['title'];
				$description = $fetch['description'];
				$category = $fetch[	'category'];
				$price = $fetch['price'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$button = "'btnaddtocart".$prodid."'";
				if($itemrow == 1){
					$output .= '<div class="row animated fadeIn">';
				}
				$output .= '<div class="col-lg-4">
								<div class="card">
							    <div class="view overlay hm-white-slight">
							        <img src="'. $image . '" class="cardimg">
							        <a>
							            <div class="mask waves-effect waves-light"></div>
							        </a>
							    </div>

							    <!--Card content-->
							    <div class="card-body">
							    	<h6 class="pink-text"><i class="fa fa-tag" aria-hidden="true"></i> &#8369;' . $price . '</h5>
							        <!--Title-->
							        <h4 class="card-title infodisplay" style="height: 50px;"><span data-toggle="tooltip" data-placement="right" title="'.$title.'"><i class="fa fa-sticky-note" aria-hidden="true"></i></span> ' . $title . '</h4>
							        <!--Text-->
							        
							        <h5 class="card-text infodisplay" style="height: 87px;"><span data-toggle="tooltip" data-placement="right" title="'.$description.'" style="height: 200px;"><i class="fa fa-info-circle" aria-hidden="true"></i></i></span> ' . $description . '</h4>
							        <button class="btn btn-primary waves-effect ld-over-inverse" id="btnaddtocart'. $prodid . '" onclick="addtocart(' .$prodid. ', '.$button.' )" style="width: 100%;"><span><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</span>
							        <div class="ld ld-ball ld-bounce"></div>
							        </button>
							    </div>

								</div><br> 
							</div>';
				$itemrow++;
				if($itemrow % 4 == 0){	
					$itemrow = 1;
					$output .= '</div>';
					$output .='<br>';
				}		
			}
		}
		$_SESSION['category'] = $action;
		echo $output;
	}
	if($action == "showmug"){
		$itemrow = 1;
		$output = '';
		$sql = mysql_query("SELECT * FROM product WHERE category = 'Mug' ORDER BY productID ASC");
		if(mysql_num_rows($sql) == 0){
			$output .= '<br><br><br><div class="col-lg-12"><p class="text-center h1-responsive blue-text">No products on this category <i class="fa fa-meh-o" aria-hidden="true"></i></p></div>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$prodid = $fetch['productID'];
				$title = $fetch['title'];
				$description = $fetch['description'];
				$category = $fetch[	'category'];
				$price = $fetch['price'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$button = "'btnaddtocart".$prodid."'";
				if($itemrow == 1){
					$output .= '<div class="row animated fadeIn">';
				}
				$output .= '<div class="col-lg-4">
								<div class="card">
							    <div class="view overlay hm-white-slight">
							        <img src="'. $image . '" class="cardimg">
							        <a>
							            <div class="mask waves-effect waves-light"></div>
							        </a>
							    </div>

							    <!--Card content-->
							    <div class="card-body">
							    	<h6 class="pink-text"><i class="fa fa-tag" aria-hidden="true"></i> &#8369;' . $price . '</h5>
							        <!--Title-->
							        <h4 class="card-title infodisplay" style="height: 50px;"><span data-toggle="tooltip" data-placement="right" title="'.$title.'"><i class="fa fa-sticky-note" aria-hidden="true"></i></span> ' . $title . '</h4>
							        <!--Text-->
							        
							        <h5 class="card-text infodisplay" style="height: 87px;"><span data-toggle="tooltip" data-placement="right" title="'.$description.'" style="height: 200px;"><i class="fa fa-info-circle" aria-hidden="true"></i></i></span> ' . $description . '</h4>
							        <button class="btn btn-primary waves-effect ld-over-inverse" id="btnaddtocart'. $prodid . '" onclick="addtocart(' .$prodid. ', '.$button.' )" style="width: 100%;"><span><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</span>
							        <div class="ld ld-ball ld-bounce"></div>
							        </button>
							    </div>

								</div><br> 
							</div>';
				$itemrow++;
				if($itemrow % 4 == 0){	
					$itemrow = 1;
					$output .= '</div>';
					$output .='<br>';
				}		
			}
		}
		$_SESSION['category'] = $action;
		echo $output;
	}
	if($action == "showmugwithcake"){
		$itemrow = 1;
		$output = '';
		$sql = mysql_query("SELECT * FROM product WHERE category = 'Mug with Cake' ORDER BY productID ASC");
		if(mysql_num_rows($sql) == 0){
			$output .= '<br><br><br><div class="col-lg-12"><p class="text-center h1-responsive blue-text">No products on this category <i class="fa fa-meh-o" aria-hidden="true"></i></p></div>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$prodid = $fetch['productID'];
				$title = $fetch['title'];
				$description = $fetch['description'];
				$category = $fetch[	'category'];
				$price = $fetch['price'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$button = "'btnaddtocart".$prodid."'";
				if($itemrow == 1){
					$output .= '<div class="row animated fadeIn">';
				}
				$output .= '<div class="col-lg-4">
								<div class="card">
							    <div class="view overlay hm-white-slight">
							        <img src="'. $image . '" class="cardimg">
							        <a>
							            <div class="mask waves-effect waves-light"></div>
							        </a>
							    </div>

							    <!--Card content-->
							    <div class="card-body">
							    	<h6 class="pink-text"><i class="fa fa-tag" aria-hidden="true"></i> &#8369;' . $price . '</h5>
							        <!--Title-->
							        <h4 class="card-title infodisplay" style="height: 50px;"><span data-toggle="tooltip" data-placement="right" title="'.$title.'"><i class="fa fa-sticky-note" aria-hidden="true"></i></span> ' . $title . '</h4>
							        <!--Text-->
							        
							        <h5 class="card-text infodisplay" style="height: 87px;"><span data-toggle="tooltip" data-placement="right" title="'.$description.'" style="height: 200px;"><i class="fa fa-info-circle" aria-hidden="true"></i></i></span> ' . $description . '</h4>
							        <button class="btn btn-primary waves-effect ld-over-inverse" id="btnaddtocart'. $prodid . '" onclick="addtocart(' .$prodid. ', '.$button.' )" style="width: 100%;"><span><i class="fa fa-cart-plus" aria-hidden="true"></i> Add to Cart</span>
							        <div class="ld ld-ball ld-bounce"></div>
							        </button>
							    </div>

								</div><br>
							</div>';
				$itemrow++;
				if($itemrow % 4 == 0){	
					$itemrow = 1;
					$output .= '</div>';
					$output .='<br>';
				}		
			}
		}
		$_SESSION['category'] = $action;
		echo $output;
	}
	if($action == "productlist"){
		$output = '';
		$sql = mysql_query("SELECT productID, title, image FROM product ORDER BY productID ASC");
		if(mysql_num_rows($sql) == 0){
			$output .= 
			'<tr>
				<td colspan="3" class="h3 text-center">No Products found</td>
			</tr>
			';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$prodid = $fetch['productID'];
				$title = $fetch['title'];
				$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
				$output .= 
				'<tr>
				      <td>
				      	<img src="'.$image.'" style="max-height: 100; max-width: 100%">
				      </td>
				      <td class="h4-responsive">'.$title.'</td>
				      <td align="right">
				      	<button type="button" onclick="selectfeaturedprod('.$prodid.')" class="btn btn-sm btn-default waves-effect waves-light">Select</button>
				      </td>
				</tr>';
			}
		}
		echo json_encode($output);
	}
	if($action == "tblcupcake"){
		echo json_encode(fetchdata('cupcake'));
	}
	if($action == "tblmug"){
		echo json_encode(fetchdata('mug'));
	}
	if($action == "tblmugwithcake"){
		echo json_encode(fetchdata('mugwithcake'));
	}
?>
