$(() => {
    get_policies();
	get_sections();
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

let id_policies=0;

const tabla = $("#table-policies").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [1]},
		{className: "text-center", "targets": [2]}
    ],
	columns: [
		{ data: "name" },
		
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

$("#table-policies").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar política`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar la política: "${data.name}"? `,
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
				delete_policies(data.id);
			} else {
				swal.close();
			}
		});
	} if ($(this)[0].name == "editButton") {
		id_policies=data.id;
		$("#edit_policies_modal").modal('show');
		$("#name-edit").val(data.name);
        $("#description-edit").val(data.description);

	}
});



get_policies = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/about/get/policies',
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


create_policies = () => {


	let data = {
		name: $("#name").val(),
        description: $("#description").val(),
	};

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/about/create/policies",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: "La política ha sido creada con éxito.",
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



edit_policies = () => {


	let data = {
		id: id_policies,
		name: $("#name-edit").val(),
        description: $("#description-edit").val(),
	};
	
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/about/update/policies",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la política con éxito ",
				button: "OK",
			}).then(()=>{
                $('#edit_policies_modal').modal('hide');
				get_policies();

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




delete_policies = (id_policies)=>{
    $.ajax({
		type: "POST",
		url: host_url + `api/home/delete/policies/${id_policies}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_policies();
            });
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al eliminar la política.",
			});
        }
    })
}

datatable = (policies)=>{
    tabla.clear();
	tabla.rows.add(policies);
	tabla.draw();

}



let desc_boolean=false;
let id_section=0;

const tabla_sections = $("#table-sections").DataTable({
	// searching: true,
	language: {
		url: "//cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json",
	},
	columnDefs: [
        {className: "text-center", "targets": [2]},
		{className: "text-center", "targets": [3]}
    ],
	columns: [

		{ data: "title" },
        { data: "item" },
        { data: "url",
			render: function(data){

				if(data){
				binary = data;
				return '<img src="'+host_url+"assets/images/sections/"+binary+'" width="200" heigth="200"/>';
				}else{
				return 'No aplica';
				}
		} 
	    },
		
		{
			defaultContent: `<button type='button' name='sections-edit' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		
       
	],
});




$("#table-sections").on("click", "button", function () {
	let data = tabla_sections.row($(this).parents("tr")).data();
	if ($(this)[0].name == "sections-edit") {
        input_sections();
        id_section = data.id;
		if(id_section == 24 ){
			
			if(data.description){
			
				$('#item_not_image').val(data.item);
				$('.desc_display').show();
                 desc_boolean = true;
				 $('#title-not-image').val(data.title);
				 $('#desc-not-image').val(data.description);
				 $("#not_image_modal").modal('show');

			}else{
			
				desc_boolean = false;
				$('#item_not_image').val(data.item);
				$('#title-not-image').val(data.title);
				$('.desc_display').css('display', 'none');
				$("#not_image_modal").modal('show');

				
			}  

		}else if(id_section == 22){ // cabecera
            
			$("#item_section").val(data.item);
			$("#title-section").val(data.title);
			$(".desc_section").css('display', 'none');
			$("#description-section").val('cabecera');
			$("#section_modal").modal('show');
		 
		}else{

        $(".desc_section").show();
        $("#item_section").val(data.item);
        $("#title-section").val(data.title);
        $("#description-section").val(data.description);
        $("#section_modal").modal('show');

		}
    } 
});




get_sections = ()=> {
    
    let data = { 
        section:'policies_hidratec',

    }
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/get/sections',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
              datatable_sections(result);}
        ,
        error: ()=>{  
              datatable_sections(0); }
        
    })
}




edit_not_image = ()=> {
    let data = {};

	if(desc_boolean){
			data = {
				id: id_section,
				desc_boolean:true,
				title:$('#title-not-image').val().toUpperCase(),
				description:$('#desc-not-image').val(),
			}
	}else{

		data = {
			id: id_section,
			desc_boolean:false,
			title:$('#title-not-image').val().toUpperCase(),
		}

  	 }

    
    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/section/about/update_not',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			
			swal({
				title: "Éxito",
				icon: "success",
				text: "La sección fue editada con éxito.",
			}).then(() => {
				$("#not_image_modal").modal('hide');
				input_sections();
				get_sections();
			})
        
			
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al actualizar la sección",
			});
        }
    });

}





edit_section = ()=> {

    let files = $("#file-section")[0].files;
    let data = {
        id: id_section,
        title:$('#title-section').val().toUpperCase(),
        description:$('#description-section').val(),
    }

    
    

    $.ajax({
		type: "POST",
        data:{data},
		url: host_url + 'api/section/about/update',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			up_file_section(id_section);
			}
        ,
        error: (msg)=>{
            swal({
				title: "Error",
				icon: "error",
				text: "Error al actualizar la sección",
			});
        }
    });

}


up_file_section= (id_image) => {
 
	$.ajax({
		data: new FormData(document.getElementById('image_section')),
		processData: false,
		contentType: false,
		cache: false,
		type: "post",
		url: `${host_url}api/section/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la sección con éxito. ",
				button: "OK",
			}).then(() => {
				input_sections();
				get_sections();
				$("#section_modal").modal('hide');
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



datatable_sections = (sections)=>{
    tabla_sections.clear();
	tabla_sections.rows.add(sections);
	tabla_sections.draw();

}

input_sections=()=>{

    $("#title").val('');
    $("#file_section").val('');
    $("#description").val('');
	$('#title-not-image').val('');
	$('#desc-not-image').val('');

};

$("#update_section_btn").on('click', edit_section);
$("#edit-not-image").on('click', edit_not_image);


$("#create_policies_btn").on('click',create_policies);
$("#edit_policies_btn").on('click',edit_policies);