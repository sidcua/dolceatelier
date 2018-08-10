<?php  
	session_start();
	include "connect.php";
	$action = $_POST['action'];

	if($action == "showannouncement"){
		$sql = mysql_query("SELECT announcement FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['announcement'];
		echo json_encode($txt);
	}
	if($action == "editannouncement"){
		$txt = mysql_escape_string($_POST['announce']);
		mysql_query("UPDATE settings SET announcement = '$txt'");
		$sql = mysql_query("SELECT announcement FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['announcement'];
		echo json_encode($txt);
	}
	if($action == "clearannouncement"){
		$txt = "No Announcement...";
		mysql_query("UPDATE settings SET announcement = '$txt'");
		$sql = mysql_query("SELECT announcement FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['announcement'];
		echo json_encode($txt);
	}

	if($action == "showwork"){
		$sql = mysql_query("SELECT workhour FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['workhour'];
		echo json_encode($txt);
	}
	if($action == "editwork"){
		$txt = mysql_escape_string($_POST['work']);
		mysql_query("UPDATE settings SET workhour = '$txt'");
		$sql = mysql_query("SELECT workhour FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['workhour'];
		echo json_encode($txt);
	}
	if($action == "clearwork"){
		$txt = "Message us to know the schedule of our workshop...";
		mysql_query("UPDATE settings SET workhour = '$txt'");
		$sql = mysql_query("SELECT workhour FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$txt = $fetch['workhour'];
		echo json_encode($txt);
	}

	function fetchfeaturedprod(){
		$output = '';
		$sql = mysql_query("SELECT featuredprod FROM settings");
		$fetch = mysql_fetch_assoc($sql);
		$prodid = $fetch['featuredprod'];
		if($prodid == 0){
			$output .= 
			'<div class="row">
	        	<p class="h3-responsive">No Featured Product...</p>		
	        </div>';
		}
		else{
			$sql = mysql_query("SELECT image, title, description FROM product WHERE productID = '$prodid'");
			$fetch = mysql_fetch_assoc($sql);
			$image = "data:image/jpeg;base64,".base64_encode($fetch['image']);
			$title = $fetch['title'];
			$description = $fetch['description'];
			$output .= 
			'<div class="row">
	        		<blockquote class="blockquote bq-success">
	        		<img src="'.$image.'" class="img-fluid p-3" style="max-width: 100%; max-height: 200px;">
					<p class="h2-responsive"><strong>Title:</strong> '.$title.'</p>
					<p class="h5-responsive"><strong>Description:</strong> '.$description.'</p>
					</blockquote>
	        	</div>
	        </div>';
		}
		return $output;
	}
	if($action == "showfeaturedprod"){
		echo json_encode(fetchfeaturedprod());
	}
	if($action == "addfeaturedprod"){
		$prodid = mysql_escape_string($_POST['prodid']);
		mysql_query("UPDATE settings SET featuredprod = '$prodid'");
		echo json_encode(fetchfeaturedprod());
	}
	if($action == "clearfeaturedprod"){
		mysql_query("UPDATE settings SET featuredprod = '0'");
		echo json_encode(fetchfeaturedprod());
	}

	function fetchcarouselslides(){
		$output = '';
		$sql = mysql_query("SELECT * FROM carousel_settings");
		if(mysql_num_rows($sql) == 0){
			$output .= 
			'<tr>
				<td colspan="2" class="h3 text-center">No Slides found</td>
			</tr>';
		}
		else{
			while($fetch = mysql_fetch_assoc($sql)){
				$image = "data:image/jpeg;base64,".base64_encode($fetch['slide']);
				$slideid = $fetch['slideID'];
				if($image != ""){
					$output .= 
					'<tr>
					      <td align="center"><img src="'.$image.'" style="max-height: 100; max-width: 100%"></td>
					      <td align="right"><button onclick="removeslide('.$slideid.')" type="button" class="btn btn-sm btn-warning waves-effect waves-light">Remove</button></td>
					    </tr>';
				}
			}
		}
		return $output;
	}
	if($action == "showcarousel"){
		echo json_encode(fetchcarouselslides());
	}
	if($action == "addslide"){
		$image = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
		mysql_query("INSERT INTO carousel_settings (slide) VALUES ('$image')");
		echo json_encode(fetchcarouselslides());
	}
	if($action == "clearcarousel"){
		mysql_query("DELETE FROM carousel_settings");
		echo json_encode(fetchcarouselslides());
	}
	if($action == "removeslide"){
		$slideid = mysql_escape_string($_POST['slideid']);
		mysql_query("DELETE FROM carousel_settings WHERE slideID = '$slideid'");
		echo json_encode(fetchcarouselslides());
	}
?>