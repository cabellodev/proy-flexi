<div id="content-wrapper">
  <div class="container-fluid mb-5">

    <ol class="breadcrumb">
      <li class="breadcrumb-item active">Contactos</li>
    </ol>

    <div class="card mb-3">
      <div class="card-header">
        <i class="fas fa-table"></i>
        Secciónes Contactos
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
         Lista de sucursales
        <button class="btn btn-secondary float-right" type='button' data-toggle="modal" data-target="#create_contact_modal" id="btn_create_contact"><i class="fas fa-plus"></i> Agregar sucursal</button>
      </div>
      <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="table-contact" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Ciudad</th>
                <th>Teléfono</th>
                <th>Email</th>
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
  </div>
</div>


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


<div class="modal fade bd-example-modal-lg" id="create_contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Agregar sucursal</h5>
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
                                <label for="actividad">Sucursal</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="name" placeholder="Ingrese nombre">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Región</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="region" placeholder="Ingrese región">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>

                        <div class="col-md-6 mb-3">
                                <label for="actividad">Ciudad</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="city" placeholder="Ingrese ciudad">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Email</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="email" placeholder="Ingrese email">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Teléfono ( +569- Whatsapp)</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="phone" value="+569" placeholder="Ingrese teléfono">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Dirección</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="adress" placeholder="Coordenada La">
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
                            <button type="button" id="create_contact_btn" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
               </div>
        </div>
  </div>
</div>
</div>
</div>

<div class="modal fade bd-example-modal-lg" id="edit_contact_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog  modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">Editar sucursal</h5>
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
        <form  id= "image-edit">
              <div class="row">
                       <div class="col-md-6 mb-3">
                                <label for="actividad">Sucursal</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="name-edit" placeholder="Ingrese sucursal">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Región</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="region-edit" placeholder="Ingrese región">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>

                        <div class="col-md-6 mb-3">
                                <label for="actividad">Ciudad</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="city-edit" placeholder="Ingrese ciudad">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Email</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="email-edit" placeholder="Ingrese email">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Teléfono ( +569- Whatsapp)</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="phone-edit" value="+569" placeholder="Ingrese teléfono">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
                        </div>
                        <div class="col-md-6 mb-3">
                                <label for="actividad">Dirección</label>
                                <div div class="input-group" id="frm_name2">
                                    <input type="text" class="form-control"  name="name" id="adress-edit" placeholder="Dirección">
                                    <div class="invalid-feedback "></div>
                                </div>
                                
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
                        </div>
                        </form>
                        <div class="form-group float-right">
                            <button type="button" id="edit_contact_btn" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
               </div>

               
                 <!--  <div class="col-md-12 mb-3">
                      
                      <label for="actividad">Cargar imagen:</label>
                        <div class="form-group " id="frm_foto">
                            <div class= "custom-input" >
                            <input type="file"  data-preview-file-type="any" name="file" id="file">
                            <label  for="file_e">Elegir imagen</label>
                            <label class="custom-file-label" for="file_e">Elegir imagen</label>
                            </form>
                            </div>
                        </div>-->
                       
                  <!--  </div>-->
               
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
                <form  id= "image_section">
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
                            <textarea type="text" class="form-control"  name="name" id="desc-not-image" placeholder="Ingrese descripción"></textarea>
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








<script src="<?php echo base_url(); ?>assets/js_admin/adminContact.js"></script>