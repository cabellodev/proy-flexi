$(() => {
    get_supplier();
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
		{ data: "image",
          render: function(data){
              binary = data;
              return '<img src="'+host_url+"assets/images/supplier/"+binary+'" width="200" heigth="200"/>';
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
			title: `Eliminar proveedor`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar el proveedor: "${data.name}"? `,
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
				delete_supplier(data.id);
			} else {
				swal.close();
			}
		});
	}else if($(this)[0].name == "editButton"){
		id_supplier=data.id;
		$("#name-edit").val(data.name);
		$("#file-edit").val('');
      $("#edit_supplier_modal").modal('show');
	} 
});



get_supplier = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/supplier',
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

create_supplier = () => {
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
		url: host_url + "api/home/create/supplier",
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


edit_supplier = () => {
	event.preventDefault();
	

	let data = {
		id:id_supplier,
		name: $("#name-edit").val(),
	};
    
	console.log(data);
	
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/edit/supplier",
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
		url: `${host_url}api/home/up/supplier/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el proveedor con éxito ",
				button: "OK",
			}).then(() => {
				get_supplier();
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
		url: `${host_url}api/home/up/supplier/edit/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado el proveedor con éxito ",
				button: "OK",
			}).then(() => {
				get_supplier();
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



delete_supplier = (id_supplier)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/supplier/${id_supplier}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_supplier();
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


$("#create_supplier_btn").on('click',create_supplier);edit_supplier_btn
$("#edit_supplier_btn").on('click',edit_supplier);