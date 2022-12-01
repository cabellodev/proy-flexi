$(()=>{ 
   get_rubros();
});


get_rubros = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/rubros',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			draw_rubros_home(result);
			}
        })
}


draw_rubros_home= (notices)=>{
  
    $("#rubros-service").empty();
    notices.forEach(element => {
        console.log(element.url);
    html = `  <div class="rubro-conteiner" >

    <img class="img-fluid" src="${host_url}/assets/images/rubros/${element.url}"  alt="${element.name}">
    <div class="rubro-center text-white">${element.name.toUpperCase()}</div>
    </div>`;
    //string = string+ html;
    $("#rubros-service").append(html);
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
            items:2
        },
        778:{
            items:2
        },
        992:{
            items:3
        }

    }
});

}

    
    
