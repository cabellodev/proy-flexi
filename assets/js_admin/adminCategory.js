$(() => {
    get_category();
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

const tabla = $("#table-categories").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
		{className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]},
        {className: "text-center", "targets": [3]},
	/*	{className: "text-center", "targets": [4]},*/
    ],
	columns: [
		{ data: "name" },
		{ data: "state" },
	/*	{
			defaultContent: `<button type='button' name='subCategory' class='btn btn-primary'>
                                  Subcategorias
								  <i class="fa-solid fa-list-check"></i>
                              </button>`,
		},*/
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


get_category = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/category',
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

$("#table-categories").on("click", "button", function () {
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
			title: `Habilitar/ Deshabilitar categoria`,
			icon: "warning",
			text: `¿Está seguro/a que desea "${state_msg}" la categoria: "${data.name}"? `,
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
		id_category = data.id;
		edit = true;
        $("#title").text("Editar Proveedor");
        $("#name").val(data.name);
		$("#create_category_modal").modal("show");

	}else if ($(this)[0].name == "subCategory") {
		window.location.href = `${host_url}product/subCategory/${data.id}`;
	}
});


create_category = () => {
	let data = {
		name: $("#name").val(),
	};

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/create/category",
		crossOrigin: false,
		dataType: "json",
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha creado la categoria con éxito ",
				button: "OK",
			}).then(() => {
				cleanInput();
				get_category();
				$('#create_category_modal').modal('hide');
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

edit_category = () => {

	if(currentName == $("#name").val()){
		swal({
			title: "Error",
			icon: "warning",
			text: "No se han detectado cambios",
		})
	}else{
		let data = {
			id: id_category,
			name: $("#name").val(),
			currentName : currentName,
		};
		$.ajax({
			data: {
				data,
			},
			type: "POST",
			url: host_url + "api/home/update/category",
			crossOrigin: false,
			dataType: "json",
			success: (result) => {
				swal({
					title: "Exito!",
					icon: "success",
					text: "Se ha actualizado la categoria con éxito ",
					button: "OK",
				}).then(() => {
					cleanInput();
					get_category();
					$('#create_category_modal').modal('hide');
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

change_state = (id_category, state) => {

	let data = {
		id_category: id_category,
		state: state,
	};

	$.ajax({
		type: "POST",
		url: host_url + `api/home/state/category`,
		crossOrigin: false,
		data: {data},
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_category();
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


datatable = (categories)=>{
    tabla.clear();
	tabla.rows.add(categories);
	tabla.draw();

}


$("#btn_create_category").on("click", () => {
	cleanInput();
	currentName = '';
	idEdit = 0;
	$("#create_category_modal").modal("show");
});

cleanInput = () => {
    $("#title").text("Crear Categoria");
	$("#name").val('');
	$("#frm_name2 > input").removeClass("is-invalid");
	currentName = '';
	id_category = 0;
	edit = false;
};

save = () => {
    if(edit) {
		edit_category();
	}else{
		create_category();
	}
};
