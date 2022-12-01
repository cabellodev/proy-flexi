$(() => {
    get_slide();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

let id_supplier=0;
const tabla = $("#table-suppliers").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [3]},
		{className: "text-center", "targets": [4]}
    ],
	columns: [
		{ data: "name" },
      
		{ data: "url",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/slide/"+binary+'" width="200" heigth="200"/>';
          } 
        },
        { data: "state",
        render: function(data){
                let msg="";
                data ==1 ? msg="Habilitado": msg="Dehabilitado";
                return msg;
        } 
      },
      
        
		
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='stateButton' class='btn btn-danger'>
                                    Deshabilitar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
        {
			defaultContent: `<button type='button' name='deleteButton' class='btn btn-danger'>
                                    Eliminar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});

$("#table-suppliers").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar imagen`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar la imagen: "${data.name}"? `,
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
				delete_slide(data.id);
			} else {
				swal.close();
			}
		});
	}else if($(this)[0].name == "editButton"){
		id_supplier=data.id;
		$("#name-edit").val(data.name);
		$("#file-edit").val('');
      $("#edit_supplier_modal").modal('show');
	}else if($(this)[0].name == "stateButton"){
        swal({
			title: `Deshabilitar/Habilitar imagen`,
			icon: "warning",
			text: `¿Está seguro/a que desea deshabilitar/habilitar imagen: "${data.name}"? `,
			buttons: {
				confirm: {
					text: "Aceptar",
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
			       des_hab_slide(data.id,data.state);
			} else {
				swal.close();
			}
		});

    }
});



get_slide = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/slide',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable(result);
			}
        ,
        error: (msg)=>{
            datatable(0);
    }})
}

create_slide = () => {
	event.preventDefault();
	let files = $("#file")[0].files;

	let data = {
		name: $("#name").val(),
	};

	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/create/slide",
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
}


edit_slide = () => {
	event.preventDefault();
	

	let data = {
		id:id_supplier,
		name: $("#name-edit").val(),
	};

	
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/edit/slide",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
		
			let id_image = result.id;
			up_file_edit(id_image);
		},
		error: (result) => {
		    
			swal({
				title: "Error",
				icon: "error",
				text: result.responseJSON.msg,
			})
		}
				
	});


}



up_file = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/home/up/slide/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado la imagen con éxito ",
				button: "OK",
			}).then(() => {
				get_slide();
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


up_file_edit = (id_image) => {
  
	$.ajax({
		data: new FormData(document.getElementById("image-edit")),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/home/up/slide/edit/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado la imagen con éxito ",
				button: "OK",
			}).then(() => {
				get_slide();
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



delete_slide = (id_supplier)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/slide/${id_supplier}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_slide();
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



des_hab_slide= (id_slide , state )=>{

    state == 1 ? state=0:state=1;
    data = { state: state, id:id_slide}
  
    $.ajax({
		type: "POST",
        data: {data},
		url: host_url + `api/home/changeState/slide`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_slide();
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


datatable = (suppliers)=>{
    tabla.clear();
	tabla.rows.add(suppliers);
	tabla.draw();

}


$("#create_supplier_btn").on('click',create_slide);
$("#edit_supplier_btn").on('click',edit_slide);