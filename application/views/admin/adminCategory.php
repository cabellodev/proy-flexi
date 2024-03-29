<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Categorias</li>
    </ol>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de categorias
        <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#create_category_modal" id="btn_create_category"><i class="fas fa-plus"></i> Agregar categoria</button>
      </div>
      <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered" id="table-categories" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Estado</th>
                <!--  <th>Sub-categorias</th>-->
                  <th>Editar</th>
                  <th>Bloquear/Habilitar</th>
                </tr>
              </thead>
            </table>
          </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-lg" id="create_category_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Agregar categoria</h5>
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
                  <label for="actividad">Nombre de la Categoria</label>
                  <div div class="input-group" id="frm_name2">
                      <input type="text" class="form-control"  name="name" id="name" placeholder="Ingrese nombre">
                      <div class="invalid-feedback "></div>
                  </div>               
              </div>
            </div>
            <div class="row">
              <div class="col-md-12 mb-3">
                <div class="form-group float-right">
                  <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" id="create_category_btn" onclick="save()" class="btn btn-primary">Guardar</button>
                </div>  
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/adminCategory.js"></script>