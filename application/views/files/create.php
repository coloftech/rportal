<style type="text/css">
	
ul.ul-on-input{
          text-decoration: none;
          list-style: none;
          margin:0;
          padding:0;
          margin-left: 5px;
          margin-top: -5px;
          background-color: #e5e5e5;
          position: absolute;
          width: 95%;
          min-width: 100px;
          padding: 4px;
          display: none;
          z-index: 99;
        }
        ul.ul-on-input > li{

          padding: 4px;
        }
        ul.ul-on-input > li:hover{
          background-color: #4543a9;
          color: #fff;
          cursor: pointer;
        }
</style>
    <!-- Main Content -->
    <div class="container-fluid">
        <div class="side-body">

        <div class="row create">
        <h3>Upload resource form</h3>
        <br />
	        <div class="col-md-12">
	        	<form class="form" id="frmpost" name="frmpost" action="<?=site_url('file/save_resource');?>" method="post"  enctype="multipart/form-data">
			<div class="col-md-12">
			<div class="form-group">
				<label for="Title">Title</label><input type="text" class="form-control" name="title" id="title" placeholder="Type title here"  autocomplete="off"  required>
			</div>

			<div id='textareafield' class="">
			<div class="form-group">
				<label for="Title">Abstract/Description <i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartextarea("contents")' title='Clear abstract/description'></i></label>
				<textarea name="contents"  id="contents" style="width:100%;height:100px;"  placeholder="Type abstract here"></textarea>
			</div>
			</div>


			<div class="form-group">
				<label for="Title">Keyword<i class='btn fa fa-undo' style='color:dodgerblue' onclick='cleartags("tags")' title='Clear all tags'></i></label><br/> <input type="text" class="form-control"  data-role="tagsinput" name="tags" id="tags" placeholder='Type here and press Enter' autocomplete="off"  style='min-width:200px;'>
				<div id="listoftags" class="listoftags"></div>
			</div>

			</div>
			<div class="col-md-12">
			<div class="form-group">
				<label for="Title">Select file</label>

        					<input type="file" name="filez" id="filez" class="btn alert-warning" accept="image/*,audio/mp3,video/*,application/msword, application/vnd.ms-excel, application/vnd.ms-powerpoint,
 application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/x-rar,application/zip">
			</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">Privacy</label><select class="form-control" name="group-privacy" id="group-privacy">
						
						<option value="1">Staff only</option>
						<option value="2">Public</option>
					</select> 
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">File Category</label><select class="form-control" name="group-category" id="group-category">
						<?php 
							foreach ($category as $key) {
								# code...
								echo "<option value='$key->id'>$key->name</option>";

							}
						?>
					</select> 
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label for="Title">Course</label><select class="form-control" name="group-course" id="group-course">
						
						<?php 
							foreach ($listgroup as $key) {
								# code...
								echo "<option value='$key->id'>$key->name</option>";

							}
						?>
					</select> 
				</div>
			</div>

			<div class="col-md-6">

				<div class="form-inline">

				<label for="Title">Date &nbsp;</label><br />

				<select class="form-control" name="months" id="months" style="width:25%;min-width:95px;">
				<?php 
				$months = array(
					array('id'=>1,'name'=>'Jan'),
					array('id'=>2,'name'=>'Feb'),
					array('id'=>3,'name'=>'Mar'),
					array('id'=>4,'name'=>'Apr'),
					array('id'=>5,'name'=>'May'),
					array('id'=>6,'name'=>'Jun'),
					array('id'=>7,'name'=>'Jul'),
					array('id'=>8,'name'=>'Aug'),
					array('id'=>9,'name'=>'Sep'),
					array('id'=>10,'name'=>'Oct'),
					array('id'=>11,'name'=>'Nov'),
					array('id'=>12,'name'=>'Dec')

					);

				$m = date('m');

				foreach ($months as $key) {
					# code...
						if($key['id'] == $m){$iscurrent = 'selected';}else{$iscurrent='';}
						echo "<option value='".$key['id']."' $iscurrent>".$key['name']."</option>";
				}
				?>
				</select> 
				<select  class="form-control" name='days' id='days' style="width:25%;min-width:95px;" >
					
				<?php
				$d = date('d');
				for ($i=1; $i <=31; $i++) { 
					# code...
					echo "<option value ='$i'";
					if ($i == $d) {
						# code...
						echo ' selected';
					}
					echo ">$i</option>";
				}
				?>
				</select>
				
				<select class="form-control" name="years" id="years"  style="width:25%;min-width:95px;">
					<?php 
					$currentY = date('Y');
					//echo $currentY;
					for ($i=1912; $i <= $currentY; $i++) { 
						# code...
						if($i == $currentY){$iscurrent = 'selected';}else{$iscurrent='';}
						echo "<option value='$i' $iscurrent>$i</option>";

					}
					?>
				</select> 
				</div>
				
			</div>	
				
			<div class="col-md-6">
		

			<div class="form-group">
			<br />
			<input type="submit" class="btn btn-info" name="btn-next" id="btn-next" value="Next >>">
			<button type="button" class="btn btn-warning" onclick="resetall()">Clear all</button> 
			<br />


			</div>

		
			</div>

		</form>
				<div style="with:75%;" class="upload"></div>
				<div class="response"></div>
	        </div>




		<?php include 'otherinfo.php'; ?>


       	</div>
    </div>


<script type="text/javascript">
	//script for first form	

	$('#contents').summernote({
    callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
    },
    height:150
});

function resetall(){

	if (confirm('This will clear all your unsave data,are you sure?')) {
    // Save it!
    clearall();
} else {
    // Do nothing!
}
			

}

function clearall (argument) {
	
	  	$('form').each(function() { this.reset() });
	cleartags('tags');
	cleartextarea('contents');
	$('#frmpost').show('slow');
	$('#other-info').hide('fast');

	$( '#filez' ).addClass('alert-warning');
	$( '#filez' ).removeClass('alert-info');
	$('.response').html('');
}

 $( '#filez' ).on('change',function(){

			$( '#filez' ).addClass('alert-info');
			$( '#filez' ).removeClass('alert-warning');
			var filez =$('#filez').val();
			if(filez == ''){

			$( '#filez' ).addClass('alert-warning');
			$( '#filez' ).removeClass('alert-info');
			}
 });


	$('#frmpost').on('submit',function(e){
		e.preventDefault();
		//console.log('hey');return false;

		var frmdata = new FormData();
		//var data = $('#frmpost').serialize();

		var title = $('#title').val();
		var desc = $('#contents').summernote('code');//$('#title').val();
		var tags =  $('#tags').val();
		var sfile = $( '#filez' ).val() ;
		var file = $( '#filez' )[0].files[0] ;

		if (sfile == '') {

			$('.response').html('<div class="alert alert-danger">Please upload file.</div>');
			 $( '#filez' ).removeClass('alert-info');
			 $( '#filez' ).addClass('alert-warning');
			return false;
		}else{
			$('.response').html('');
			$( '#filez' ).addClass('alert-info');
			$( '#filez' ).removeClass('alert-warning');
			
		};

    	frmdata.append( 'filez', file);
		frmdata.append('title',title);
		frmdata.append('contents',desc);
		frmdata.append('tags',tags);
		frmdata.append('group-privacy',$('#group-privacy').val());
		frmdata.append('group-category',$('#group-category').val());
		frmdata.append('group-course',$('#group-course').val());
		frmdata.append('months',$('#months').val());
		frmdata.append('days',$('#days').val());
		frmdata.append('years',$('#years').val());
  		
  		var i = 0;
		$.ajax({
			type: 'post',
			//dataType: 'json',
			url: '<?=site_url('file/save_resource');?>',
			data: frmdata,
        		processData: false,
  				contentType: false,
  			 beforeSend: function() {
        	// setting a timeout

        			$('#frmpost').hide('slow');
					
			        $('.upload').html('Upload on progress...<br /><img style="width:95%;height:80vh;position:absolute;opacity:0.7;z-index:999;" src="<?=base_url();?>public/images/upload_circling.gif" />');
			        i++;
			    },
			success: function (resp) {
			    $('.upload').html('');
				console.clear()
				console.log(resp);
				var data;
				if(data = JSON.parse(resp)){


				if (data.stats == true) {
					$('#slug').val(data.slug);
					$('.response').html('<div class="alert alert-success">Post successfully added.</div>');
					$('#frmpost').hide('slow');
					$('#other-info').show('slow');

						setTimeout(function () {
						$('#researcher').focus();
						},2000);


				}else{
  					$('#frmpost').show('slow');
					$('.response').html('<div class="alert alert-danger">'+data.msg+'</div>');
				}
			}else{  
					$('#frmpost').show('slow');

					$('.response').html('<div class="alert alert-danger">Unknown error.</div>');
			
				
			}
			},
  			 complete: function() {
        	// setting a timeouti--;
			        if (i <= 0) {
			            $('.upload').html('');
			        }
			    }
		});

		return false;
	});

</script>


