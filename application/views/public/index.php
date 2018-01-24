
								<style type="text/css">
									.tbl-user .btn{margin:1px;}
								</style>
<div class="container">
	
	<h3>Search area</h3>
	<div class="col-md-12">
		<div class="col-md-9">
			
				<form class="form search-form" action="" method="GET" >
					<div class="form-inline">
						<input type="text" name="q" id="q" class="form-control search-input" placeholder="Search here.." required><button class="btn btn-default"><i class="fa fa-search"></i></button>
					</div>
				</form>
				<br />

						<div class="search-result" id="searchresult">
							<div class="col-md-12">



<?php 
	if (isset($list_life)) {
	 	# code...

	 	//var_dump($list_life);
	 	if(empty($list_life)){

	 			echo "<div class='col-md-12'>";
	 			echo "<div class='row'>";
	 			echo "<div class='alert alert-warning' style='max-width:90%;'>No result</div></div></div>";
	 	//exit();
	 	}else{
	 	if (is_array($list_life)) {

	 		if($start > 0){
	 			$i = 1 + $start;
	 		}else{
	 			$i=1;
	 		}

	 		foreach ($list_life as $keys) {
	 			foreach ($keys as $key) {
	 				# code...
	 			# code...

	 			$type = 'Read more...';
	 			echo "<div class='col-md-12'>";
	 			echo "<div class='row'>
	 				<div class='form-group'>
	 				<label><h4><a href='".site_url('read')."/$key->years/$key->slug'>$i. $key->title</a></h4></label>
	 				<p style='display: table-cell;   vertical-align: left; padding: 5px;'>$key->description</p>
	 				<p><a href='".site_url('read')."/$key->years/$key->slug'>$type</a></p>
	 				<p>";
	 				
	 				echo "</p></div></div></div>";
	 			$i++;
	 			}
	 		}
	 	}
	 }
	 } ?>



	 						<div class="col-md-12">

	 						<?=isset($links) ? $links : '';?>
	 						
	 						</div>
							</div>
						</div>
		</div>
		<div class="col-md-3">
			<div class="col-md-12 hidden"><h4>Announcement</h4></div>
			<div class="col-md-12 user-latest-post"><h4>Most downloaded</h4>

			<?php if (isset($recent_downloads)): ?>
				<?php if (is_array($recent_downloads)): ?>
					<?php foreach ($recent_downloads as $key): ?>
						<?php
							$type = 'Read more...';
						?>
						<?php 
						//if($key->nfile){
							
						echo '<div class="col-md-12 box">
						<a href="'.site_url("read/").$key->years.'/'.$key->slug.'">
						<div class="box-content">'.$key->title.'</div>
						<div class="box-type">'.$type.'</div>
						</a>
						</div>'; 
						//}
						?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
			</div>		
			<div class="col-md-12 user-latest-post"><br /><br /><h4>Latest uploads</h4>

			<?php if (isset($latest_file)): ?>
				<?php if (is_array($latest_file)): ?>
					<?php foreach ($latest_file as $key): ?>
						<?php
						
						/*
						switch ($key->type) {
	 				case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
	 					# code...
	 					$type='Word';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
	 					# code...
	 					$type='Spreadsheet';
	 					break;
	 				case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
	 					# code...
	 					$type='Powerpoint';
	 					break;
	 				case 'application/pdf':
	 					# code...
	 					$type='PDF';
	 					break;
	 					
	 				case 'text/plain':
	 					# code...
	 					$type='Text File';
	 					break;
	 				
	 				case 'image/png':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/jpeg':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/jpg':
	 					# code...
	 					$type='Image';
	 					break;
	 				case 'image/gif':
	 					# code...
	 					$type='Image';
	 					break;
	 				
	 				case 'video/mp4':
	 					# code...
	 					$type='Video';
	 					break;
	 				case 'application/octet-stream':
	 					# code...
	 					$type='video';
	 					break;
	 				case 'application/x-rar':
	 					# code...
	 					$type='ZIP/RAR';
	 					break;
	 				case 'application/zip':
	 					# code...
	 					$type='ZIP/RAR';
	 					break;
	 				
	 				
	 				default:
	 					$type = 'Unknown';
	 					break;
	 				}*/
						?>
						<?php 
						//if($key->nfile){
							
						echo '<div class="col-md-12 box">
						<a href="'.site_url("read/").$key->years.'/'.$key->slug.'">
						<div class="box-content">'.$key->title.'</div>
						<div class="box-type">Read more...</div>
						</a>
						</div>'; 
						//}
						?>
					<?php endforeach ?>
				<?php endif ?>
			<?php endif ?>
			</div>
		</div>
	</div>


</div> <!--container -->