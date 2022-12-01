<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Servicios</li>
    </ol>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de servicios ( HOME )
        <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#addComponent" id="modal_service"><i class="fas fa-plus"></i> Agregar servicio</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-services" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Imagen</th>
                <th>Estado</th>
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

<div class="modal fade bd-example-modal-lg" id="create_modal_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Crear servicio</h5>
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
          <form id="image">
              <div class="row">
                  <div class="col-md-6" id="frm_name">
                      <label>Nombre de servicio</label>
                      <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese nombre de servicio">
                      <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-6" id="frm_name">
                      <label>Breve descripción </label>
                      <textarea type="text" class="form-control" id="titlex" name="title" placeholder="Ingrese breve descripción"></textarea>
                      <div class="invalid-feedback"></div>
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
                        
                          <div class="form-group float-right">
                              <button type="button" id="create_service_btn" class="btn btn-primary">Guardar</button>
                          </div>

                      </div>
                    </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>



<div class="modal fade bd-example-modal-lg" id="edit_modal_service" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Crear servicio</h5>
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
          <form id="image-edit">
              <div class="row">
                  <div class="col-md-6" id="frm_name">
                      <label>Nombre de servicio</label>
                      <input type="text" class="form-control" id="name-edit" name="name-edit" placeholder="Ingrese nombre de servicio">
                      <div class="invalid-feedback"></div>
                  </div>
                  <div class="col-md-6" id="frm_name">
                      <label>Breve descripción </label>
                      <textarea type="text" class="form-control" id="titlex-edit" name="title-edit" placeholder="Ingrese breve descripción"></textarea>
                      <div class="invalid-feedback"></div>
                  </div>
              </div>
              <div class="row">
              <div class="col-md-12 mb-3">
                      
                      <label for="actividad">Cargar imagen:</label>
                      <div class="form-group " id="frm_foto">
                          <div class= "custom-input" >
                              <input type="file"  data-preview-file-type="any" name="file-edit" id="file-edit">
                              <label  for="file_e">Elegir imagen</label>
                            <!-- <label class="custom-file-label" for="file_e">Elegir imagen</label>-->
                              </form>
                          </div>
                        
                          <div class="form-group float-right">
                              <button type="button" id="edit_service_btn" class="btn btn-primary">Guardar</button>
                          </div>

                      </div>
                    </div>
              </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/adminService.js"></script>
