<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Empleos/notificaciones</li>
    </ol>


    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Secciones Empleo
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-sections" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Titulo</th>
                <th>Item</th>   
                <th>Imagen</th> 
                <th>Editar</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>

    <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Publicación de empleo
              <button class="btn btn-secondary float-right" type='button' data-toggle="modal" data-target="#modal_create_charge" id="btn_create_supplier"><i class="fas fa-plus"></i> Agregar cargo</button>
            </div>
            <div class="card-body">
                <div class="row my-5">
                    <div class="col-lg-3 col-md-3 col-ms-12" >
                        <label for="from">Desde</label>
                        <input class="form-control" type="text" id="from" name="from">
                    </div>
                    <div class="col-lg-3 col-md-3 col-ms-12" >
                        <label for="to">hasta</label>
                        <input type="text"  class="form-control" id="to" name="to">
                    </div>
                    <div class="col-lg-2 col-md-3 col-ms-12" >
                        <label for="to">Estado </label>
                        <button type="submit"  class="form-control btn-success" id="btn_state">Activo</button>
                        
                    </div>

                    <div class="col-lg-2 col-md-3 col-ms-12" >
                    <label for="to">Acción </label>
                        <button type="submit"  class="form-control btn-primary" id="btn_publication"> Publicar </button>
                    </div>
                </div>

                <div class="my-5">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-charges" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Postulante</th>
                                    <th>Estado</th>
                                    <th>Deshabilitar</th>
                                    <th>Eliminar</th>
                                </tr>
                                </thead>
                            </table>
                            </div>
                </div>



            </div>
      </div>

    <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Lista de notificaciones de empleos recibidas
            </div>
            <div class="card-body">
                  <div class="table-responsive">
                      <table class="table table-bordered" id="table-notifications" width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th>Ingreso</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Telefono</th>
                            <th>Email</th>
                            <th>Postulación</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
            </div>
      </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="modal_create_charge" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Agregar cargo</h5>
        <button type="button" class="close"  data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-sm"> <p id="UserModalInfo"></p></div>
        </div>
      
        <div class="form-group">
                
                        <div class="row">
                              <div class="col-md-6 mb-3">
                                    <label for="actividad">Nombre del cargo</label>
                                        <input type="text" class="form-control"  name="name_charge" id="name_charge" placeholder="Ingrese nombre de cargo">
                                        <div class="invalid-feedback "></div> 
                              </div>
                          </div>
                         
                          <div class="form-group float-right">
                              <button type="button" id="save_charge" class="btn btn-primary">Guardar</button>
                          </div>
                      
  
        </div>
    </div>
  </div>
</div>
</div>



<div class="modal fade bd-example-modal-lg" id="section_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Editar sección</h5>
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
       
              <div class="row">
                  <div class="col-md-6 mb-3">
                        <label for="actividad">Item</label>
                        <div div class="input-group" id="frm_name2">
                            <input type="text" class="form-control"  name="name" id="item_section"  readonly>
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                  <div class="col-md-6 mb-3">
                        <label for="actividad">Título</label>
                        <div div class="input-group" id="frm_name2">
                            <input type="text" class="form-control"  name="name" id="title-section" placeholder="Ingrese título">
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                  <div class="col-md-12 mb-3 desc_section">
                        <label for="actividad">Descripción de sección</label>
                        <div div class="input-group" id="frm_name2">
                            <textarea type="text" class="form-control"  name="name" id="description-section" placeholder="Ingrese descripción"></textarea>
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                 
                </div>
                <div class="row">

                  <form  id= "image_section" >

                   <div class="col-md-12 mb-3">
                      <label for="actividad">Cargar imagen:</label>
                      <div class="form-group " id="frm_foto">
                          <div class= "custom-input" >
                              <input type="file"  data-preview-file-type="any" name="file-section" id="file-section">
                              <label  for="file_e">Elegir imagen</label>
                         <!-- <label class="custom-file-label" for="file_e">Elegir imagen</label>-->
</form>
                          </div>
                      </div>
                   <div class="form-group float-right">
                       <button type="button" id="update_section_btn" class="btn btn-primary">Guardar</button>
                  </div>
                
                </div>
                </div>
                </div>
        </div>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="not_image_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar sección</h5>
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
       
              <div class="row">
                  <div class="col-md-6 mb-3">
                        <label for="actividad">Item</label>
                        <div div class="input-group" id="frm_name2">
                            <input type="text" class="form-control"  name="name" id="item_not_image"  readonly>
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                  <div class="col-md-6 mb-3">
                        <label for="actividad">Título</label>
                        <div div class="input-group" id="frm_name2">
                            <input type="text" class="form-control"  name="name" id="title-not-image" placeholder="Ingrese título">
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                  <div class="col-md-12 mb-3 desc_display" >
                        <label for="actividad">Descripción de sección</label>
                        <div div class="input-group" id="frm_name2">
                            <textarea type="text" class="form-control"  name="name" id="title-not-image" placeholder="Ingrese descripción"></textarea>
                            <div class="invalid-feedback "></div>
                        </div>
                        
                  </div>
                 
                </div>
                <div class="row">
                
                   <div class="col-md-12 mb-3 ">
                    
                   <div class="form-group float-right">
                       <button type="button" id="edit-not-image" class="btn btn-primary">Guardar</button>
                  </div>
                </div>
                </div>
                </div>
        </div>
    </div>
  </div>
</div>





<script src="<?php echo base_url(); ?>assets/js_admin/adminEmploy.js"></script>


    

