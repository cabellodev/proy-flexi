$(()=>{
    get_sections();
})


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
		if(id_section == 25 ||id_section == 26||id_section == 27 ||id_section == 28  ){
			
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

		}else if(id_section == 21){ // cabecera
            
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
        section:'home_hidratec',

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

    
    if(files.length > 0){

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
}else{
    swal({
        title: "Atención",
        icon: "warning",
        text: "Cargue el archivo de imagen por favor.",
    });

}
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