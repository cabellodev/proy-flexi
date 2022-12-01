
$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
    },
});

$(() => {
    get_gallery();
});

$("#name_e").change(() => { 
	let name = $("#name_e").val();
	if(name){
		$("#frm_name > input").removeClass("is-invalid");
	}else{
		$("#frm_name > input").addClass("is-invalid");
	}
});




const tabla = $('#table_images').DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
		{ "width": "15%", "targets": [2,3]},
		{ "width": "30%", "targets": 1 },
		{ "width": "5%", "targets": 0 },
		{ className: "text-center", "targets": [1,2,3,4]} ,
	  ],
	columns: [
    
        { data: "name" },
        { data: "url",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/gallery_services/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		
		{
            defaultContent: `<button type='button' name='btn_look' class='btn btn-success'>
                                 Ver 
								 <i class="fas fa-eye"></i>
                              </button>`,
		},
		{
            defaultContent: `<button type='button' name='btn_edit' class='btn btn-primary'>
                                  Editar 
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
            defaultContent: `<button type='button' name='btn_eliminar' class='btn btn-danger'>
                                  Eliminar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
	],
});

let id_service= 0;
let edit =  false;
$("#table_images").on("click", "button", function () {
    let data = tabla.row($(this).parents("tr")).data();
	
	if($(this)[0].name == "btn_look"){
	url = `${host_url}assets/images/gallery_services/${data.url}`;
	$('.imagepreview').attr('src',url);
		$('#show_image').modal('show');   
		//showImage(url);
	}else {
	    if($(this)[0].name == "btn_edit"){
		edit=true;
		console.log(edit);
		inputClear();
		$("#name").val(data.name);
		id_service=data.id;//ID image 
		$("#create_image_modal").modal("show");
		}else { 

			swal({
				title: `Eliminar imagen`,
				icon: "warning",
				text: `¿Está seguro/a de que desea eliminar esta imagen ?`,
				buttons: {
					confirm: {
						text: "Eliminar",
						value: "exec",
					},
					cancel: {
						text: "Cancelar",
						value: "cancelar",
						visible: true,
					},
				},
			}).then((action) => {
				if (action == "exec") {
					deleteImage(data.id);
				} else {
					swal.close();
				}
			});
          


		}
		
	}
    
});

get_gallery = () => {
	let id_service= $("#id_service").val();
	let xhr = new XMLHttpRequest();
	xhr.open("get", `${host_url}service/get/images/${id_service}`);
	xhr.responseType = "json";
	xhr.addEventListener("load", () => {
		if (xhr.status === 200) {
			let data = xhr.response;
			tabla.clear();
			tabla.rows.add(data);
			tabla.draw();
		
		} 
	});
	xhr.send();
};


deleteImage =(id)=> { 

	$.ajax({
		type: "POST",
		url: `${host_url}service/delete/image/${id}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Éxito",
				icon: "success",
				text: "La imagen se ha eliminado correctamente.",
			}).then(() => {
				get_gallery();
			});
			
		
		},
		error: (result) => {
		
			swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar la imagen.",
			})
		}
				
	});


}


create_image = () => {
	event.preventDefault();
	console.log("entre a crear");
	let files = $("#file")[0].files;

	let data = {
		id_service: $("#id_service").val(), // OT ID  
		name: $("#name").val(),
	
	};

	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "service/create/image",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			console.log(result.id);
			let id_image = result.id;
			up_file(id_image);
		},
		error: (result) => {
		    
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			})
		}
				
	});

}else{

	swal({
		title: "Error",
		icon: "error",
		text: "Cargue una imagen por favor."
	})

}
};


edit_image = () => {
	event.preventDefault();

    console.log("entre a edit");
	let data = {
		id: id_service, // OT ID  
		name: $("#name").val(),
	
	};


	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "service/edit/image",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
		
			let id_image = result.id;
			up_file(id_image);
		},
		error: (result) => {
		    
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			})
		}
				
	});


};

up_file = (id_image) => {
  

	$.ajax({
		data: new FormData(document.getElementById("image")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}service/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado la imagen con éxito ",
				button: "OK",
			}).then(() => {
				get_gallery();
				inputClear();
				swal.close();
				
		       // let url = 'adminImages'+'?ot='+ot;
		       // window.open(host_url+url);
			});
		},
		error: () => {
			swal({
				title: "Error",
				icon: "error",
				text: "Ha ocurrido un error",
			});
		},
	});
};

uploadMultiplesImage = () => {
    ot= $("#id").val();
	let files = $("#file")[0].files;

	if (files.length != 0){

	$.ajax({
		data: new FormData($("#foto")[0]),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/upMultiplesImage/${id}`,
		success: (result) => {
			
		swal({
				title: "Exito!",
				icon: "success",
				text: result.msg,
				button: "OK",
			}).then(() => {
				getImages();
				$('#auxiliar').text("");
				$("#label-file-create").removeClass("selected").html("Elegir imagenes");
				inputClear();
				swal.close();                     // let url = 'adminImages'+'?ot='+ot;
		                           // window.open(host_url+url);
			});
		},
		error: (result) => {
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			}).then(() => {
				getImages();
		});
	  },
	});
}else{
	swal({
		title: "Error",
		icon: "error",
		text: "Seleccione algun archivo por favor.",
	});
 }
};


inputClear = ()=> { 
	$("#name").val("");
	$("#file").val("");
}


$("#addImage").on('click', uploadMultiplesImage );
//$("#addImage").on('click', registerImagen);  Original

 
$("#file").on("change", function() {
	const totalFicheros = $(this).get(0).files.length;
    let mensaje = '';
    if (totalFicheros > 1) {
        mensaje = `${totalFicheros} ficheros seleccionados.`;
    } else {
        mensaje = "1 fichero seleccionado";
    }
   
    $('#auxiliar').text(mensaje);
});


$("#create_image_btn").on('click',()=>{
	if(edit){
		edit_image();
	}else{
		create_image();
	}

});

$("#modal_create").on('click',()=>{
	edit=false;
	console.log(edit);
	$("#create_image_modal").modal('show');

});





	
	
  








