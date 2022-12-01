$(()=>{
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

       
         if(element.id==31){

            url = host_url + `assets/images/sections/${element.url}`;
            
            $(".covid-title").text(element.title.toUpperCase());
            $(".covid-desc").text(element.description.toUpperCase());
            $(".covid-img").attr('src',url);
         
         }
        
         if(element.id == 32  ){
            $(".metric-covid").text(element.title);
          }

           
         if(element.id==30  ){
            url = host_url + `assets/images/sections/${element.url}`;

            $(".title-covid").text(element.title);

			  $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "height": "500px",
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         "background-size": "cover"});
          }




    })
     
}