<?php 
    include '../php/connect.php';
    $_SESSION['adminpanel'] = "settings";
?>
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeIn">
    <div class="card-body">
        <h2 class="white-text mb-0">Settings</h2>
    </div>
</div>
<div class="divspace"></div>
<div class="container-fluid animated fadeIn">
	<div class="row">
		<div class="col-lg-6">
			<blockquote id="bqannouncement" class="blockquote bq-warning ld-over">
			    <p class="bq-title">Announcement <i class="fa fa-rss" aria-hidden="true"></i></p>
			    <p id="announcement" style="white-space: pre-wrap;"></p>
			    <div class="ld ld-ring ld-spin"></div>
			</blockquote>
			
		</div>
		<div class="col-lg-6">
			<div class="container-fluid">
				<div class="row d-flex justify-content-center">
					<button type="button" class="btn btn-outline-default waves-effect" data-toggle="collapse" data-target="#collapseannouncement">Edit</button>
					<button data-toggle="modal" data-target="#clearannouncement" type="button" class="btn btn-outline-danger waves-effect">Clear</button>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="collapse" id="collapseannouncement">
							<br>
							<div class="md-form">
							    <i class="fa fa-pencil prefix"></i>
							    <textarea type="text" id="txtannouncement" class="md-textarea newline-for-textline"></textarea>
							    
							</div>
							<div class="d-flex justify-content-end">
								<button onclick="editannouncement()" type="button" class="btn btn-success waves-effect waves-light">Save</button>
								<button onclick="$('#collapseannouncement').collapse('hide');" type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="divspace"></div>
	<div class="row">
		<div class="col-lg-6">
			<blockquote id="bqwork" class="blockquote bq-primary ld-over">
			    <p class="bq-title">Work Hours <i class="fa fa-magic" aria-hidden="true"></i></p>
			    <p id="work" style="white-space: pre-wrap;"></p>
			    <div class="ld ld-ring ld-spin"></div>
			</blockquote>
			
		</div>
		<div class="col-lg-6">
			<div class="container-fluid">
				<div class="row d-flex justify-content-center">
					<button type="button" class="btn btn-outline-default waves-effect" data-toggle="collapse" data-target="#collapsework">Edit</button>
					<button data-toggle="modal" data-target="#clearwork" type="button" class="btn btn-outline-danger waves-effect">Clear</button>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="collapse" id="collapsework">
							<br>
							<div class="md-form">
							    <i class="fa fa-pencil prefix"></i>
							    <textarea type="text" id="txtwork" class="md-textarea newline-for-textline"></textarea>
							    
							</div>
							<div class="d-flex justify-content-end">
								<button onclick="editwork()" type="button" class="btn btn-success waves-effect waves-light">Save</button>
								<button onclick="$('#collapsework').collapse('hide');" type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<div class="divspace"></div>
	<div class="row">
		<div class="col-lg-6">
			<p class="h1-responsive green-text"><i class="fa fa-diamond" aria-hidden="true"></i> Featured Product</p>
	        <br>
	        <div id="featuredprod" class="container-fluid ld-over">
	        	
	        </div>
		</div>
		<div class="col-lg-6">
			<div class="row d-flex justify-content-center">
				<button onclick="initproductlist()" type="button" class="btn btn-outline-default waves-effect ld-over-inverse btnselectprod">
				Select Product
				<div class="ld ld-spin ld-ring"></div>
				</button>
				<button data-toggle="modal" data-target="#clearfeaturedprod" type="button" class="btn btn-outline-danger waves-effect">Remove</button>
			</div>
		</div>
	</div>
	<div class="divspace"><br><br></div>
	<div class="row">
		<div class="col-lg-6">
			<p class="h1-responsive blue-text"><i class="fa fa-sliders" aria-hidden="true"></i> Carousel</p>
	        <br>
	        <div id="divcarousel" class="container-fluid ld-over" style="max-height: 320px; overflow: auto;">
	        	<table class="table table-hover">
				  <thead>
				    <tr>
				      <th widht="50%"></th>
				      <th width="50%"></th>
				    </tr>
				  </thead>
				  <tbody id="carouselslides">
				  </tbody>
				</table>
				<div class="ld ld-spin ld-ring"></div>
	        </div>
		</div>
		<div class="col-lg-6">
			<div class="container-fluid">
				<div class="row d-flex justify-content-center">
					<button data-toggle="collapse" data-target="#collapsecarousel" type="button" class="btn btn-outline-default waves-effect ld-over-inverse">
					Add Image
					</button>
					<button data-toggle="modal" data-target="#clearcarousel" type="button" class="btn btn-outline-danger waves-effect">Remove all Slides</button>
				</div>
				<div class="row">
					<div class="col-lg-12">
						<div class="collapse" id="collapsecarousel">
							<br>
							<p id="errorcarousel" class="error"></p>
							<div class="fileinput-div d-flex justify-content-center">
								<label id="slidelabel" for="slideimage" class="input-label white-text z-depth-1">
									<i class="fa fa-upload" aria-hidden="true"></i> Select File
								</label>
								<input id="slideimage" type="file" class="invi-file" onchange="validateimage_addcarousel()">
							</div>
							<div class="d-flex justify-content-end">
								<button onclick="addslide()" type="button" class="btn btn-success waves-effect waves-light">Add</button>
								<button onclick="$('#collapsecarousel').collapse('hide');" type="button" class="btn btn-secondary waves-effect waves-light">Cancel</button>
							</div>
							
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>


<!--  -->
<!--  -->
<!-- Modals -->
<div class="modal fade" id="clearannouncement" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Announcement</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to clear the Announcement section?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="clearannouncement()">Clear</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="clearwork" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Work Hours</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to clear the Work Hour section?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="clearwork()">Clear</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="clearfeaturedprod" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Featured Product</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to remove the featured product?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="clearfeaturedprod()">Clear</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="clearcarousel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Carousel</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to remove all slides in the carousel?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="clearcarousel()">Clear</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>
<div class="modal fade" id="productlistmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-pink">
                <h4 class="modal-title white-text w-100" id="myModalLabel"><strong>Product List</strong></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body" style="max-height: 500px; overflow: auto;">
                <table class="table table-hover">
                	<thead>
				        <tr>
				            <th width="20%"></th>
				            <th width="60%"></th>
				            <th width="20%"></th>
				        </tr>
				    </thead>
				  <tbody id="productlist">
				  </tbody>
				</table>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect waves-light" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<script>
	$(document).ready(function(){
		fetchdata();
		$('#collapseannouncement').on('show.bs.collapse', function () {
			$("#txtannouncement").text($("#announcement").text());
		})
		$('#collapsework').on('show.bs.collapse', function () {
			$("#txtwork").text($("#work").text());
		})
		$('#collapsecarousel').on('hidden.bs.collapse', function () {
			$("#slideimage").val("");
			$("#errorcarousel").html("");
			$("#slidelabel").html('<i class="fa fa-upload" aria-hidden="true"></i> Select File');
		})
	});
	function fetchdata(){
		$.ajax({
			url: "php/settings.php",
			method: "POST",
			data: {action: "showannouncement"},
			beforeSend: function(){
				$('#announcement').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#announcement").text(data);
			}
		});
		$.ajax({
			url: "php/settings.php",
			method: "POST",
			data: {action: "showwork"},
			beforeSend: function(){
				$('#work').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#work").text(data);
			}
		});
		$.ajax({
			url: "php/settings.php",
			method: "POST",
			data: {action: "showfeaturedprod"},
			beforeSend: function(){
				$('#featuredprod').html(load2());
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#featuredprod").html(data);
			}
		});
		$.ajax({
			url: "php/settings.php",
			method: "POST",
			data: {action: "showcarousel"},
			beforeSend: function(){
				data = "<td colspan='2'>" + load2() + "</td>";
			    $('#carouselslides').html(data);
			},
			success: function(data){
				data = $.parseJSON(data);
				$("#carouselslides").html(data);
			}
		});
	}
</script>