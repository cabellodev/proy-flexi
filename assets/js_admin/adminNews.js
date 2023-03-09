$(() => {
    get_news();
	let inicialize_time= new Date();
	let current=inicialize_time.toISOString().split('T')[0];
	var dateFormat = "YY-mm-dd";
	from=$("#from").val(current);
	/*from = $( "#from" ).datepicker({
		defaultDate: "+1w",
        dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 1
	  }).on( "change", function() {
		to.datepicker( "option", "minDate", getDate( this ) );
	  });*/
	
	to = $( "#to" ).datepicker({
	  defaultDate: "+1w",
      dateFormat: 'yy-mm-dd',
	  changeMonth: true,
	  numberOfMonths: 1
	}).on( "change", function() {
	  from.datepicker( "option", "maxDate", getDate( this ) );
	});

	date_to = $( "#date_to_e" ).datepicker({
		defaultDate: "+1w",
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 1
	  }).on( "change", function() {
		from.datepicker( "option", "maxDate", getDate( this ) );
	  });
  

    getDate=( element ) =>{
        var date;
        try {
        date = $.datepicker.parseDate( dateFormat, element.value );
        } catch( error ) {
        date = null;
        }
        return date;
    }
});

$(document).on({
	ajaxStart: function () {
		$("body").addClass("loading");
	},
	ajaxStop: function () {
		$("body").removeClass("loading");
	},
});

let id_new=0;
const tabla = $("#table-news").DataTable({
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
        { data: "date" },
		{ data: "date_expiration" },
		{ data: "state",
		render: function(data){
		     if(data ==1){
                 return "Habilitado";
			 }else{
                 return "Deshabilitado";
			 }
		} 
	  },
		{ data: "url",
		render: function(data){
			binary = data;
			return '<img src="'+host_url+"assets/images/news/"+binary+'" width="200" heigth="200"/>';
		} 
	  },
	  {
		defaultContent: `<button type='button' name='show' class='btn btn-success'>
							  Ver
							  <i class="fas fa-eye"></i>
						  </button>`,
		},
		
		{
			defaultContent: `<button type='button' name='editButton' class='btn btn-primary'>
                                  Editar
                                  <i class="fas fa-edit"></i>
                              </button>`,
		},
		{
			defaultContent: `<button type='button' name='stateButton' class='btn btn-info'>
								  Des/hab
								  <i class="fas fa-eye"></i>
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

$("#table-news").on("click", "button", function () {
	let data = tabla.row($(this).parents("tr")).data();
	if ($(this)[0].name == "deleteButton") {
		swal({
			title: `Eliminar noticia`,
			icon: "warning",
			text: `¿Está seguro/a que desea eliminar la noticia: "${data.title}"? `,
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
				delete_new(data.id,data.url);
			} else {
				swal.close();
			}
		});
	}if ($(this)[0].name == "editButton") {
		id_new = data.id;
		$("#title-edit").val(data.title);
		$("#description-edit").val(data.description);
		$("#date_e").val(data.date);
		$("#date_to_e").val(data.date_expiration);
		$("#edit_new_modal").modal('show');
	} if ($(this)[0].name == "show") {

		url = `${host_url}assets/images/news/${data.url}`;
		$('.imagepreview').attr('src',url);
		$('#show_image').modal('show');
		
	}else if ($(this)[0].name == "stateButton"){

		swal({
			title: `Deshabilitar/Habilitar`,
			icon: "warning",
			text: `¿Está seguro/a que desea Deshabilitar/Habilitar la noticia: "${data.title}"? `,
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
				change_state(data.id,data.state);
			} else {
				swal.close();
			}
		});
	
}
});



get_news = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/home/get/news',
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


delete_new= (id_new , url)=>{

	let data = {
         id:id_new,
		 url:url
	}

    $.ajax({

		type: "POST",
		data:{data},
		url: host_url + `api/home/delete/news`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_news();
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

datatable = (news)=>{
    tabla.clear();
	tabla.rows.add(news);
	tabla.draw();



}



create_new = () => {


	let date = new Date();
	let date_current=date.toISOString().split('T')[0];
    let validation= { date_from : date_current, date_to : $('#to').val() }
    console.log(validation);
	if(validation.date_to ===""){
		    
		swal({
			title: "Atención",
			icon: "info",
			text: "Ingrese fecha de caducidad ",
		})

	}else if(date_current === validation.date_to){ // if current time equal sign date_to 
		    
		swal({
			title: "Error",
			icon: "error",
			text: "La fecha caducidad debe ser diferente la fecha actual.",
		})

	}else if( date_current > validation.date_to){ // if current time greater-than sign date_to 
		    
		swal({
			title: "Error",
			icon: "error",
			text: "Ingrese una fecha posterior a la actual.",
		})

	}else { // if date is validate , continue save process



	let files = $("#file")[0].files;
	let data= { 
		
		title:$("#title").val(),
		description:$("#description").val(),
		date_to: validation.date_to,
	}
	console.log(data);

	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/create/new",
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

}else{

	swal({
		title: "Error",
		icon: "error",
		text: "Cargue una imagen por favor."
	})

}

	}
}



create_new_test = () => {
	
	let files = $("#file")[0].files;
  
	
	let data= { 
		
		title:$("#title").val(),
		description:$("#description").val(),
	}

	if(files.length > 0){

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/create/new",
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

}else{

	swal({
		title: "Error",
		icon: "error",
		text: "Cargue una imagen por favor."
	})

}
}


edit_new= () => {
	
	

	let data = {
		id: id_new,
		title: $("#title-edit").val(),
		description: $("#description-edit").val(),
		date: $("#date_e").val(),
		date_to : $("#date_to_e").val(),
	};
	if(data.date_to ===""){
		
		swal({
			title: "Error",
			icon: "error",
			text: "Ingrese una fecha de caducidad.",
		});

	}else if(data.date_to === data.date) {
		
		swal({
			title: "Error",
			icon: "error",
			text: "La fecha caducidad debe ser diferente la fecha actual.",
		});


	}else if(data.date > data.date_to ){
		swal({
			title: "Error",
			icon: "error",
			text: "Ingrese una fecha posterior a la actual.",
		})

	}else{

	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/update/news",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha editado la noticia con éxito ",
				button: "OK",
			}).then(()=>{
				$("#edit_new_modal").modal('hide');
				get_news();

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


}



change_state = (id, state)=>{

     state !=0 ? state = 0 : state = 1 ; 
	 let data  = {
		id : id , 
		state : state 
	 }

	 
	$.ajax({
		data: {
			data,
		},
		type: "POST",
		url: host_url + "api/home/state/news",
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "El estado fue cambio con éxito.",
				button: "OK",
			}).then(()=>{
				swal.close();
				get_news();

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
		url: `${host_url}api/news/up/image/${id_image}`,
		success: () => {
			swal({
				title: "Exito!",
				icon: "success",
				text: "Se ha registrado la noticia con éxito ",
				button: "OK",
			}).then(() => {
				get_news();
			    clearInput();
				$('#create_new_modal').modal('hide');
		
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


des_hab_state= (id_new , state )=>{

    state == 1 ? state=0:state=1;
    data = { state: state, id:id_new}
  
    $.ajax({
		type: "POST",
        data: {data},
		url: host_url + `api/home/changeState/news`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            swal({
				title: "Éxito",
				icon: "success",
				text: result.msg,
			}).then(()=>{
                get_news();
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
clearInput=()=>{
	$('#title').val('');
	$('#description').val('');
	$('#file').val('');

}
$("#btn_create_new").on('click',create_new);

$("#edit_notice_btn").on('click',edit_new);

