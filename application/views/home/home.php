<div class="container">
	<div class="col-md-9">

           <div class="col-md-12">
           <div class="col-md-12">
           	<br />
           	 <div id="myCarousel" class="carousel slide">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                    <li data-target="#myCarousel" data-slide-to="1"></li>
                 </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="item item1 active">
                        <div class="fill" style=" background-color:#708371;">
                            <div class="inner-content">
                                <div class="carousel-img">
                                    <img style="width: 100%;max-height: 250px;" src="<?=base_url('public/images/s1.png');?>" alt="sofa" class="img img-responsive" />
                                </div>
                                <div class="carousel-desc">

                                    <h3 style="padding:5px;">Resource Portal</h2>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="item item2">
                        <div class="fill" style="background-color:#708371;">
                            <div class="inner-content">
                                <div class="carousel-img">
                                    <img style="width: 100%;max-height: 250px;" src="<?=base_url('public/images/s2.png');?>" alt="white-sofa" class="img img-responsive" />
                                </div>
                                <div class="carousel-desc">

                                    <h3 style="padding:5px;">BISU Bilar Campus</h2>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
           <br />
           <div class="content">
           	
           <?php echo $content; ?>
           </div>
           </div>
       </div>

</div>
	<div class="col-md-3 about">
           	<br />
		<?php include VIEWPATH.'common/sub-menu.php'; ?>
	</div>
</div>