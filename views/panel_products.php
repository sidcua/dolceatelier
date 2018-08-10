<?php  
    include '../php/connect.php';
    $_SESSION['adminpanel'] = "products";
?>
<div class="card deep-orange lighten-1 text-center z-depth-2 animated fadeIn">
    <div class="card-body">
        <h2 class="white-text mb-0">Manage Products</h2>
    </div>
</div>
<br>
<div class="container animated fadeIn d-flex justify-content-between">
    <span class="blue-text h1-responsive"><i class="fa fa-caret-square-o-down" aria-hidden="true"></i> Products</span>
    <button type="button" class="btn btn-outline-primary waves-effect" data-target="#newproductmodal" data-toggle="modal"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Product</button>
</div>
<br>
<!-- Nav tabs -->
<ul class="nav nav-tabs nav-justified">
    <li class="nav-item">
        <a onclick="category('cupcake')" class="nav-link active" data-toggle="tab" href="#panel1" role="tab"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Cupcakes</a>
    </li>
    <li class="nav-item">
        <a onclick="category('mug')" class="nav-link" data-toggle="tab" href="#panel2" role="tab"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Mugs</a>
    </li>
    <li class="nav-item">
        <a onclick="category('mugwithcake')" class="nav-link" data-toggle="tab" href="#panel3" role="tab"><i class="fa fa-circle-o-notch" aria-hidden="true"></i> Mugs with Cake</a>
    </li>
</ul>

<input id="productidholder" type="hidden" value="" />
<input id="oldimageholder" type="hidden" value="" />
<input id="categoryholder" type="hidden" value="cupcake" />
<!-- Tab panels -->
<div class="tab-content card animated fadeIn">
    <!--Panel 1-->
    <div class="tab-pane fade in show active customheighttbl" id="panel1" role="tabpanel">
        <table class="table table-hover animated fadeIn table-responsive">
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th width="20%">Title</th>
                    <th width="30%">Description</th>
                    <th width="20%">Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="cupcake">
                
            </tbody> 
        </table>
    </div>
    
    <!--/.Panel 1-->
    <!--Panel 2-->
    <div class="tab-pane fade in show customheighttbl" id="panel2" role="tabpanel">
        <table class="table table-hover animated fadeIn table-responsive">
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th width="20%">Title</th>
                    <th width="30%">Description</th>
                    <th width="20%">Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="mug">
                
            </tbody> 
        </table>
    </div>
    <!--/.Panel 2-->
    <!--Panel 3-->
    <div class="tab-pane fade in show customheighttbl" id="panel3" role="tabpanel">
        <table class="table table-hover animated fadeIn table-responsive">
            <thead class="mdb-color darken-3">
                <tr class="text-white">
                    <th width="20%">Title</th>
                    <th width="30%">Description</th>
                    <th width="20%">Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="mugwithcake">
                
            </tbody> 
        </table>
        </div>
    
    <!--/.Panel 3-->
</div>

<div class="modal fade" id="newproductmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header deep-orange lighten-1">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Add Product</strong></h4>
                <button type="button" id="modalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p class="error" id="errormsgaddproduct"></p>
                <div class="md-form">
                    <input type="text" id="title" class="form-control" length="10">
                    <label for="title" class="">Title</label>
                </div>

                <div class="md-form">
                    <textarea type="text" id="description" class="md-textarea"></textarea>
                    <label for="description">Description</label>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Category</label>
                            <div id="addcat">
                                <select id="category" class="form-control selectpicker">
                                    <option value="-- Choose Category --">-- Choose Category --</option>
                                    <option value="Cupcake">Cupcake</option>
                                    <option value="Mug">Mug</option>
                                    <option value="Mug with Cake">Mug with Cake</option>
                                </select>
                            </div>                        </div>
                        <div class="col-lg-6">
                            <div class="md-form">
                                <input type="number" min="1" id="price" class="form-control">
                                <label for="price" class="">Price</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="fileinput-div d-flex justify-content-start">
                                    <label id="addproductlabel" for="image" class="input-label white-text z-depth-1">
                                        <i class="fa fa-upload" aria-hidden="true"></i> Select File
                                    </label>
                                    <input id="image" type="file" class="invi-file" onchange="return validateimage()">
                                </div>
                            </div>
                            <div class="col-lg-6" align="center">
                                <img src="img/NoImage.png" id="imageshow" class="img-thumbnail" style="width: 120px; height: 100px;">
                            </div>
                        </div>
                    </div>
                </div>
                
                
            </div>

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" id="addprod" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="btnutton" onclick="addproduct()" class="btn btn-outline-primary waves-effect">Add Product</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>

<div class="modal fade" id="viewproductmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header blue lighten-1">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Product</strong></h4>
                <button type="button" id="viewproductmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 d-flex justify-content-center">
                            <img src="" id="prodimage" class="img-thumbnail" style="width: 230px; height: 200px; float: left;">
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-7 d-flex flex-column p-3">
                            <p class="h5-responsive"><i class="fa fa-bookmark" aria-hidden="true"></i> <u>Title</u></p>
                            <p class="h6-responsive indent" id="prodtitle"></p>
                            <p class="h5-responsive"><i class="fa fa-quote-left" aria-hidden="true"></i> <u>Description</u></p>
                            <p class="h6-responsive indent" id="proddescription"></p>
                            <p class="h5-responsive"><i class="fa fa-money" aria-hidden="true"></i> <u>Price</u></p>
                            <p class="h6-responsive indent" id="prodprice"></p>
                        </div>
                    </div>
                </div>
                  
            </div>
            
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-info waves-effect" data-dismiss="modal">Close</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>

<div class="modal fade" id="deleteprodmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header red">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Delete</strong></h4>
                <button type="button" id="deleteprodmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p><strong>Are you sure you want to delete this product?</strong></p>
            </div>
            

            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Cancel</button>
                <button type="button" id="btnaddproduct" class="btn btn-outline-danger waves-effect" onclick="deleteproduct()">Delete</button>
            </div>
            
        </div>

        <!--/.Content-->
    </div>
</div>

<div class="modal fade" id="editprodmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header deep-orange lighten-1">
                <h4 class="modal-title w-100 white-text" id="myModalLabel"><strong>Edit Product</strong></h4>
                <button type="button" id="editprodmodalclose" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--Body-->

            <div class="modal-body">
                <p class="error" id="errormsgeditproduct"></p>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="md-form">
                                <label><strong>Title</strong></label>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="md-form">
                            <input type="text" id="edittitle" class="form-control">
                        </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <div class="md-form">
                                <label><strong>Description</strong></label>
                            </div>
                        </div>
                        <div class="col-lg-10">
                            <div class="md-form">
                                <textarea type="text" id="editdescription" class="md-textarea"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Category</label>
                            <div id="cat">
                                <select id="editcategory" class="form-control">
                                    <option value="-- Choose Category --">-- Choose Category --</option>
                                    <option value="Cupcake">Cupcake</option>
                                    <option value="Mug">Mug</option>
                                    <option value="Mug with Cake">Mug with Cake</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="md-form">
                                            <label><strong>Price</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="md-form">
                                            <input type="number" min="1" id="editprice" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>                         
                        </div>
                    </div>
                </div>
                <div class="row">
                    &nbsp;&nbsp;&nbsp;&nbsp;<button type="button" id="btnchangeimage" class="btn btn-sm btn-deep-orange waves-effect waves-light" data-toggle="collapse" data-target="#prodimagecollapse" aria-expanded="false" aria-controls="prodimagecollapse">Change Image</button>
                </div>
                <div class="collapse" id="prodimagecollapse">
                    <div class="card card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="fileinput-div d-flex justify-content-start">
                                        <label id="editproductlabel" for="editimage" class="input-label white-text z-depth-1">
                                            <i class="fa fa-upload" aria-hidden="true"></i> Select File
                                        </label>
                                        <input id="editimage" type="file" class="invi-file" onchange="return validateimageforedit()">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <img src="img/NoImage.png" id="editimageshow" class="img-thumbnail" style="width: 120px; height: 100px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="btnutton" onclick="editproduct()" class="btn btn-outline-primary waves-effect">Update</button>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>

<script>
    $(document).ready(function () {
        $('body').on('click', '#prodtable',function(){
            document.getElementById("productidholder").value = $(this).attr('data-id');
            document.getElementById("oldimageholder").value = $(this).closest("tr").find(".image").text();
        }); 
        $("#newproductmodal").on('hidden.bs.modal', function(){
            $("#errormsgaddproduct").html("");
            $("#title").val("");
            $("#description").val("");
            $("div#addcat select").val("-- Choose Category --");
            $("#price").val("");
            $("#image").val("");
            $('#imageshow').attr('src', 'img/NoImage.png');
            
            $("#addproductlabel").html('<i class="fa fa-upload" aria-hidden="true"></i> Select File');
        });
        $('body').on('click', '.showproduct', function(){
            var title = $(this).closest("tr").find(".title").text();
            var description = $(this).closest("tr").find(".description").text();
            var price = $(this).closest("tr").find(".price").text();
            var image = $(this).closest("tr").find(".image").text();
            $("#prodtitle").text(title);
            $("#proddescription").text(description);
            $("#prodprice").text(price);
            $("#prodimage").attr('src', image);
        });
        $('body').on('click', '.editproduct', function(){
            var title = $(this).closest("tr").find(".title").text();
            var description = $(this).closest("tr").find(".description").text();
            var price = $(this).closest("tr").find(".price").text();
            var image = $(this).closest("tr").find(".image").text();
            var category = $(this).closest("tr").find(".category").text();
            document.getElementById("oldimageholder").value = image;
            $("#edittitle").val(title);
            $("#editdescription").val(description);
            $("#editprice").val(price);
            $("div#cat select").val(category);
            $("#editimage").text(image);
            $("#editeditcategory").val(category);
            $("#editimageshow").attr('src', image);
            $("#errormsgeditproduct").html("");
            $("#editproductlabel").html('<i class="fa fa-upload" aria-hidden="true"></i> Select File');
            $("#prodimagecollapse").collapse('hide');
            var button = document.getElementById("btnchangeimage");
            $("#btnchangeimage").text("Change Image")
            button.classList.remove("btn-danger");
            button.className += " btn-deep-orange";
        });
        $('body').on('click', '#btnchangeimage', function(){
            var button = document.getElementById("btnchangeimage");
            if($("#btnchangeimage").text() == "Change Image"){
                $("#btnchangeimage").text("Cancel")
                button.classList.remove("btn-deep-orange");
                button.className += " btn-danger";
            }
            else{
                $("#btnchangeimage").text("Change Image")
                button.classList.remove("btn-danger");
                button.className += " btn-deep-orange";
            }
        });
        showcupcake();
        showmug();
        showmugwithcake();
    });
    function category(category){
        document.getElementById("categoryholder").value = category;
    }
    function showcupcake(){
        $.ajax({
            url: "php/product.php",
            method: "POST",
            data: {action: "tblcupcake"},
            beforeSend: function(){
                data = "<td colspan=4>" + load2() + "</td>";
                $('#cupcake').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $("#cupcake").html(data);
            }
        })
    }
    function showmug(){
        $.ajax({
            url: "php/product.php",
            method: "POST",
            data: {action: "tblmug"},
            beforeSend: function(){
                data = "<td colspan=4>" + load2() + "</td>";
                $('#mug').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $("#mug").html(data);
            }
        })
    }
    function showmugwithcake(){
        $.ajax({
            url: "php/product.php",
            method: "POST",
            data: {action: "tblmugwithcake"},
            beforeSend: function(){
                data = "<td colspan=4>" + load2() + "</td>";
                $('#mugwithcake').html(data);
            },
            success: function(data){
                data = $.parseJSON(data);
                $("#mugwithcake").html(data);
            }
        })
    }
</script>

