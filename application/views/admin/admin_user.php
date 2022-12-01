<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Usuarios administradores</li>
    </ol>

   
        <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
                Lista de usuarios administradores
                <button class="btn btn-dark float-right" type='button' data-toggle="modal" id="btn" data-target="#modal_user"><i class="fas fa-plus"></i> Crear usuario</button>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="list_user" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Rut</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Nivel de usuario</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Des/Habilitar</th>
                      </tr>
                    </thead>
                  </table>
                </div>
              </div>
          </div>
     </div>
</div>
    <!-- Modal Agregar y Editar Empresa -->
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="titulo">Crear Usuario</h5>
                    <button type="button" class="close" onclick="close_modal_user()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <form>
                    <div class="form-group" id="frm_rut">
                        <label>Rut</label>
                        <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese rut">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group" id="frm_passwd" > 
                        <label>Contraseña</label> 
                        <input type="password" class="form-control"  id="passwd" name="passwd" placeholder="Ingrese contraseña">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group" id="frm_full_name">
                        <label>Nombre Completo</label>
                        <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Ingrese nombre">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group" id="frm_email"> 
                        <label>Correo electrónico</label> 
                        <input type="email" class="form-control"  id="email" name="email" placeholder="Ingrese correo electrónico" >
                        <div class="invalid-feedback"></div>
                    </div>                 
                    <div class="form-group" id="frm_range">
                        <label>Nivel de usuario</label>
                        <select class="form-select form-control" id="range" name="range" >
                            <option></option>
                        </select>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="form-group" id="frm_state" style="display: none">
                        <label>Estado</label>
                        <input type="text" class="form-control" id="state" name="state" readonly>
                    </div>
                    <div class="form-group float-right">
                        <button onclick="close_modal_user()" type="button" class="btn btn-secondary btn-danger">Cerrar</button>
                        <button id="btn_ok" type="button" class="btn btn-primary btn-success">Crear usuario</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    
  
</div>



<script src="<?php echo base_url(); ?>assets/js_admin/user.js"></script>
<script src="<?php echo base_url(); ?>assets/js/rut.js"></script>