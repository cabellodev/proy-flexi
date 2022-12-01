<!-- <script src="<?php echo base_url(); ?>assets/site_js/mdb.min.js"></script>-->
<!-- <link href="<?php echo base_url(); ?>assets/site_css/mdb.min.css" rel="stylesheet"> -->
<main>

<section>
    <div class="page-header-about d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5 mb-5">
        
        <h1 class="display-4 text-white mb-3 mt-0 mt-lg-5 wow slideInDown"> <i class="bi-wrench"></i> <span class="title-service"></span></h1>
        <div class="d-inline-flex text-white wow slideInUp">
            <p class="m-0"><a class="text-white" href="home.html">Home</a></p>
            <p class="m-0 px-2">/</p>
            <p class="m-0">Services</p>
        </div>
    </div>
</section>



            <section>
                <div class="container-xxl py-5">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                                <div class="position-relative h-100">
                                    <img class=" service-img img-fluid position-absolute w-100 h-100" src="<?php echo base_url();?>assets/images/about1.png" alt="" style="object-fit: cover;">
                                </div>
                            </div>
                            <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s" style="word-break: break-all;">
                                <h5 class="section-title official-color-word text-center style-p bg-white text-start  pe-3"  id="service-title"> </h5>
                            
                              
                                <p class="style-p mb-4" id="service-desc" style="white-space: pre-line;">  
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            
<!--
            <section class="official-color-bg"style="padding-top:60px; padding-bottom:80px;"> 
                      <div class="container-fluid ">
                                  <div class="container text-center">
                                      <h2 class ="style-p wow slideInLeft " style="color:white; padding-bottom:50px;font-size: 40px;"> <i class="bi-people"></i> <span class="rubro-title">PRESTACIÓN DE SERVICIOS</span></h2>
                                              <div class="owl-carousel rubros-carousel "id = "rubros-service">  </div>
                                  </div>
                          </div>
             </section> -->

          

            <section>
                <div class="container-xxl py-5 text-center">
                    <h2 class ="official-color-word style-p wow slideInLeft " style="font-size: 40px;"><i class="bi-tools"></i> <span id="type-service-title">NUESTROS SERVICIOS</span></h2>
                    <div class="container py-5"><div class="row g-4" id="service-items"> </div></div>
                </div>
            </section>




            <section  class="official-color-bg"  
            > 
                <div class="container py-5">
                    <div class="service-details" id="service-description"> </div><!--/.service-details-->
                </div><!--/.container-->
            </section><!--/.service-->



            <section >
                  <div class="container py-5">
                      <div class="row service-details" id="service-gallery">
                             
                      </div><!--/.service-details-->
                  </div><!--/.container-->
            </section><!--/.service-->

            <section class="">
  
                <section class="box-gallery">
                    <div class="row " id="gallery_service" ></div>
                </section>
  
                <section class="">
                    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModal1Label" aria-hidden="true" >
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                    <div class="ratio ratio-16x9"> <img src="" id="image-gallery"   allowfullscreen ></div>

                                    <div class="text-center py-3">
                                        <button type="button" class="btn btn-secondary" data-mdb-dismiss="modal">Close</button>
                                    </div>
                            </div>
                        </div>
                    </div>    
                </section>

            </section>

        </main>


        <div class="modal fade" id="show_image" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">              
                    <div class="modal-body" >
                        <button  class="close btn btn-primary" data-dismiss="modal">Close</button>
                        <img src="" class="imagepreview" style="width: 100%;" >
                        
                    </div>
                    </div>
                </div>
        </div>

<script src="<?php echo base_url(); ?>assets/site_js/services.js?v=<?php echo(rand()); ?>"></script>
<script src="<?php echo base_url(); ?>assets/site_js/carouselRubro.js?v=<?php echo(rand()); ?>"></script>