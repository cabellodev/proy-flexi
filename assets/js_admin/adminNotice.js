$(() => {
    get_notices();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

let id_notice=0;

const tabla = $("#table-notices").DataTable({
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
		{ data: "image",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/notices/"+binary+'" width="200" heigth="200"/>';
          } 
        },
		
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
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

$("#table-notices").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar aviso`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar el aviso: "${data.name}"? `,
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
				delete_notice(data.id);
			} else {
				swal.close();
			}
		});
	} if ($(this)[0].name == "editButton") {
		id_notice=data.id;
		
		$("#edit_notice_modal").modal('show');
		$("#name-edit").val(data.name);
	}
});



get_notices = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/notices',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			    datatable(result);
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

create_notice = () => {
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
		url: host_url + "api/home/create/notices",
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



edit_notice = () => {
	event.preventDefault();
	

	let data = {
		id: id_notice,
		name: $("#name-edit").val(),
	
	};
	console.log(data);

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/update/notices",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la noticia con éxito ",
				button: "OK",
			}).then(()=>{
                $('#edit_notice_modal').modal('hide');
				get_notices();

			})
			
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
		url: `${host_url}api/home/up/notices/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el proveedor con éxito ",
				button: "OK",
			}).then(() => {
				get_notices();
				$('#file').val('');
				$('#create_notice_modal').modal('hide');
		
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



delete_notice = (id_supplier)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/notices/${id_supplier}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_notices();
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


$("#create_notice_btn").on('click',create_notice);
$("#edit_notice_btn").on('click',edit_notice);