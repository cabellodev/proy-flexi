<div id="content-wrapper">
    <div class="container-fluid mb-5" id="adminColors">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">Productos</li>
            <li class="breadcrumb-item active">Editar Productos</li>
        </ol>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
                Información general 
            </div>

            <div class="card-body">

            <div class="row">
                <div class="col-md-8 mb-3">
                    <div class="row mb-3">
                        <div class="col-4 col-sm-6">
                            <label for="actividad">Código de producto</label>
                            <div class="input-group" id='frm_code'>
                                <input type="text" class="form-control" name="code" id="code">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6">
                            <label for="actividad">Nombre</label>
                            <div class="input-group" id='frm_name'>
                                <input type="text" class="form-control" name="name" id="name">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 col-sm-6">
                            <label for="actividad">Stock inicial</label>
                            <div class="input-group" id='frm_stock'>
                                <input type="number" min="0" class="form-control" name="stock" id="stock">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6">
                            <label for="actividad">Precio</label>
                            <div class="input-group" id='frm_price'>
                                <input type="number" min="0" class="form-control" name="price" id="price" aria-describedby="inputGroupPrepend3">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4 col-sm-6">
                            <label for="actividad">Modelo</label>
                            <div class="input-group" id='frm_model'>
                                <input type="text" class="form-control" name="model" id="model">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-4 col-sm-6" id="frm_supplier">
                            <label>Proveedor</label>
                            <select class="custom-select d-block w-100" id="supplier" name="supplier" >
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3" style='text-align: center; align-items:center'>
                    <div class="input-group">
                        <label id='tr_label_image_header'style='display:block;margin:auto;' >Imagen Cabecera</label></br>    
                    </div>
                    <div class="input-group" id="frm_imagenPrincipal">
                        <label class="btn btn-primary" id='tr_label_image_header' style='margin:auto;' for="image_header_add">  <i class='fas fa-plus'></i> Seleccionar Imagen</label></br>  
                        <input type="file" id="image_header_add" style="display:none;" accept=".png, .jpg, .jpeg" name="file" />
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group" style='margin-top:10px;'>
                        <img id='image_header' style='display:block;margin:auto;' src="<?php echo base_url(); ?>assets/images/products/image_first/noimage.png" width="200" heigth="200">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="row mb-3">
                        <div class="col-4 col-sm-4" id="frm_category">
                            <label>Categoria</label>
                            <select class="custom-select d-block w-100" id="category" name="category" >
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
              <!--          <div class="col-4 col-sm-4" id="frm_subCategory">
                            <label>Sub-Categoria</label>
                            <select class="custom-select d-block w-100" id="subCategory" name="subCategory">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="col-4 col-sm-4" id="frm_subSubCategory">
                            <label>Sub-sub-Categoria</label>
                            <select class="custom-select d-block w-100" id="subSubCategory" name="subSubCategory">
                                <option></option>
                            </select>
                            <div class="invalid-feedback"></div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
               Descripción
            </div>
            <div class="card-body" id='descr_product'>
            </div>
            <div id='product_div_add' name='tr_add' style='margin-bottom:15px; margin-top:-15px;'>
                <div style="text-align: center;">
                    <button id='product_btn_add' class="btn btn-primary rounded-circle"><i class="fas fa-plus"></i></button>
                </div>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-header">
                <i class="fas fa-table"></i>
               Imagenes
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm row justify-content-md-center align-items-center">
                        <div class="card" style="width:400px; align-items:center">
                            <h4 class="card-title">1° Imagen</h4>
                            <img src="<?php echo base_url(); ?>assets/images/products/image_first/noimage.png" id='1_image' class="card-img-top" alt="...">
                            <input id='control_image1' style='display: none'></input>
                            <div class="card-body" style="overflow: hidden; width: 100%;">
                                <div class="col-sm file btn btn-lg btn-success" style="overflow: hidden; width: 50%; float:left">
                                    Agregar
                                    <input type="file" id='1_image_add' style="position: absolute; font-size: 50px; opacity: 0; right: 0; top: 0;" accept=".png, .jpg, .jpeg" name="file" />
                                </div>
                                <div class="col-sm file btn btn-lg btn-danger" id='1_image_delete' style="overflow: hidden; width: 50%; float:right">
                                    Eliminar
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-sm row justify-content-md-center align-items-center">
                        <div class="card" style="width:400px; align-items:center">
                            <h4 class="card-title">2° Imagen</h4>
                            <img src="<?php echo base_url(); ?>assets/images/products/image_first/noimage.png" id='2_image' class="card-img-top" alt="...">
                            <input id='control_image2' style='display: none'></input>
                            <div class="card-body" style="overflow: hidden; width: 100%;">
                                <div class="col-sm file btn btn-lg btn-success" style="overflow: hidden; width: 50%; float:left">
                                    Agregar
                                    <input type="file" id='2_image_add' style="position: absolute; font-size: 50px; opacity: 0; right: 0; top: 0;" accept=".png, .jpg, .jpeg" name="file"/>
                                </div>
                                <div class="col-sm file btn btn-lg btn-danger" id='2_image_delete' style="overflow: hidden; width: 50%; float:right">
                                    Eliminar
                                </div>                              
                            </div>
                        </div>
                    </div>
                    <div class="col-sm row justify-content-md-center align-items-center">
                        <div class="card" style="width:400px; align-items:center">
                            <h4 class="card-title">3° Imagen</h4>
                            <img src="<?php echo base_url(); ?>assets/images/products/image_first/noimage.png" id='3_image' class="card-img-top" alt="...">
                            <input id='control_image3' style='display: none'></input>
                            <div class="card-body" style="overflow: hidden; width: 100%;">
                                <div class="col-sm file btn btn-lg btn-success" style="overflow: hidden; width: 50%; float:left">
                                    Agregar
                                    <input type="file" id='3_image_add' style="position: absolute; font-size: 50px; opacity: 0; right: 0; top: 0;" accept=".png, .jpg, .jpeg" name="file"/>
                                </div>
                                <div class="col-sm file btn btn-lg btn-danger" id='3_image_delete' style="overflow: hidden; width: 50%; float:right">
                                    Eliminar
                                </div>                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-right: 40px; margin-bottom: 40px;">
                <button style="float: right" class="btn btn-success" type='button' id="btn_save"> Editar Producto</button>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/js_admin/updateProduct.js"></script>
<script type="application/javascript">
    $('.custom-file input').change(function (e) {
        if (e.target.files.length) {
            $(this).next('.custom-file-label').html(e.target.files[0].name);
        }
    });
</script>







