<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Proveedores</li>
    </ol>

    

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de proveedores
        <button class="btn btn-success float-right" type='button' data-toggle="modal" data-target="#create_supplier_modal" id="btn_create_supplier"><i class="fas fa-plus"></i> Agregar proveedor</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-suppliers" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Estado</th>
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

<div class="modal fade bd-example-modal-lg" id="create_supplier_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title">Agregar proveedor</h5>
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
                    <label for="actividad">Nombre del proveedor</label>
                    <div div class="input-group" id="frm_name2">
                        <input type="text" class="form-control"  name="name" id="name" placeholder="Ingrese nombre">
                        <div class="invalid-feedback "></div>
                    </div>
              </div>
            </div>
            <div class="row float-right">
                <div class="form-group float-right">
                  <button type="button" id="close" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                  <button type="button" id="create_supplier_btn" onclick="save()" class="btn btn-primary">Guardar</button>
                </div>
            </div>
          </div>
        </div>
      </div>
  </div>
</div>



<script src="<?php echo base_url(); ?>assets/js_admin/adminPurveyor.js"></script>