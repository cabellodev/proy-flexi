<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Home/ Productos</li>
    </ol>

    

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
         Lista de Productos ( HOME )
        <button class="btn btn-success float-right" type='button' id="btn_addProduct"><i class="fas fa-plus"></i> Agregar Producto</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-productos" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Codigo</th>
                <th>Imagen</th>
                <th>Proveedor</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Categoria</th>
                <th>Sub-Categoria</th>
                <th>Sub-Sub-Categoria</th>
                <th>Editar</th>
                <th>Eliminar</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="<?php echo base_url(); ?>assets/js_admin/adminProduct.js"></script>
