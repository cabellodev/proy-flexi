<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Noticias</li>
    </ol>

    

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de noticias
         <button class="btn btn-secondary float-right" type='button' data-toggle="modal" data-target="#create_new_modal" ><i class="fas fa-plus"></i> Agregar noticia</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-news" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Estado</th>
                <th>Ver</th>
                <th>Editar</th>
                <th>Deshabilitar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="show_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">              
      <div class="modal-body" >
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="create_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" >Agregar noticia</h5>
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
                                <label for="actividad">Título </label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control" name="title" id="title" placeholder="Ingrese titulo">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                          </div>
                          <div class="col-md-6 mb-3">
                                <label for="actividad">Descripción</label>
                                <div div class="input-group" id="frm_name2">
                                    <textarea class="form-control"  name="description" id="description" placeholder="Ingrese descripción"></textarea>
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
                                        <label  for="file_e">Elegir imagen</label>
                                      <!-- <label class="custom-file-label" for="file_e">Elegir imagen</label>-->
                                        </form>
                                        </div>
                                  </div>
                                  <div class="form-group float-right">
                                      <button type="button" id="btn_create_new" class="btn btn-primary">Guardar</button>
                                  </div>
                              </div>
          
                        </div>
               </div>

               </div>
        </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="edit_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Editar noticia</h5>
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
                                <label for="actividad">Título</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="title" id="title-edit" placeholder="Ingrese nombre">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                          </div>

                          <div class="col-md-6 mb-3">
                                <label for="actividad">Descripción</label>
                                <div div class="input-group" id="frm_name2">
                                    
                                <textarea class="form-control"  name="title" id="description-edit" placeholder="Ingrese nombre"></textarea>
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                          </div>
                        </div>
                    
                        <div class="form-group float-right">
                             <button type="button" id="edit_notice_btn" class="btn btn-primary">Guardar</button>
                        </div>
              </div>
        </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/adminNews.js"></script>