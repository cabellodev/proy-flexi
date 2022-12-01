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

let idEdit = 0;
let edit = false;
let currentName = '';
let currentImage = '';

const tabla = $("#table-suppliers").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
		{className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]},
        {className: "text-center", "targets": [3]},
    ],
	columns: [
		{ data: "name" },
		{ data: "state" },
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='stateButton' class='btn btn-danger'>
                                    Bloquear/Habilitar
                                  <i class="fas fa-times"></i>
                              </button>`,
		},
	],
});

$("#table-suppliers").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	console.log(data);
	if ($(this)[0].name == "stateButton") {

		let state_msg = '';
		let state = data.state;

		if(state == "Habilitado"){
			state_msg = 'Bloquear';
			state = 0;
		}else if(state == "Bloqueado"){
			state_msg = 'Habilitar';
			state = 1;
		}

		swal({
			title: `Habilitar/ Deshabilitar proveedor`,
			icon: "warning",
			text: `¿Está seguro/a que desea "${state_msg}" el proveedor: "${data.name}"? `,
			buttons: {
				confirm: {
					text: state_msg,
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
				change_state(data.id, state);
			} else {
				swal.close();
			}
		});
	}else if ($(this)[0].name == "editButton") {
		cleanInput();
		currentName = data.name;
		currentImage = data.image;
		id_supplier = data.id;
		edit = true;
        $("#title").text("Editar Proveedor");
        $("#name").val(data.name);
		$("#create_supplier_modal").modal("show");
	} 
});



get_supplier = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/purveyor',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
				let data = result.map((u) => {
					if (u.state == 1) {
						u.state = "Habilitado";
					} else {
						u.state = "Bloqueado";
					}
					return u;
				});
			    datatable(data);
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
	let data = {
		name: $("#name").val(),
	};

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/create/purveyor",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha creado el proveedor con éxito ",
				button: "OK",
			}).then(() => {
				cleanInput();
				get_supplier();
				$('#create_supplier_modal').modal('hide');
				swal.close();
			});
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

edit_supplier = () => {

	if(currentName == $("#name").val()){
		swal({
			title: "Error",
			icon: "warning",
			text: "No se han detectado cambios",
		})
	}else{
		let data = {
			id_supplier: id_supplier,
			name: $("#name").val(),
			currentName : currentName,
		};
		$.ajax({
			data: {
				data,
			},
			type: "POST",
			url: host_url + "api/home/update/purveyor",
			crossOrigin: false,
			dataType: "json",
			success: (result) => {
				swal({
					title: "Exito!",
					icon: "success",
					text: "Se ha actualizado el proveedor con éxito ",
					button: "OK",
				}).then(() => {
					cleanInput();
					get_supplier();
					$('#create_supplier_modal').modal('hide');
					swal.close();
				});
						
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
}

change_state = (id_supplier, state) => {
   

	let data = {
		id_supplier: id_supplier,
		state: state,
	};

	$.ajax({
		type: "POST",
		url: host_url + `api/home/state/purveyor`,
		crossOrigin: false,
		data: {data},
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
				text: "Error al actualizar el proveedor.",
			});
        }
    })
}

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


$("#btn_create_supplier").on("click", () => {
	cleanInput();
	currentName = '';
	idEdit = 0;
	$("#create_supplier_modal").modal("show");
});

cleanInput = () => {
    $("#title").text("Crear Proveedor");
	$("#name").val('');
	$('#file').val('');
	$("#frm_name2 > input").removeClass("is-invalid");
	currentName = '';
	currentImage = '';
	id_supplier = 0;
	edit = false;
};

save = () => {
    if(edit) {
		edit_supplier();
	}else{
		create_supplier();
	}
};
