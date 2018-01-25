<div class="col-md-12 slider">
  <div class="container">
    
  <?php include 'slider.php'; ?>

  </div>

  <div class="container">
    <div class="col-md-9">
      
           <div class="content">
            <br />
            <?php 
            if (!empty($welcome)) {
               # code...
               if (is_array($welcome)) {
                 # code...
                echo $welcome[0]->setting_value;
               }
             } ?>
           </div>
    </div>
    <div class="col-md-3">
      
    </div>
  </div>  
</div>