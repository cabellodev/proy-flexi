$(() => {
    get_services();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});


const tabla = $("#table-services").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [
		{ data: "name" },
		{ data: "url",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/services_home/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		{ data: "state",
          render: function(data){
              if(data ==1){ return 'Habilitado';}else{ return 'Dehabilitado';};
      
          } 
        },
		
		{
			defaultContent: `<button type='button' name='edit-service' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='state-service' class='btn btn-danger'>
                                    Deshabilitar /Habilitar 
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
        {
			defaultContent: `<button type='button' name='delete-service' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});
let id_service=0;
let edit= false;
$("#table-services").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "delete-service") {
		swal({
			title: `Eliminar servicio`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar el servicio: "${data.name}"? (esta opción eliminará todos lo asociado a este servicio)`,
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
				delete_service(data.id_service);
			} else {
				swal.close();
			}
		});
	} else if ($(this)[0].name == "edit-service") {
                 id_service = data.id_service;
				 console.log(id_service);
				 edit= true;
                 $('#name-edit').val(data.name);
				 $('#titlex-edit').val(data.title);
				 $('#file-edit').val('');
				 $('#edit_modal_service').modal('show');


	}else if ($(this)[0].name == "state-service") {

		swal({
			title: `Deshabilitar /Habilitar servicio`,
			icon: "warning",
			text: `¿Está seguro/a que desea cambiar estado del servicio: "${data.name}"? (implica suspención momentanea del servicio y sus datos asociados como galerias , descripciones , etc)`,
			buttons: {
				confirm: {
					text: "Deshabilitar /Habilitar",
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
				change_state(data.id_service, data.state);
			} else {
				swal.close();
			}
		});
		


}
});



get_services = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/services',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable(result);
			}
        ,
        error: (msg)=>{
			datatable(0);
        }
    })
}


create_service = ()=> {

    let files = $("#file")[0].files;
    let data = { name:$('#name').val(), title:$('#titlex').val(),}
  
    if(files.length > 0){

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/home/create/service',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            let id_image = result.id;
			up_file(id_image);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al obtener el servicio",
			});
        }
    });
}else{
    swal({
        title: "Atención",
        icon: "warning",
        text: "Cargue el archivo de imagen por favor.",
    });

}
}


edit_service = ()=> {

    let files = $("#file-edit")[0].files;
    let data = { id:id_service, name:$('#name-edit').val(), title:$('#titlex-edit').val(),}
  


    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/home/update/service',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
          
			up_file(id_service);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al realizar la actualización de servicio.",
			});
        }
    });

}


up_file = (id_image) => {
	let form ;
    if(edit){ form = document.getElementById("image-edit") }else {form =document.getElementById("image")}
	$.ajax({
		data: new FormData(form),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/home/up/image/edit/service/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "El servicio se ha registrado con éxito ",
				button: "OK",
			}).then(() => {
				get_services();
				$('#file').val('');
				$('#create_supplier_modal').modal('hide');
		
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








delete_service = (id_service)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/service/${id_service}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_services();
            });
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar el servicio.",
			});
        }
    })
}


change_state= (id_service,state)=> {
	let new_state;
	state == 1? new_state = 0: new_state=1 ;
	data = {id:id_service ,state:new_state};
	console.log(data);
   $.ajax({
	   data:{data},
	   type: "POST",
	   url: host_url + `api/home/state/service`,
	   crossOrigin: false,
	   dataType: "json",
	   success: (result) => {
		   swal({
			   title: "Exito",
			   icon: "success",
			   text: "El servicio ha cambiado de estado con éxito.",
		   }).then(()=>{
				
				get_services();
		   });
		   }
	   ,
	   error: (msg)=>{
		   swal({
			   title: "Error",
			   icon: "error",
			   text: "Error al obtener los servicios",
		   });
	   }
   })
}

datatable = (services)=>{
    tabla.clear();
	tabla.rows.add(services);
	tabla.draw();

}

//$('#create_service_btn').on('click',create_service);
$('#modal_service').on('click',()=>{
	$('#create_modal_service').modal('show');
});

$('#create_service_btn').on('click',()=>{  edit = true ;create_service();});
$('#edit_service_btn').on('click',edit_service);
