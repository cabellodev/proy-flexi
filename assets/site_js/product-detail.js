

   $(()=>{

	get_product_id();

})

	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})
	
	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
	
	/////////////////////////////////////////
	
	// Products Slick
	
	
	// Products Widget Slick


get_product_id =()=>{
    console.log(id_product);
	$.ajax({
		type: "GET",
		url: host_url + `api/description/product/${id_product}`,
		crossOrigin: false,
		dataType: "json",
		async:false,
		success: (result) => {
			
			draw_product(result);
			},
       
        });
}


draw_product = (product)=>{

	

	let images = JSON.parse(product[0].images);
	let description = product[0].description;
	
    let images_load=[];


	image1=images[0].imagen1;
	image2=images[1].imagen2;
	image3=images[2].imagen3;

	if(image1!=""){ images_load.push(image1); }
	if(image2!=""){ images_load.push(image2); }
	if(image3!=""){ images_load.push(image3); }

	console.log(images_load);
    let load = 1;

	images_load.forEach(x=>{
		html_vertical= `<div class="product-preview" ><img id="vertical_${load}" src="${host_url}assets/images/products/${x}" alt=""></div>`;
		html_horizontal= `<div class="product-preview" ><img id="horizontal_${load}" src="${host_url}assets/images/products/${x}" alt=""></div>`;
		
		$("#product-imgs").append(html_vertical);
        $("#product-main-img").append(html_horizontal);
		load++;
	});


	$('.menu-toggle > a').on('click', function (e) {
		e.preventDefault();
		$('#responsive-nav').toggleClass('active');
	})
	
	// Fix cart dropdown from closing
	$('.cart-dropdown').on('click', function (e) {
		e.stopPropagation();
	});
	

	$('.products-widget-slick').each(function() {
		var $this = $(this),
				$nav = $this.attr('data-nav');
	
		$this.slick({
			infinite: true,
			autoplay: true,
			speed: 300,
			dots: false,
			arrows: true,
			appendArrows: $nav ? $nav : false,
		});
	});
	
	/////////////////////////////////////////
	
	// Product Main img Slick
	$('#product-main-img').slick({
	infinite: false,
	speed: 300,
	dots: true,
	arrows: false,
	fade: true,
	asNavFor: '#product-imgs',
	});
	
	// Product imgs Slick
	$('#product-imgs').slick({
	slidesToShow: 3,
	slidesToScroll: 1,
	arrows: true,
	centerMode: true,
	focusOnSelect: true,
		centerPadding: 0,
		vertical: true,
	asNavFor: '#product-main-img',
		responsive: [{
		breakpoint: 991,
		settings: {
					vertical: false,
					arrows: false,
					dots: true,
		}
	  },
	]
	}
	
	);


	

    $(".product-details").empty();
	
	$(".title-product").text(product[0].name);
     

    if(description){
	 aux_description = JSON.parse(description);
	 aux_description.forEach(element =>{

		html =`<p class="font-weight-semi-bold mb-2"><i class="bi-check-circle mr-2"></i>${element.name}: ${element.detail}</p>`;
		$(".product-details").append(html);
        
	})
	}else{
		html =`<p class="font-weight-semi-bold mb-2"><i class="bi-check-circle mr-2"></i>Descripción del producto no definida</p>`;
		$(".product-details").append(html);

	}

	html_desc =`<ul class="product-links ">
				<li class="font-weight-semi-bold">CATEGORÍA: ${product[0].category }</li>
				</ul>

				<ul class="product-links ">
				<li class="font-weight-semi-bold">MARCA: ${product[0].supplier }</li>
				</ul>
				<ul class="product-links ">
				<li class="font-weight-semi-bold">MODELO: ${product[0].model }</li>
				</ul>

			   <ul class="product-links">
				<li>Consultas:</li>
		    	<li><a href="https://wa.me/56947092401"><i class="fa fa-whatsapp"></i></a></li>
				<li><a href="https://www.facebook.com/Hidratec.cl"><i class="fa fa-facebook"></i></a></li>
			</ul>`;
			

	$(".product-details").append(html_desc);
	
}

	// Mobile Nav toggle
	
	







