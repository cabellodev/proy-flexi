<link href="<?php echo base_url(); ?>assets/site_css/pagination.css" rel="stylesheet">
<script src="<?php echo base_url() ;?>assets/site_js/pagination.min.js"></script>

<main>
        <section>
            <div class="container-fluid page-header-about d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5 mb-5">
                
                <h1 class="display-4 text-white mb-3 mt-0 mt-lg-5 wow slideInDown"><i class="bi-box"></i><span class="title-product"></span></h1>
                <div class="d-inline-flex text-white wow slideInUp">
                    <p class="m-0"><a class="text-white" href="">Home</a></p>
                    <p class="m-0 px-2">/</p>
                    <p class="m-0 title-product"></p>
                </div>
            </div>
        </section>

        <section>
        <div class="col-md-12 mb-5">
                            <div class="section-title text-center wow slideInRight " data-wow-delay="0.8">
                                <h2 class ="style-p  wow slideInLeft " style="color:#141b6a;font-size:40px;"><i class="bi-box"></i>  <span class="title-catalogo"></span></h2>
                            </div>
                        </div>
        </section>

       <section>
       <div id="header-search-product">
            <div class="container">
                <div class="row ">
                        <div class="col-md-12 wow slideInRight " data-wow-delay="0.8" >
                                <div class="header-search">
                                    

                                        <select class="input-select-primary" id ="supplier">
                                            <option value="0">Seleccione marca</option>
                                        </select>

                                        <select class="input-select" id ="categories">
                                            <option value="0">Seleccione categoría</option>
                                        </select>
                                        <select class="input-select" id ="subcategories">
                                            <option value="0">Seleccione sub-categoría</option>
                                        </select>
                                        <select class="input-select" id ="subsubcategories">
                                            <option value="0">Seleccione sub-categoría</option>
                                        </select>
                                       

                                        <input class="input" placeholder="Nombre de producto">
                                        <button class="search-btn" id="search_product">BUSCAR</button>
                                
                                </div>
                            </div>
                    </div>
            </div>
        </div>
       </section>
       
        




        <section>
                        <!-- store products -->
                    <div class="row product-content">  </div>  
                
                    
        </section>

<!--
<div class="row ">
        <div id="view-data" ></div> 
        <div id="pagination"></div>
        </div>
</div>-->
</main><!-- PAGINADOR ( BUSCAR BUENA UBICACIÓN Y ADEMAS VER COMO FUNCIONA CON DATA DE LA BASE )-->


<script src="<?php echo base_url() ;?>assets/site_js/product.js?v=<?php echo(rand()); ?>"></script>  
 

