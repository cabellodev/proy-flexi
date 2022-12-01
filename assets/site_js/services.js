$(() =>{
get_services();
get_section();
})


get_section = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/sections',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_sections(result);
			}
        })
}




draw_sections =(section)=>{
   
    section.forEach(element =>{

         if(element.item =="Introducción servicios"){

            url = host_url + `assets/images/sections/${element.url}`;
            $("#service-title").text(element.title.toUpperCase());
            $("#service-desc").text(element.description.toUpperCase());
            $(".service-img").attr('src',url);
         }

         if(element.item == "Rubros de servicio"){
           
            $(".rubro-title").text(element.title.toUpperCase());
         }
         if(element.item == "Servicios de hidratec"){

            $("#type-service-title").text(element.title.toUpperCase());
         }

         if(element.item == "Cabecera de módulo Servicios"){
         
            url = host_url + `assets/images/sections/${element.url}`;
            $(".title-service").text(element.title.toUpperCase());
            $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                        
                                        });
           

          }

    })
     
}



get_services = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/services',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_items_services(result);
			}
        })
}



draw_items_services = (services)=>{

     
        $("#service-items").empty();
        $("#service-description").empty();
        $("#service-gallery").empty();
        let cont=0;
       
        services.forEach(element => {

           if(element.state==1){
            cont=+1;
            html_items = ` <div class="col-lg-4 col-sm-6  wow fadeInUp" data-wow-delay="0.7s">
                            <div class="mision-item items text-center pt-3" id="item_${element.id_service}">
                               <a href ="#service_${element.id_service}" onClick = show_service(${element.id_service})> <div class="p-4">
                                    
                                    <h5 class="style-p mb-3">${element.name.toUpperCase()}</h5>
                                </div> </a>
                            </div>
                    </div>`;

                    
                     
          html_description=  `<div class="container service py-5" id="service_${element.id_service}">    
                                                <div class="service-details">
                                                    <div class="section-header text-center" >
                                                        <h2 class ="title-brand style-title-h2 wow slideInLeft  py-3" data-wow-delay="0.8" style="color:white ;font-size:40px;"><i class="bi-map"></i> ${element.name.toUpperCase()}</h2>
                                                        <p class="style-p" style="color:white; white-space: pre-line;">
                                                            ${element.description.toUpperCase()}
                                                        </p>
                                                    </div>
                                                
                                                </div>
                                </div>`;
                
         html_gallery = ` <div class="service" id="gallery_${element.id_service}"> <h1>${element.name}</h1> </div>`;

       
         $("#service-items").append(html_items);
         $("#service-description").append(html_description);
         $("#service-gallery").append(html_gallery);
         $('.service').hide();

         if(cont == 1){
            $(`#service_${element.id_service}`).show();
            

         }
        }
        });
}


show_service=(id_service)=>{
     
      $('.service').hide();
      $(`#service_${id_service}`).show();
      $('#gallery_service').empty();
      show_gallery(id_service);
   
}



show_gallery=(id_service)=>{

     $.ajax({
        type: "GET",
        url: host_url +`service/get/images/${id_service}` ,
        crossOrigin: false,
        dataType: "json",
            success: (result) => { 
              
                set_images(result);   }
            })}


set_images= (result) => { 

    result.forEach( element=>{
        
        html = `<div class="col-lg-4 col-md-4 col-ms-12  mb-2">
       
          <img class="img-fluid" src="${host_url}/assets/images/gallery_services/${element.url}" alt="${element.name}" onClick=show_url("${element.url}")>
      
       </div>`;

         $('#gallery_service').append(html);
    });
   
}

show_url =(url)=>{
    src=`${host_url}/assets/images/gallery_services/${url}`;
    $(".imagepreview").attr('src',src);
    $("#show_image").modal('show');
}

close_modal=()=>{
    $("#show_image").modal('hide');
}



$(".close").on('click',close_modal);


/*set_images= (result) => { 

    result.forEach( element=>{
        
        html = `  <div class="col-lg-4 col-md-3 col-sm-12 mb-4 mb-lg-0">
                            <div class="bg-image hover-overlay image-gallery ripple  rounded" data-ripple-color="light">
                                    <img src="${host_url}/assets/images/gallery_services/${element.url}" class="w-100" />
                                        <a href="#!" id = "btn-modal-show" data-mdb-toggle="modal" data-mdb-target="#exampleModal1" onClick = show_url()>
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.2);"></div>
                                        </a>
                            </div>
                 </div>`;
         $('#gallery_service').append(html);
    });
   
}
*/
































