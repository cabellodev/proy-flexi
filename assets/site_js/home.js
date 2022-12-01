$(() =>{
   
  
    $('[data-toggle="counter-up"]').counterUp({
        delay: 10,
        time: 2000
    });
      get_section();
      get_notices(); 
      get_services();
      get_supplier();
      get_news(); 
      draw_intro_slice();

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

         if(element.id == 25){
            $(".title-services").text(element.title);
         }
         if(element.id == 26){
            $(".title-notices").text(element.title);
         }
         if(element.id == 27){
            $(".title-supplier").text(element.title);
         }
         if(element.id == 28){
            $(".title-project").text(element.title);
         }

  /*        if(element.item == "Cabecera de módulo Nosotros"){
            $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                            "height": "500px",
                                            "background-position": "top",
                                            "background-repeat": "no-repeat",
                                            "background-size": "cover"});
          } */
    }) 
}




// HOME - SERVICIOS
get_services = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/services',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_service_home(result);
			}
        })
}

draw_service_home = (services)=>{
       let html = "";
       $("#service-home").empty();
      services.forEach(element => {
        if(element.state==1){
       html = `<div class="col-md-6 col-lg-4 service-item wow fadeInUp" data-aos-duration="1500" data-aos="zoom-in-left">
                        <div class=" p-2">
                                <div class="overflow-hidden mb-4">
                                    <img  src="${host_url}/assets/images/services_home/${element.url}" alt="${element.name}">
                                </div>
                                <h4 class="mb-2 style-title-h4">${element.name.toUpperCase()}</h4>
                                <p>${element.title}
                                
                         </div>
                         <a class="btn-slide" href="${host_url}/services"><i class="fa fa-arrow-right"></i><span>VER MÁS</span></a>
                </div>`
     $("#service-home").append(html);
        }
    });
}
//HOME -NOVEDADES

get_notices = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/notices',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_notices_home(result);
			}
        })
}


draw_notices_home= (notice)=>{
  
    $("#notice-home").empty();
    notice.forEach(element => {
    html = ` 
    <img  src="${host_url}/assets/images/notices/${element.image}" oncontextmenu='return false' ondragstart='return false'
    onselectstart='return false'  alt="${element.nombre}">
    `;
    //string = string+ html;
    $("#notice-home").append(html);
 });

    $('.owl-carousel').owlCarousel({
        loop:true,
        margin:30,
        mobile:true,
        responsive:{
        0:{
            items:1
        },
        480:{
            items:1
        },
        779:{
            items:1
        },
        1400:{
            items:1
        }

    }
    
});
}
//HOME - MARCAS 
get_supplier = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/supplier',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_supplier_home(result);
			}
        })
}

draw_supplier_home = (supplier)=>{

    $("#brands-home").empty();

    supplier.forEach(element => {
    html = `<div class="col-lg-4 col-md-4 col-12 bottom-brand">
    <img src="${host_url}/assets/images/supplier/${element.image}" oncontextmenu='return false' ondragstart='return false'
    onselectstart='return false' alt="${element.name}"> 
    </div>`
   
    $("#brands-home").append(html);

    
 });
}

//HOME - NEWS
get_news = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/news',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_news_home(result);
			}
        })
}

draw_news_home = (news)=>{

    

    $("#news-home").empty();

    news.forEach(element => {

   

    html = ` <div class="row border-bottom pb-5 mb-5" data-aos-duration="1500" data-aos="zoom-in-left">
                 <div class="col-lg-4 col-12">
                     <img src="${host_url}/assets/images/news/${element.url}" class="schedule-image img-fluid" alt="">
                 </div>

                 <div class="col-lg-8 col-12 mt-3 mt-lg-0">
        
                         <h4 class="mb-2">${element.title}</h4>

                         <p>${element.description} </p>

                         <div class="d-flex align-items-center mt-4">
                               

                                <span class="mx-3 mx-lg-5">
                                    <i class="bi-clock me-2"></i>
                                    ${element.date}
                                </span>

                                <span class="mx-1 mx-lg-5">
                                    <i class="bi-layout-sidebar me-2"></i>
                                Sede Coquimbo
                                </span>
                        </div>
                 </div>
             </div>`;
   
    $("#news-home").append(html);
    
 });
}






draw_intro_slice = ()=> { 
    let array=[];
  
        $.ajax({
            type: "GET",
            url: host_url + 'api/slide',
            crossOrigin: false,
            async:false,
            dataType: "json",
            success: (result) => {
           
                array= result;
                }
            });

 

    $(".intro-carousel").empty();
   

    array.forEach(element => {
    if(element.state==1){
        html = `<div class="owl-carousel-item position-relative ">
        <img src="${host_url}assets/images/slide/${element.url}">
        
    </div>`;

    $(".intro-carousel").append(html);
    }

    });

   

}









