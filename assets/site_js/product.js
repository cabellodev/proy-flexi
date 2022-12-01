$(()=>{

    get_category();
    get_supplier();
    get_section();
    get_products_all();

})


get_products_all =()=>{

    $.ajax({
		type: "GET",
		url: host_url + 'api/products/all',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
           
			draw_products(result);
			}
        ,
    
        error: ()=>{

            $('.product-content').empty();
            let html= ' <div class="alert alert-dark>No se han encontrado resultados de la búsqueda </div>';
            $('.product-content').append(html);

        } ,
    });


}


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

      
         if(element.item == "Catálogo de productos"){
           
            $(".title-catalogo").text(element.title);
         }
       

         if(element.item == "Cabecera de módulo Productos"  ){
         //   url = host_url + `assets/images/sections/${element.url}`;
         url = host_url + `assets/images/prueba_banner_producto.png`;
            $(".title-product").text(element.title);
            $(".page-header-about").css({"background":`linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),url(${url})`, 
                                         "background-position": "top",
                                         "background-repeat": "no-repeat",
                                         });
          }

    })
     
}


get_supplier= ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/supplier/select',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            select_supplier(result);
			}
        });
}
// select de marcas 
select_supplier= (supplier)=>{

    const select_supplier = $("#supplier");
 
    supplier.forEach( (element)=> {
    select_supplier.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}

get_category = ()=> {
    $.ajax({
		type: "GET",
		url: host_url + 'api/categories',
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
            select_category(result);
			}
        });
}

// select de categorias
select_category = (categories)=>{

    const select_category = $("#categories");
  
    
    categories.forEach( (element)=> {
    select_category.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}


$("#categories").change('click',()=>{
     id_category= $("#categories").val();

     const select_subsubcategory = $("#subsubcategories");
     select_subsubcategory.empty();
     select_subsubcategory.append($("<option>", {
         value: 0 ,
         text: 'Seleccionar sub-categoria'
     }));

     get_subcategory(id_category);

    
})

$("#subcategories").change('click',()=>{
    id_subcategory= $("#subcategories").val();

    get_subsubcategory(id_category);

   
})

get_subsubcategory = (id_subcategory)=> {

    $.ajax({
		type: "GET",
		url: host_url + `api/subsubcategories/${id_subcategory}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			select_subsubcategory(result);
			},
        error: ()=>{
            const select_subsubcategory = $("#subsubcategories");
            select_subsubcategory.empty();
            select_subsubcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));
        }

        });
}



// select de subcategorias
get_subcategory = (id_category)=> {

    $.ajax({
		type: "GET",
		url: host_url + `api/subcategories/${id_category}`,
		crossOrigin: false,
		dataType: "json",
		success: (result) => {
			select_subcategory(result);
			},
        error: ()=>{


            const select_subcategory = $("#subcategories");
            select_subcategory.empty();
            select_subcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));

            const select_subsubcategory = $("#subsubcategories");
            select_subsubcategory.empty();
            select_subsubcategory.append($("<option>", {
                value: 0 ,
                text: 'Seleccionar sub-categoria'
            }));
        }

        });
}


select_subsubcategory = (subsubcategories)=>{

    const select_subsubcategory = $("#subsubcategories");
    select_subsubcategory.empty();
    select_subsubcategory.append($("<option>", {
        value: 0 ,
        text: 'Seleccionar sub-categoria'
    }));
   
    subsubcategories.forEach( (element)=> {
    select_subsubcategory.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}


select_subcategory = (subcategories)=>{

    const select_subcategory = $("#subcategories");
    select_subcategory.empty();
    select_subcategory.append($("<option>", {
        value: 0 ,
        text: 'Seleccionar sub-categoria'
    }));
   
    subcategories.forEach( (element)=> {
    select_subcategory.append($("<option>", {
        value: element.id ,
        text: element.name
      }));
   });
}




search_product= ()=>{

    let data={ supplier : $('#supplier').val(),category: $('#categories').val(),subcategory:  $('#subcategories').val(),
                 subsubcategory: $('#subsubcategories').val()}

    $.ajax({
		type: "POST",
        data: {data},
		url: host_url + 'api/product/search',
		crossOrigin: false,
		dataType: "json",
        async:false,
		success: (result) => {
          
            draw_products(result);
			}
        ,
        error: ()=>{

            $('.product-content').empty();
            let html= ' <div class="alert alert-dark>No se han encontrado resultados de la búsqueda </div>';
            $('.product-content').append(html);
        }
    });
}




 
 draw_products=(product)=>{

    let container = $('#pagination');

    
    container.pagination({
        dataSource: product,
        showPageNumbers: true,
        showPrevious: true,
        showNext: true,
        showNavigator: false,
        showFirstOnEllipsisShow: true,
        showLastOnEllipsisShow: true,
        pageSize: 12 ,
        callback: function (data, pagination) {

           
            let dataHtml = '<ul>';
            let content = '';
            let aux = '';
            let largo = data.length;

            $.each(data, function (index, item) {
                content = `<div class="col-lg-3 col-md-4 col-xs-6 wow slideInRight " data-wow-delay="0.8">
                <div class="product">
                    <div class="product-img">
                        <img src="${host_url}/assets/images/products/image_first/${item.image_first}" alt="${item.name}">
                    </div>
                    <div class="product-body">
                        <p class="product-category">${item.category}</p>
                        <p class="product-category">${item.supplier}</p>
                        <h3 class="product-name"><a href="#">${item.name}</a></h3>
                    <!--<h4 class="product-price">$980.00 <del class="product-old-price">$990.00</del></h4> -->
                           <div class="product-rating">
                        </div>
                        <div class="product-btns">
                            <!--	<button class="add-to-wishlist"><i class="fa fa-heart-o"></i><span class="tooltipp">add to wishlist</span></button>-->
                            <button class="quick-view"><i class="bi-eye"></i><span class="tooltipp"> Ver componente </span></button>
                            <!--<button class="add-to-compare"><i class="fa fa-exchange"></i><span class="tooltipp">add to compare</span></button>-->
        
                        </div>
                    </div>
                    <div class="add-to-cart">
                        <button class="add-to-cart-btn" id="href-product" onClick=product_by_id(${item.id}) ><i class="fa fa-shopping-cart"></i> Detalles</button>
                    </div>
                    </div>
                </div>`;
 
                if(( (index+1) % 4 ) == 0){
                    aux = aux + content;
                    dataHtml += '<li><div class="row">' + aux + '</div></li>';
                    aux = '';
                }else{
                    aux = aux + content;
                    if(largo == (index+1)){
                        dataHtml += '<li><div class="row">' + aux + '</div></li>';
                    }
                }
            });

            dataHtml += '</ul>';

            $("#data-container").html(dataHtml);          
        }
    })
 };

 


product_by_id =(id)=>{

    let url = 'products/details'+'?id='+id;
    window.location.assign(host_url+url);
    
}



$("#search_product").on('click',search_product);


/*

$("#href-product").on('click', ()=>{
 
   /// let url = 'service/admin/gallery'+'?id='+id_service;
    url = 'products/details';
    window.location.assign(host_url+url);

});*/










