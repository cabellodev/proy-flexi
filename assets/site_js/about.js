$(()=>{ 
    get_section();
     get_personal();

   }

);


/*copiar este codigo en otras secciones*/

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

         if(element.item =="Historia Hidratec"){

            url = host_url + `assets/images/sections/${element.url}`;
        
            $("#history-title").text(element.title.toUpperCase());
            $("#history-desc").text(element.description.toUpperCase());
            $(".history-img").attr('src',url);
         }
         if(element.item == "Equipo de trabajo"){

            url = host_url + `assets/images/sections/${element.url}`;
            $("#team-title").text(element.title.toUpperCase());
            $("#team-desc").text(element.description.toUpperCase());
            $(".team-img").attr('src',url);
         
         }
         if(element.item == "Identidad organizacional"){
            $(".entity-title").text(element.title);
         }

         if(element.item == "Personal Hidratec"){
            $(".personal-title").text(element.title);
          } 
        
          if(element.item == "Cabecera de módulo Nosotros"){
            url = host_url + `assets/images/sections/${element.url}`;
           // url = host_url + `assets/images/sections/${element.url}`;
            $(".title-intro").text(element.title.toUpperCase());
            $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                            "background-position": "top",
                                            "background-repeat": "no-repeat",
            });

          }


    })
     
}



get_personal = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/personal',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_personal(result);
			}
        })
}



draw_personal = (personal)=>{


    $("#about-personal").empty();
    
    personal.forEach(element => {
            html = ` <div class="bg-white p-2" style="border-radius:8px 8px;">
            <div style="border-radius:8px 8px; border: solid #141b6a ">
                <div class="position-relative bg-white p-4" style="border-radius:8px 8px; ">
                    <div class="d-flex align-items-center mb-2" >
                        <img class="img-fluid rounded-circle m-3" src="${host_url}/assets/images/personal/${element.url}" style="width: 200px; height: 200px;" alt="${element.name}">
                        <div class="mx-5 text-center">
                            <h6 class="font-weight-semi-bold m-0 style-p ">${element.name}</h6>
                            <small > ${element.area}</small>
                        </div>
                    </div>
                    <p class=" style-p m-0">"${element.phrase}"</p>
                </div>
            </div >
        </div > `;
    //string = string+ html;
    $("#about-personal").append(html);
 });


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
            items:1
        },
        778:{
            items:2
        },
        992:{
            items:2
        }

    }
});

    
    
}




