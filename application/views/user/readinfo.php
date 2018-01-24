<div class="container">
	<div class="panel">
		<div class="heading">
	<h4></h4></div>
		<div class="panel-body">
			<?php if (isset($content)): ?>
				<?php if (is_array($content)): ?>
					<?php foreach ($content as $key): ?>

						<?php if ($key->status == 3 && !$this->aauth->is_loggedin() ): ?>

						<div class="col-md-12">
						Oops! That page can’t be found.
						</div>
							<?php break; ?>
						<?php endif ?>

						<?php if ($key->status == 3 && $this->session->userdata['permit'] == 'public' ): ?>
							
						<div class="col-md-12">
						Oops! That page can’t be found.
						</div>
							<?php break; ?>
						<?php endif ?>
						<div class="col-md-12">
							<div class="row"><h4><?=$key->title;?></h4></div>
							</div>
							<br / >

							<div class="row">
								<div class="desc" style="margin-left:50px; "> <?php echo ucfirst($key->description);?></div>
							</div>

							<br / >
				<?php if (isset($researcher)): ?>
					<?php if (is_array($researcher)): ?>

						<?php $j = 0 ;foreach ($researcher as $key2): ?>
							<?php if ($j =0): ?>
								
						<label>Researcher(s)</label>
							<?php endif ?>

						<div class="col-md-12">
							<div class="row"><p><?php echo $key2->fullname .' - '. $key2->position ?></p></div>
						</div>
						<?php $j++; endforeach ?>
					<?php endif ?>
				<?php endif ?>
							<br />

						<div class="col-md-9">
							<div class="row">
								<div class="options">
									<?php
									if(!$this->aauth->is_loggedin()  && $key->status != 2){
											echo "<div class='col-md-12'>You  must login to view/download this file.</div>";
										}else{

											if(isset($files)){
												if (is_array($files) && count($files) > 0) {
													# code...
													$i=0;
													$ftype = $files[0]->type;
													
													foreach ($files as $key2) {
														# code...
														if($key2->type == 'image'){
																echo "<div class='col-md-4' id='img_div_$key2->id' style='height:300px;padding:30px 30px 20px 20px;margin-bottom:120px;'><img style='width:100%;cursor:pointer;overflow:hidden;' alt='$key2->newfilename' src='".site_url('reader?file=').$key2->newfilename."&id=".$key2->id."' id='img_$key2->id' onclick='image_viewer(this.id)' /><br />";
														   		echo "<p style='height:100px;max-height:100px;  text-overflow: ellipsis;  /* Required for text-overflow to do anything */  white-space: wrap;overflow: hidden;font-size:12px'>";
																echo !empty($key2->title) ? $key2->title : strtoupper (str_replace('-',' ', substr($key2->newfilename, 0, -22)));
																echo "</p>";
																echo "<a href='".site_url('download?file=')."$key2->newfilename&id=$key2->id' class='btn btn-success' style='position:relative;bottom:0;'>Download</a> </div>";
														
															?>

															<?php

														//	echo "<div class='col-md-3'><img style='width:100%;height:auto;' src='".site_url('reader?file=').$key2->newfilename."&id=".$key2->id."' /></div>";
														
														?>
								
														<?php
														
														$i++;
														}



														if($key2->type == 'pdf'){
														   	echo "<div class='col-md-2'><img style='width:100%;max-width:200px;max-height:200px;' alt='$key2->newfilename' src='".base_url('public/images/pdf.png')."' /><br />";
														   echo "<p style='height:100px;over-flow:hidden;'>";
																echo !empty($key2->title) ? $key2->title : strtoupper (str_replace('-',' ', substr($key2->newfilename, 0, -22)));
																echo "</p>";
																echo "<a href='".site_url('download?file=')."$key2->newfilename&id=$key2->id' class='btn btn-success'>Download</a> <a href='".site_url('viewer?file=')."$key2->newfilename&id=$key2->id' class='btn btn-info'>VIEW</a></div>";
														
														}	
														if(
														 $key2->type == 'word' ||
														 $key2->type == 'spreadsheet' ||
														 $key2->type == 'powerpoint'
														 ){
														   	echo "<div class='col-md-2'><img style='width:100%';max-width:200px;max-height:200px;  alt='$key2->newfilename' src='".base_url('public/images/docs1.jpg')."'  /><br />";
																echo "<p style='height:100px;max-height:100px;  text-overflow: ellipsis;  /* Required for text-overflow to do anything */  white-space: wrap;overflow: hidden;font-size:12px'>";
																echo !empty($key2->title) ? $key2->title : strtoupper (str_replace('-',' ', substr($key2->newfilename, 0, -22)));
																echo "</p>";
																echo "<a href='".site_url('download?file=')."$key2->newfilename&id=$key2->id' class='btn btn-success'>Download</a></div>";
														
														}	

													if($key2->type == 'zipped'){
														   	echo "<div class='col-md-2'><img style='width:100%;max-width:200px;max-height:200px;'  alt='$key2->newfilename' src='".base_url('public/images/archived.png')."'  /><br />";
																echo "<p style='height:100px;max-height:100px;  text-overflow: ellipsis;  /* Required for text-overflow to do anything */  white-space: wrap;overflow: hidden;font-size:12px'>";
																echo !empty($key2->title) ? $key2->title : strtoupper (str_replace('-',' ', substr($key2->newfilename, 0, -22)));
																echo "</p>";
																echo "<a href='".site_url('download?file=')."$key2->newfilename&id=$key2->id' class='btn btn-success'>Download</a></div>";
														

													}
													if($key2->type == 'video'){
														   	echo "<div class='col-md-4'><video width=\"100%\" height=\"75%\" controls>".'
															<source src="'.site_url('reader?file=').$key2->newfilename.'&id='.$key2->id.'" type="'.$key2->mtype.'">
															</video><br />';
																echo "<p style='height:100px;max-height:100px;  text-overflow: ellipsis;  /* Required for text-overflow to do anything */  white-space: wrap;overflow: hidden;font-size:12px'>";
																echo !empty($key2->title) ? $key2->title : strtoupper (str_replace('-',' ', substr($key2->newfilename, 0, -22)));
																echo "</p>";
																echo "<a href='".site_url('download?file=')."$key2->newfilename&id=$key2->id' class='btn btn-success'>Download</a></div>";
														

													}
									
														

													}
												if($ftype == 'image'){
														?>
									
														<?php
													}
													
	
									

												}
											}

									
									
									}

		

									echo " <a href='".site_url('file/save')."/$key->page_id' class='btn btn-default hidden'><i class='fa fa-save'></i></a>
									</div>";
									?>
								</div>
							</div>
							</div>


						</div>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
</div>
<div class="col-md-12 hidden" id="image-container" style="background-color:rgba(0,0,0,0.8);padding:5%;position:fixed;z-index:99;top:0;height:100vh;width:100% !important;">
	<div class="row" ><button class="btn btn-default pull-right"><i class="fa fa-remove" style='color:red'></i></button>
		<div class="imageviewer" style="height:100%;text-align:center">
			<img style="max-height:80vh;" src="">
		</div>
	</div>
</div>
<style type="text/css">
	@media only screen and (max-width: 768){
		#image-container{
			margin-left: 0;
			margin: 5%;
			padding: 5px;
		}
		#image-container img{
		}
	}
</style>
<script type="text/javascript">
	
	function image_viewer(id) {
		// body...

		url = $('#'+id).attr('src');

		$('#image-container').removeClass('hidden');

		$('.imageviewer img').attr('src',url);

	}

	function image_html_viewer(id) {
		// body...
		$('#'+id).removeClass('col-md-3');
		url = $('#'+id).html();

		$('#image-container').removeClass('hidden');

		$('.imageviewer').html(url);

	}
	$('#image-container').on('dblclick',function(){
		$(this).addClass('hidden');
	})

	$('#image-container button').on('click',function(){
		$('#image-container').addClass('hidden');
	})
</script>