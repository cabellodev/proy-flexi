$(() => {
    get_SubSubcategory();
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
let paths = window.location.pathname.split('/');
let id_subcategory = paths[paths.length-1];

const tabla = $("#table-SubSubcategories").DataTable({
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


get_SubSubcategory = ()=> {
	let data = {
		id: id_subcategory,
	};;
	console.log(data);
    $.ajax({
		type: "POST",
		url: host_url + 'api/home/get/subSubCategory',
		crossOrigin: false,
		dataType: "json",
		data: {data},
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
				console.log(result);
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

$("#table-SubSubcategories").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	
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
			title: `Habilitar/ Deshabilitar Subcategoria`,
			icon: "warning",
			text: `¿Está seguro/a que desea "${state_msg}" la Subcategoria: "${data.name}"? `,
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
		id_SubSubcategory = data.id;
		edit = true;
        $("#title").text("Editar Proveedor");
        $("#name").val(data.name);
		$("#create_SubSubcategory_modal").modal("show");

	}
});


create_SubSubcategory = () => {
	let data = {
		name: $("#name").val(),
		id: id_subcategory
	};
	
	$.ajax({
		data: {data},
		type: "POST",
		url: host_url + "api/home/create/subSubCategory",
		crossOrigin: false,
		dataType: "json",
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha creado la Subcategoria con éxito ",
				button: "OK",
			}).then(() => {
				cleanInput();
				get_SubSubcategory();
				$('#create_SubSubcategory_modal').modal('hide');
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

edit_SubSubcategory = () => {

	if(currentName == $("#name").val()){
		swal({
			title: "Error",
			icon: "warning",
			text: "No se han detectado cambios",
		})
	}else{
		let data = {
			id: id_SubSubcategory,
			name: $("#name").val(),
			currentName : currentName,
			id_sub_category: id_subcategory
		};
		$.ajax({
			data: {
				data,
			},
			type: "POST",
			url: host_url + "api/home/update/subSubCategory",
			crossOrigin: false,
			dataType: "json",
			success: (result) => {
				swal({
					title: "Exito!",
					icon: "success",
					text: "Se ha actualizado la Subcategoria con éxito ",
					button: "OK",
				}).then(() => {
					cleanInput();
					get_SubSubcategory();
					$('#create_SubSubcategory_modal').modal('hide');
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

change_state = (id_Subcategory, state) => {

	let data = {
		id_category: id_Subcategory,
		state: state,
	};
	console.log(data);
	$.ajax({
		type: "POST",
		url: host_url + `api/home/state/subSubCategory`,
		crossOrigin: false,
		data: {data},
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_SubSubcategory();
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


$("#btn_create_SubSubcategory").on("click", () => {
	cleanInput();
	currentName = '';
	idEdit = 0;
	$("#create_SubSubcategory_modal").modal("show");
});

cleanInput = () => {
    $("#title").text("Crear SubCategoria");
	$("#name").val('');
	$("#frm_name2 > input").removeClass("is-invalid");
	currentName = '';
	id_SubSubcategory = 0;
	edit = false;
};

save = () => {
    if(edit) {
		edit_SubSubcategory();
	}else{
		create_SubSubcategory();
	}
};
