
$(()=>{ 
    get_section();
    
    $('.owl-carousel').owlCarousel({
        autoplay: true,
        smartSpeed: 200,
        dots: true,
        loop: true,
        margin: 30,
        responsive: {
            0:{
                items:1
            },
            480:{
                items:2
            },
            778:{
                items:3
            },
            992:{
                items:2
            }
   
        }
    });}

   
   
);





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

       
         if(element.item == "Introducción Clientes"){

            url = host_url + `assets/images/sections/${element.url}`;
            
            $("#client-title").text(element.title.toUpperCase());
            $("#client-desc").text(element.description.toUpperCase());
            $(".client-img").attr('src',url);
         
         }
        
         if(element.item == "Vinculo a portal"  ){
            $(".form-client").text(element.title);
          }

           
         if(element.item == "Cabecera de módulo Clientes"  ){
            url = host_url + `assets/images/sections/${element.url}`;

            $(".title-client").text(element.title);

			  $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "height": "500px",
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         "background-size": "cover"});
          }




    })
     
}