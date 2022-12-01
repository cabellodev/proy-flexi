$(()=>{
get_policies();
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

      
       if(element.item == "Introducción Politicas"){

          url = host_url + `assets/images/sections/${element.url}`;
          
          $("#policies-title").text(element.title.toUpperCase());
          $("#policies-desc").text(element.description.toUpperCase());
          $(".policies-img").attr('src',url);
       
       }

       if(element.item == "Politicas de hidratec"){
     
        $(".policies-section").text(element.title);
      }
      
       if(element.item == "Cabecera de módulo Politicas"){
          url = host_url + `assets/images/sections/${element.url}`;
     
          $(".title-policies").text(element.title);

      $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                       "height": "500px",
                                       "background-position": "top",
                                       "background-repeat": "no-repeat",
                                       "background-size": "cover"});
        }




  })
   
}

get_policies = ()=> {

    $.ajax({
		type: "GET",
		url: host_url + 'api/policies',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
          
			draw_items_policies(result);
			}
        })
}



draw_items_policies = (policies)=>{

     
    $(".policies-items").empty();
  
    let cont= 0
    policies.forEach(element => {

       
        cont++;
        html_items = `<div class="col-lg-4 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
        <div class="mision-item text-center pt-3">
          <a href="#policies_${element.id}" onClick=show_policies(${element.id})>
            <div class="p-4" >
            
                <h5 class="mb-3 style-p">${element.name.toUpperCase()}</h5>
                
            </div>
          </a>
        </a>
        </div>
    </div>`;

    html_description=  `<div class="section-header text-center policies" id="policies_${element.id}" >
                            <h2 class ="title-brand  wow slideInLeft  py-3" data-wow-delay="0.8" style="color:white;font-size: 40px;"><i class="bi-search" ></i>  <span class="title-policies">${element.name.toUpperCase()}</span></h2>
                            <p style="color:white"  >${element.description.toUpperCase()}
                        </div><!--/.section-header-->
     `;

     $(".policies-items").append(html_items);
     $(".desc-policies").append(html_description);
     


     if(cont=1){
        $(".policies").hide();
        $(`#policies_${element.id}`).show();
     }

     
    });
}


show_policies =(id_policies)=> { 
    
    $('.policies').hide();
    $(`#policies_${id_policies}`).show();

}



