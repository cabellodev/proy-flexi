$(() => {
    document.getElementById('1_image_add').addEventListener('change', addImage1, false);
    document.getElementById('2_image_add').addEventListener('change', addImage2, false);
    document.getElementById('3_image_add').addEventListener('change', addImage3, false);
    document.getElementById('image_header_add').addEventListener('change', addImageHeader, false);
    getFields();
});

function addImage1(evt) {
        let files = evt.target.files; // FileList object
      //Obtenemos la imagen del campo "file". 
      for (var i = 0, f; f = files[i]; i++) {         
         //Solo admitimos imágenes.
         if (!f.type.match('image.*')) {
              continue;
         }
     
         let reader = new FileReader();
         
         reader.onload = (function(theFile) {
             return function(e) {
             // Creamos la imagen.
                  $("#1_image").attr("src", e.target.result);
                  $("#control_image1").val('1');
                   /*  document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join(''); */
             };
         })(f);

         reader.readAsDataURL(f);
     }
}

function addImage2(evt) {
    let files = evt.target.files; // FileList object
  //Obtenemos la imagen del campo "file". 
  for (var i = 0, f; f = files[i]; i++) {         
     //Solo admitimos imágenes.
     if (!f.type.match('image.*')) {
          continue;
     }
 
     let reader = new FileReader();
     
     reader.onload = (function(theFile) {
         return function(e) {
         // Creamos la imagen.
              $("#2_image").attr("src", e.target.result);
              $("#control_image2").val('1');
               /*  document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join(''); */
         };
     })(f);

     reader.readAsDataURL(f);
 }
}

function addImage3(evt) {
    let files = evt.target.files; // FileList object
  //Obtenemos la imagen del campo "file". 
  for (var i = 0, f; f = files[i]; i++) {         
     //Solo admitimos imágenes.
     if (!f.type.match('image.*')) {
          continue;
     }
 
     let reader = new FileReader();
     
     reader.onload = (function(theFile) {
         return function(e) {
         // Creamos la imagen.
              $("#3_image").attr("src", e.target.result);
              $("#control_image3").val('1');
               /*  document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join(''); */
         };
     })(f);

     reader.readAsDataURL(f);
 }
}

function addImageHeader(evt) {
    let files = evt.target.files; // FileList object
  //Obtenemos la imagen del campo "file". 
    for (var i = 0, f; f = files[i]; i++) {         
     //Solo admitimos imágenes.
     if (!f.type.match('image.*')) {
          continue;
     }
 
     let reader = new FileReader();
     
     reader.onload = (function(theFile) {
         return function(e) {
         // Creamos la imagen.
              $("#image_header").attr("src", e.target.result);
               /*  document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join(''); */
         };
     })(f);

     reader.readAsDataURL(f);
 }
}



$("#1_image_delete").on("click", () => {
    console.log( $('#1_image_add').val);
    $("#1_image").attr("src", host_url+"assets/images/products/image_first/noimage.png");
    $("#control_image1").val('0');
    $("#1_image_add").val(null);
});

$("#2_image_delete").on("click", () => {
    $("#2_image").attr("src", host_url+"assets/images/products/image_first/noimage.png");
    $("#control_image2").val('0');
    $("#2_image_add").val(null);
});

$("#3_image_delete").on("click", () => {
    $("#3_image").attr("src", host_url+"assets/images/products/image_first/noimage.png");
    $("#control_image3").val('0');
    $("#3_image_add").val(null);
});

$("#image_header_add").change(function() {
    let id = 'image_header_add';
    validateImage(id);
});

$("#1_image_add").change(function() {
    let id = '1_image_add';
    validateImage(id);
  });

$("#2_image_add").change(function() {
let id = '2_image_add';
validateImage(id);
});

$("#3_image_add").change(function() {
    let id = '3_image_add';
    validateImage(id);
});


$("#code").change(() => { 
	let code = $("#code").val();
	if(code){
		$("#frm_code > input").removeClass("is-invalid");
	}else{
        $("#frm_code > div").html('El código del producto es requerido.');
		$("#frm_code > input").addClass("is-invalid");
	}
});

$("#name").change(() => { 
	let name = $("#name").val();
	if(name){
		$("#frm_name > input").removeClass("is-invalid");
	}else{
        $("#frm_name > div").html('La nombre del producto es requerido.');
		$("#frm_name > input").addClass("is-invalid");
	}
});

$("#model").change(() => { 
	let model = $("#model").val();
	if(model){
		$("#frm_model > input").removeClass("is-invalid");
	}else{
		$("#frm_model > input").addClass("is-invalid");
	}
});

$("#price").change(() => { 
	let price = $("#price").val();
	if(price){
		$("#frm_price > input").removeClass("is-invalid");
	}else{
        $("#frm_price > div").html('El precio del producto es requerido.');
		$("#frm_price > input").addClass("is-invalid");
	}
});

$("#supplier").change(() => { 
	let supplier = $("#supplier").val();
	if(supplier){
		$("#frm_supplier > select").removeClass("is-invalid");
	}else{
        $("#frm_supplier > div").html('El proveedor del producto es requerido.');
		$("#frm_supplier > select").addClass("is-invalid");
	}
});

$("#category").change(() => { 
	let category = $("#category").val();
	if(category){
		$("#frm_category > select").removeClass("is-invalid");
	}else{
        $("#frm_category > div").html('La categoria del producto es requerida.');
		$("#frm_category > select").addClass("is-invalid");
	}
});

errorsDescrName = (id) =>{
    let name = $("#descr_name_"+id).val();
	if(name){
		$("#frm_descr_name_"+id+" > input").removeClass("is-invalid");
	}else{
		$("#frm_descr_name_"+id+" > input").addClass("is-invalid");
	}
}

errorsDescrDetail = (id) =>{
    let detail = $("#descr_detail_"+id).val();
	if(detail){
		$("#frm_descr_detail_"+id+" > textarea").removeClass("is-invalid");
	}else{
		$("#frm_descr_detail_"+id+" > textarea").addClass("is-invalid");
	}
}

let suppliers = []; /*Variable que almacenara los proveedores*/
let category = []; /*Variable que almacenara las categorias*/
let subCategory = []; /*Variable que almacenara las subcategorias*/
let subSubCategory = []; /*Variable que almacenara las subsubcategorias*/
let id_descr = []; /*Variable que almacenara los id dinamicos de las descripciones*/
let currentCode = '';
let currentImage = '';
let paths = window.location.pathname.split('/');
let id_product = paths[paths.length-1];
let currentImage1 = '';
let currentImage2 = '';
let currentImage3 = '';


/*Funcion para recuperar los datos para ingresar un producto*/
getFields = () => {
    let url = window.location.pathname;
    let id = url.substring(url.lastIndexOf('/') + 1);
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}/api/home/product/getFieldsUpdate/${id}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
            if(suppliers.length == 0){
                xhr.response[0].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.name);
                    $(option).html(u.name); 
                    $(option).appendTo("#supplier");
                    suppliers.push(u.name);
                });
            } 

            if(category.length == 0){
                xhr.response[1].map((u) => {
                    let option = document.createElement("option"); 
                    $(option).val(u.id); 
                    $(option).attr('name', u.name);
                    $(option).html(u.name); 
                    $(option).appendTo("#category");
                    category.push(u.name);
                });
            } 

            if(subCategory.length == 0){
                subCategory.push(xhr.response[2]);
            };
             

            if(subSubCategory.length == 0){
                subSubCategory.push(xhr.response[3]);
            };
           
            if(xhr.response[4]){
                let u = xhr.response[4];
                if(u.code){$('#code').val(u.code); currentCode = u.code;}
                if(u.name){$('#name').val(u.name);}
                if(u.price){$('#price').val(u.price);}
                if(u.stock){$('#stock').val(u.stock);}
                if(u.supplier){$('#supplier').val(u.supplier);} 
                if(u.model){$('#model').val(u.model);} 
                
                if(u.category){
                    $('#category').val(u.category);

                    if(u.subcategory){
                        subCategory[0].map((c) => {
                            if(c.category_id == u.category){
                                let option = document.createElement("option"); 
                                $(option).val(c.id); 
                                $(option).attr('name', c.name);
                                $(option).html(c.name); 
                                $(option).appendTo("#subCategory");
                            }
                        });
                        $('#subCategory').val(u.subcategory);

                        if(u.subsubcategory){
                            subSubCategory[0].map((sb) => {
                                if(sb.subcategory_id == u.subcategory){
                                    let option = document.createElement("option"); 
                                    $(option).val(sb.id); 
                                    $(option).attr('name', sb.name);
                                    $(option).html(sb.name); 
                                    $(option).appendTo("#subSubCategory");
                                }
                            });
                            $('#subSubCategory').val(u.subsubcategory);
                        }
                    };

                }
                if(u.images){
                    let images = JSON.parse(u.images);
                    console.log(images);

                    if(images[0]['imagen1']){
                        console.log(images[0]['imagen1']);
                        $("#1_image").attr("src", host_url+"assets/images/products/"+images[0]['imagen1']);
                        $("#control_image1").val('1');
                        currentImage1 = images[0]['imagen1'];
                    }else{
                        $("#1_image").attr("src", host_url+"assets/images/products/noimage.png");
                        $("#control_image1").val('0');
                    }

                    if(images[1]['imagen2']){
                        $("#2_image").attr("src", host_url+"assets/images/products/"+images[1]['imagen2']);
                        $("#control_image2").val('1');
                        currentImage2 = images[1]['imagen2'];
                    }else{
                        $("#2_image").attr("src", host_url+"assets/images/products/noimage.png");
                        $("#control_image2").val('0');
                    }
                    

                    if(images[2]['imagen3']){
                        $("#3_image").attr("src", host_url+"assets/images/products/"+images[2]['imagen3']);
                        $("#control_image3").val('1');
                        currentImage3 = images[2]['imagen3'];
                    }else{
                        $("#3_image").attr("src", host_url+"assets/images/products/noimage.png");
                        $("#control_image3").val('0');
                    }
                    
                };

                if(u.description){
                    description = JSON.parse(u.description);
                    if(id_descr.length == 0){
                        $.each(description, function(i, item) {
                            let init = "<div id ='descr_product_"+(i+1)+"' class='row mb-2'>";
                            let name = "<div class='col-md-2'><label>Caracteristica</label><div class='input-group' id='frm_descr_name_"+(i+1)+"'><input type='text' value='"+item.name+"' class='form-control' onchange='errorsDescrName("+(i+1)+")' id='descr_name_"+(i+1)+"'><div class='invalid-feedback'></div></div></div>";

                            
                            
                            let descr = "<div class='col-md-9'><label>Detalle</label><div class='input-group' id='frm_descr_detail_"+(i+1)+"'><textarea class='form-control' onchange='errorsDescrDetail("+(i+1)+")' id='descr_detail_"+(i+1)+"' rows='1'>"+item.detail+"</textarea><div class='invalid-feedback'></div></div></div>";
                            let minus = "<div class='col-md-1'><label></label><div class='col-sm row justify-content-md-left'><button class='btn btn-danger rounded-circle' id='descr_btn_delete_"+(i+1)+"' onclick='deleteFields("+(i+1)+")'><i class='fas fa-minus'></i></button></div></div>";
                            let end = "</br></div>";
                            let description = init+name+descr+minus+end;
                            $(description).appendTo("#descr_product"); 
                            id_descr.push(i+1);
                        });
                    }
                }

                if(u.image_first){
                    $("#image_header").attr("src", host_url+"assets/images/products/image_first/"+u.image_first);
                };
            }
		} else {
			swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener la información",
			});
		}
	});
	xhr.send();
};

$("#category").change(() => { 
	let id_category = $("#category").val();

    /*Limpiar select */
    $('#subCategory').empty().append('<option></option>');
    $('#subSubCategory').empty().append('<option></option>');

	subCategory[0].map((u) => {
        if(u.category_id == id_category){
            let option = document.createElement("option"); 
            $(option).val(u.id); 
            $(option).attr('name', u.name);
            $(option).html(u.name); 
            $(option).appendTo("#subCategory");
        }
    });
  /*   $('#subCategory').prop('disabled', false); */
});

$("#subCategory").change(() => { 
	let id_subCategory = $("#subCategory").val();

    /*Limpiar select */
    $('#subSubCategory').empty().append('<option></option>');

	subSubCategory[0].map((u) => {
        if(u.subcategory_id == id_subCategory){
            let option = document.createElement("option"); 
            $(option).val(u.id); 
            $(option).attr('name', u.name);
            $(option).html(u.name); 
            $(option).appendTo("#subSubCategory");
        }
    });
  /*   $('#subSubCategory').prop('disabled', false); */
});

createFields = () =>{
    let cont; /* Mi contador obtendra el ultimo valor de id creciente */ 
    if(id_descr.length > 0){
        cont = Math.max(...id_descr)+1;
    }else{
        cont =1;
    }

    let init = "<div id ='descr_product_"+cont+"' class='row mb-2'>";
    let name = "<div class='col-md-2'><label>Caracteristica</label><div class='input-group' id='frm_descr_name_"+cont+"'><input type='text' class='form-control' name='name' onchange='errorsDescrName("+cont+")' id='descr_name_"+cont+"'><div class='invalid-feedback'></div></div></div>";
    let descr = "<div class='col-md-9'><label>Detalle</label><div class='input-group' id='frm_descr_detail_"+cont+"'><textarea class='form-control' onchange='errorsDescrDetail("+cont+")' id='descr_detail_"+cont+"' rows='1'></textarea><div class='invalid-feedback'></div></div></div>";
    let minus = "<div class='col-md-1'><label></label><div class='col-sm row justify-content-md-left'><button class='btn btn-danger rounded-circle' id='descr_btn_delete_"+cont+"' onclick='deleteFields("+cont+")'><i class='fas fa-minus'></i></button><div class='invalid-feedback'></div></div></div>";
    let end = "</br></div>";
    let description = init+name+descr+minus+end;
    $(description).appendTo("#descr_product"); 
    id_descr.push(cont);
};

deleteFields = (id) => {
    /* Retorna el mismo arreglo que contiene los id pero eliminando el id q se desea eliminar */
    id_descr = jQuery.grep(id_descr, function(value) {
        return value != id;
    });

    $('#descr_product_'+id).remove();
}

saveProduct = () =>{

    let description = [];
    let errors_descr = [];
    let state = 0;

    /* Recuperar los datos de los detalles de la descripcion */
    if(id_descr){
        if(id_descr.length==0)id_descr = []; else{
            for(i=0; i<(id_descr).length; i++){
                let name = $('#descr_name_'+id_descr[i]).val();
                let detail = $('#descr_detail_'+id_descr[i]).val();
                if(name && detail){
                    description.push({
                        "name" : name, 
                        "detail" : detail,  
                    });
                }else if(detail && !name){
					state = 1;
                    id = i+1;
                    errors_descr.push({
                        id : id,
                        error: 'name'
                    });

				}else if((!detail && name)){
                    state = 1;
                    id = i+1;
                    errors_descr.push({
                        id : id,
                        error: 'detail'
                    });
                }
                console.log(description);
            }
        }
    }
    

    if(description.length == 0) description = null;
  
    data = {
        id: id_product,
        code: $('#code').val(),
        name: $('#name').val(),
        stock : $('#stock').val(),
        price: $('#price').val(),
        model : $('#model').val(),
        supplier : $('#supplier').val(),
        description : description,
        category : $('#category').val(),
        subCategory : $('#subCategory').val(),
        subSubCategory : $('#subSubCategory').val(),
        currentCode: currentCode,
        state_descr : state
    };

  
    $.ajax({
        type: "POST",
        url: host_url + "api/home/update/product",
        data: {data},
        crossOrigin: false,
        dataType: "json",
        success: (result) => { 
                let save_imagep = up_imagep();
                let save_images = up_images();

                if(save_images == true && save_imagep == true) {
                    swal({
						title: "Exito!",
						icon: "success",
						text: "Se ha creado el producto con éxito ",
						button: "OK",
					}).then(() => {
                        window.location.href = `${host_url}product/products`;
					});
                }else{	
                    swal({
                        title: "Error",
                        icon: "error",
                        text: "Fallo al cargar el servicio",
                    }).then(() => {
                        window.location.href = `${host_url}api/home/adminCreate/product`;
					});
                }  
        }, 
        statusCode: {
        400: (xhr) => {

            let msg = xhr.responseJSON.msg;
            console.log(msg);
            swal({
                title: "Error",
                icon: "error",
                text: "Por favor corrige los errores de este formulario",
            }).then(() => {
                if(msg.code){$("#frm_code > div").html(msg.code); $("#frm_code > input").addClass("is-invalid");}
                if(msg.name){$("#frm_name > div").html(msg.name); $("#frm_name > input").addClass("is-invalid");}
                if(msg.model){$("#frm_model > div").html(msg.model); $("#frm_model > input").addClass("is-invalid");}
                if(msg.price){$("#frm_price > div").html(msg.price); $("#frm_price > input").addClass("is-invalid");}
                if(msg.supplier){$("#frm_supplier > div").html(msg.supplier); $("#frm_supplier > select").addClass("is-invalid");}
                if(msg.category){$("#frm_category > div").html(msg.category); $("#frm_category > select").addClass("is-invalid");}
            });
        },
        401: (xhr) =>{
            if(state == 1){ 
                swal({
                    title: "Error",
                    icon: "warning",
                    text: "Corriga los errores en el formulario",
                }).then(() => {
                    $.each(errors_descr, function(i, item) {
                        console.log(item);
                        if(item.error == 'name'){
                            $("#frm_descr_name_"+item.id+" > input").addClass("is-invalid");
                        }else if(item.error == 'detail'){
                            $("#frm_descr_detail_"+item.id+" > textarea").addClass("is-invalid");
                        }
                    });
                });
            }
        },
        405: (xhr) =>{
            let msg = xhr.responseJSON.msg;
            swal({
                title: "Error",
                icon: "error",
                text: msg,
            }).then(() => {
                $("#frm_code > input").addClass("is-invalid");
            });
        },
        },
        error: () => {
            swal({
                title: "Error",
                icon: "error",
                text: "No se pudo encontrar el recurso",
            }).then(() => {
                $("body").removeClass("loading");
            });
        },
    }); 
};

validateImage = (id) => {
    let id_image = id;
    let files =   $("#"+id_image)[0].files;
    let myImgType = files[0]["type"];
    let validImgTypes = ["image/gif", "image/jpeg", "image/png"];
        if ($.inArray(myImgType, validImgTypes) < 0) {
        swal({
            title: "Error",
            icon: "warning",
            text: "Ingrese un archivo tipo imagen",
        })
        }
};

up_imagep = () => {
    event.preventDefault();
    let foto = $("#image_header_add")[0].files;
    let flag = 0;
    if(foto.length > 0) {
        let formData = new FormData();
        formData.append('foto', foto[0]);
        
        $.ajax({
            type: "POST",
            url: `${host_url}api/home/update/product/up/imagep/${id_product}`,
            data: formData,
            contentType: false,
            processData: false,
            success: () => {
                flag = 1;
            },
            error: () => {
                flag = 0;
            },
        });
    }else{
        flag = 0;
    }
    if(flag == 1) return false; else if (flag == 0) return true; 
};

up_images = () => {
    event.preventDefault();
    let foto1 = $("#1_image_add")[0].files;
    let foto2 = $("#2_image_add")[0].files;
    let foto3 = $("#3_image_add")[0].files;

    let image1 = $("#control_image1").val();
    let image2 = $("#control_image2").val();
    let image3 = $("#control_image3").val();

    let flag = 0;

    let formData = new FormData();
    /* Hubo cambio de imagen  -> eliminar imagen y agregar la nueva*/
    if (foto1.length > 0) { 
        formData.append('foto1', foto1[0]);
        formData.append('foto1_url', currentImage1);
    }else{
        /* Significa que ya tenia imagen y no cambio -> no hacer nada en back*/ 
        if(image1 == 1){ 
            formData.append('foto1', '1');
            formData.append('foto1_url', currentImage1);
        }else if(image1 == 0){

            /* Tenia imagen y se elimino -> solo eliminar imagen */
            if(currentImage1){
                formData.append('foto1', '0');
                formData.append('foto1_url', currentImage1);
            }else{
                /* No tenia imagen y no se le agrego -> no hacer nada en back */
                formData.append('foto1', '2');
                formData.append('foto1_url', currentImage1);
            }
        }
    }

    if (foto2.length > 0) { 
        formData.append('foto2', foto2[0]);
        formData.append('foto2_url', currentImage2);
    }else{
        /* Significa que ya tenia imagen y no cambio */
        if(image2 == 1){ 
            formData.append('foto2', '1');
            formData.append('foto2_url', currentImage2);
        }else if(image2 == 0){

            /* Tenia imagen y se elimino */
            if(currentImage2){
                formData.append('foto2', '0');
                formData.append('foto2_url', currentImage2);
            }else{
                /* No tenia imagen y no se le agrego */
                formData.append('foto2', '2');
                formData.append('foto2_url', currentImage2);
            }
        }
    }

    if (foto3.length > 0) { 
        formData.append('foto3', foto3[0]);
        formData.append('foto3_url', currentImage3);
    }else{
        /* Significa que ya tenia imagen y no cambio */
        if(image3 == 1){ 
            formData.append('foto3', '1');
            formData.append('foto3_url', currentImage3);
        }else if(image3 == 0){

            /* Tenia imagen y se elimino */
            if(currentImage3){
                formData.append('foto3', '0');
                formData.append('foto3_url', currentImage3);
            }else{
                /* No tenia imagen y no se le agrego */
                formData.append('foto3', '2');
                formData.append('foto3_url', currentImage3);
            }
        }
    }
    
    $.ajax({
        type: "POST",
        url: `${host_url}api/home/update/product/up/images/${id_product}`,
        data: formData,
        contentType: false,
        processData: false,
        success: () => {
            flag = 1;
        }
        ,
        error: () => {
            flag = 0;
        },
    });
    
    if(flag == 1) return false; else if (flag == 0) return true;
};

$("#product_btn_add").on("click", createFields);
$("#btn_save").on("click", saveProduct);


