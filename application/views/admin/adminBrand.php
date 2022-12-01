
<style>
    #canvas_container {
        width: 800px;
        height: 400px;
        
    }

   

</style>
<div id="content-wrapper">
  <div class="container-fluid mb-5">
        <div id="navigation_controls">
              <button id="go_previous">Previous</button>
              <input id="current_page" value="1" type="number"/>
              <button id="go_next">Next</button>
        </div>
        <span></span>
        <div id="zoom_controls">  
              <button id="zoom_in">+</button>
              <button id="zoom_out">-</button>
        </div>
      <div id="my_pdf_viewer">
        <div id="canvas_container">
              <canvas id="pdf_renderer"></canvas>
        </div>
        
     </div>
  </div>
</div>


<script src="<?php echo base_url(); ?>assets/js_admin/viewer_pdf.js"></script> 