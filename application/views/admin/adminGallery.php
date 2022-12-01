

<div id="content-wrapper">
  <div class="container-fluid mb-5">

        <ol class="breadcrumb">
          <li class="breadcrumb-item active" id="header-title">Galeria de imágenes / Servicio  <?php echo $id; ?></li>
          <input type="hidden" class="form-control" id="id_service" name="id" value='<?= $id ?>' >
        </ol>

            <div class="card mb-3">
                  <div class="card-header">
                    <i class="fas fa-table"></i>
                    Lista de Imágenes
                    <button class="btn btn-dark float-right" type='button' data-toggle="modal" data-target="#create_image_modal" id="modal_create"><i class="fas fa-plus"></i> Agregar imagen</button>
                  </div>
                  <div class="card-body">
            
          
                      <div class="table-responsive">
                          <table class="table table-bordered" id="table_images" width="100%" cellspacing="0">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Imagen</th>
                                <th>Ver</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                  </div>
            </div>


          <div class="row mb-3"></div>
  </div>
</div>





<!---   modal image ---->
<div class="modal fade" id="show_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">              
      <div class="modal-body" >
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview  " style="width: 100%;" >
      </div>
    </div>
  </div>
</div>


<!---   modal edit image  ---->
<div class="modal fade bd-example-modal-lg" id="create_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
          <div class="modal-header">
                <h5 class="modal-title" id="title">Agregar imagen</h5>
                <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
          </div>
          <div class="modal-body">
                <div class="row">
                  <div class="col-sm">
                    <p id="UserModalInfo"></p>
                  </div>
                </div>
      
               <div class="form-group">
                        <form  id= "image" >

                           <div class="row">
                              <div class="col-md-6 mb-3">
                                    <label for="actividad">Nombre de la imagen</label>
                                    <div div class="input-group" id="frm_name2">
                                        <input type="text" class="form-control"  name="name" id="name" placeholder="Ingrese nombre">
                                        <div class="invalid-feedback "></div>
                                    </div> 
                              </div>
                            </div>

                            <div class="row">

                                <div class="col-md-12 mb-3">
                                  <label for="actividad">Cargar imagen:</label>
                                      <div class="form-group " id="frm_foto">
                                          <div class= "custom-input" >
                                              <input type="file"  data-preview-file-type="any" name="file" id="file">
                                              <label    for="file_e">Elegir imagen</label>
                                            <!-- <label class="custom-file-label" for="file_e">Elegir imagen</label>-->
                                              </form>
                                          </div>
                                      </div>
                                      <div class="form-group float-right">
                                          <button type="button" id="create_image_btn" class="btn btn-primary">Guardar</button>
                                      </div>
                                 </div>
                             </div>
            </div>
      </div>
  </div>
</div>
</div>





<script src="<?php echo base_url(); ?>assets/js_admin/adminGallery.js"></script>
