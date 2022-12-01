

$(()=>{

    get_contact();
    get_section();
});


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

       
         if(element.item == "Introducción contactos"){
           
            $(".title-intro").text(element.title);
            $("#desc-contact").text(element.description.toUpperCase());
           
         }
        
         if(element.item == "Cabecera de módulo Contacto" ){

			url = host_url + `assets/images/sections/${element.url}`;

            $(".title-contact").text(element.title);

			  $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                        
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         
                                        });
          }

    })
     
}


location_function =(adress)=>{
    url ='https://maps.google.com/maps?q=proyectada%20uno%201712&t=&z=13&ie=UTF8&iwloc=&output=embed';
    window.open(url,'_blank');
}

get_contact = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/contacts',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_contact(result);
			}
        });

}



draw_contact=(contacts)=>{

    $("#contact-box").empty();
    

    contacts.forEach(element =>{
              
             adress=`${element.adress} ${element.city}`;
              

              html = `<div class="row">
              <div class="col-lg-12 col-12 text-center mb-5">
                  <h2 class ="style-p wow slideInRight official-color-word" style="font-size: 40px;"> <i class="bi-geo-fill"></i>  ${element.region.toUpperCase()} </h2>
              </div>
  
              <div class="col-lg-6 col-12  wow slideInLeft"  data-wow-delay="0.8">
                  <img class="img-fluid " src="${host_url}/assets/images/contact/${element.url}" alt="${element.name}">
              </div>
  
              <div class="col-lg-6 col-12 mt-5 mt-lg-0  wow slideInLeft " data-wow-delay="0.8">
                  <div class="venue-thumb bg-white shadow-lg" >
                      
                      <div class="venue-info-title text-center">
                          <h2 class="text-white mb-0 style-p" style="font-size:40px;">${element.city.toUpperCase()}</h2>
                      </div>
  
                      <div class="venue-info-body">
                          <h4 class="d-flex">
                              <i class="bi-geo-alt me-2"></i> 
                              <span>${element.adress.toUpperCase()}</span>
                          </h4>
  
                          <h5 class="mt-4 mb-3">
                              <a href="mailto:hello@yourgmail.com">
                                  <i class="bi-envelope me-2"></i>
                               ${element.email}
                              </a>
                          </h5>
  
                          <h5 class="mb-0">
                              <a href="tel: 305-240-9671">
                                  <i class="bi-telephone me-2"></i>
                                ${element.phone}
                              </a>
                          </h5>
                      </div>
                  </div>
              </div>
          </div>
  
          <div class="row  justify-content-center contact-maps" >
                <div class="col-lg-6 col-md-6 col-ms-12 py-5 justify-content-center">
                <h2 class="text-white text-center mb-0 style-p" style="font-size:40px;">GEOLOCALIZACIÓN</h2>
                <button class="btn btn-success" style="transform: translateX(60%);" onClick="hola('${adress}')" ><i class="bi-geo-fill" style="font-size:200px;"></i></button>
                </div>
                <div class="col-lg-6 col-md-6 col-ms-12 py-5 ">
                <iframe src="${element.url_map}" width="300" height="300" style="border-radius:20%;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              
          </div>
          
          `;
          

      
          $("#contact-box").append(html);
    })

    

}


hola =(adress)=> {
  
    if(adress){
      window.open('https://google.cl/maps/place/'+adress, '_blank');
    }  
    return false; //No ejecutar el evento.
}






