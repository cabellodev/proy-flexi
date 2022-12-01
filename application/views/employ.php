<main>

        <section>
            <div class="container-fluid page-header-about d-flex flex-column align-items-center justify-content-center pt-0 pt-lg-5 mb-5">
                
                <h1 class="display-4 text-white mb-3 mt-0 mt-lg-5 wow slideInDown"> <i class="bi bi-briefcase-fill"></i> <span class="title-employ"></span></h1>
                <div class="d-inline-flex text-white wow slideInUp">
                    <p class="m-0"><a class="text-white" href="">Home</a></p>
                    <p class="m-0 px-2">/</p>
                    <p class="m-0">Empleo</p>
                </div>
            </div>
        </section>




        <section>
                <div class="container-xxl py-5">
                    <div class="container py-2">
                        <div class="d-flex justify-content-center align-items-center   top-brand  ">
                        <h2 class ="official-color-word style-p wow slideInLeft  py-3" data-wow-delay="0.8" style="font-size: 40px;"><i class="bi-send-check"></i> <span class="form-employ"></span></h2>
                        </div>
                        
                    </div>
                </div>
            </section>






        <section class="contact section-padding " id="section_7" >

            <div class="container"  >
                <div class="row text-center wow slideInRight " data-wow-delay="0.8">

                    <div class="col-lg-8 col-12 mx-auto mb-4">
                        <div class = "alert alert-info" >
                        <h5 class="style-p"> Se han abierto postulaciones para los siguientes cargos : </h5>
                        <div id="list_charges">

                        </div>
                        <h5 class="style-p" id = "time_star"></h5>
                        <h5 class="style-p" id = "time_limit"></h5>
                        </div>
                    </div>

                </div>

                <div class="row wow slideInLeft " data-wow-delay="0.8">

                    <div class="col-lg-8 col-12 mx-auto">
                        <div class="custom-form contact-form bg-white shadow-lg " >
                            <h2 class="text-center" id="open_close" style=" font-size: 40px;" ></h2>

                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-12">                                    
                                    <input type="text" name="name" id="name" class="form-control input" placeholder="Nombre" required="">
                                </div>
                                <div class="col-lg-4 col-md-4 col-12 border-primery">                                    
                                    <input type="text" name="name" id="surname" class="form-control input" placeholder="Apellido" required="">
                                </div>

                                <div class="col-lg-4 col-md-4 col-12 ">         
                                    <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control input" placeholder="Email" required="">
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">         
                                    <input type="text" name="phone" id="phone"  class="form-control input" placeholder="Teléfono/celular" required="">
                                </div>


                                <div class="col-lg-4 col-md-4 col-12">                                    
                                    <input type="text" name="subject" id="charge" class="form-control input " placeholder="Cargo">
                                </div>


                                <div class="col-12 ">
                                    <textarea class="form-control " rows="5" id="curriculum" name="curriculum" placeholder="Curriculum"></textarea>
                                   
                                </div>
                                <button type="submit"  id = "btn_send_notification" class="form-control">Enviar</button>

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>

</main>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/site_js/employ.js?v=<?php echo(rand()); ?>"></script>