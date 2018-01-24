<div class="row" id="other-info" style="display:none;">
			<div class="col-md-12">
			<div class="panel">
				<div class="panel-body">
				<div class="col-md-12">
				<label>Other information</label>
				<select class="form-control" id="select-other-info">
					<option value="0">--- SELECT HERE ---</option>
					<option value="1">Books</option>
					<option value="2">Journal</option>
					<option value="3">Newspaper</option>
					<option value="4">Report</option>
					<option value="5">Research</option>
					<option value="6">Undergraduate Thesis</option>
				</select>
					<br />
				</div>



			<div class="row other-option" id="option-1" style="display:none;">
				<div class="col-md-12">					
				Books
				</div>
			</div>

			<div class="row other-option" id="option-2" style="display:none;">
				<div class="col-md-12">
				Journal					
				</div>
			</div>
			<div class="row other-option" id="option-3" style="display:none;">
				<div class="col-md-12">					
				Newspaper
				</div>
			</div>

			<div class="row other-option" id="option-4" style="display:none;">
				<div class="col-md-12">
				Report					
				</div>
			</div>

			<div class="row other-option" id="option-5" style="display:none;">
				<div class="col-md-12">					
				Research
				</div>
			</div>

			<?php 
				include 'thesis.php';
			?>
       	</div>
			<div class="row buttons">
					
			<div class="form-inline">
					<div class="col-md-12"><label for="Title"></label>
					<button type="submit" class="btn btn-info btn-submit" id="btn-submit">Save</button> &nbsp;
					<button type="button" class="btn btn-default" onclick="skipall()">Skip</button>
					<p>Note: You can use "SKIP" button to skip this step and return to the first form.</p>
					</div>
				
			</div>
			</div>
				</div>
			</div>
</div>


<script type="text/javascript">
	//form for other information or second form
var	activeId;
	function skipall(){
		if (confirm('This action will skip and return to main form, click Ok to continue..')) {
	    

	  	$('form').each(function() { this.reset() });
		cleartags('tags');
		cleartextarea('contents');
		$('#frmpost').show('slow');
		$('#other-info').hide('fast');
		$( '#filez' ).addClass('alert-warning');
		$( '#filez' ).removeClass('alert-info');
		$('.response').html('');
		} 
	}
		function cleartags (id) {
		// body...
		$("#"+id).tagsinput('removeAll');
	}

	function cleartextarea (id) {

		$("#"+id).each(function() {
        if (
            $(this).summernote('isEmpty') || 
            $(this).val() == '<p dir="auto"><br></p>' ||
            // this is needed in some rare cases, 
            // ex. validating inputs when updating an entry in laravel ""
           !$('.note-editable > p').html('<br>')
           ) {
            $(this).val('');
        }
    	});
	}

	$('#select-other-info').on('change',function(){

	
		var id = $(this).val();

		$('.other-option').hide('fast');
		$('#option-'+id).show('slow');
		//$('#frm-'+id + ' .btnsubmit').attr('id','btn-'+id);
		activeId = id;


	});
	$('#btn-submit').on('click',function () {
		// body...
		//alert(activeId);
		var data = $('#frm-'+activeId).serialize();
		console.log(data);
	})
	var timer;
	var inputId;
	var more = 2;
	function names(id) {
		// body...
		console.log(id);
		var names = $('#'+id).val();

		inputId = id;

		if ($.trim(names).length < 2) {
			return false;
		}


		$('#ul-on-input-'+id).show();
		$('#ul-on-input-'+id).html('<li>searching...</li>');

		
		  clearTimeout(timer);       // clear timer
		  timer = setTimeout(get_names, 2000);

    		return false;
    	};

			$('#panel').on('keydown', function(){
				  clearTimeout(timer);       // clear timer
		    });
			$('#committee').on('keydown', function(){
				  clearTimeout(timer);       // clear timer
		    });

    	 function get_names(id){

    	 	var name = $('#'+inputId).val();
    		$.ajax({
    			type: 'post',
    			url: '<?php echo site_url("post/search_names");?>',
    			data: 'name='+name,
    			dataType: 'json',
    			success: function (resp) {
    				console.clear();
    				console.log(resp);

    				if (resp.stats == true) {
    					$('#ul-on-input-'+inputId).html(resp.msg);
    				}
    				setTimeout(function () {
    					// body...
    					$('#ul-on-input-'+inputId).hide();
    				},10000);
    			}

    		});

					
    	}
    	function get_selected(string) {
    		// body...
    		$('#'+inputId).val(string);
    		$('#ul-on-input-'+inputId).hide();
    	}
	function addmore(id){
  		    var error = 0;

			    $.each( $("input[name='"+id+"[]']"), function(index,value){
			        if( value.value.length == 0){
			            error = 1;

			        	$("#msg"+id).html("<font color='red'>Please input "+id+" first</font>"); 

			        	setTimeout(function(){
			        	$("#msg"+id).html("");
			        	},3000);
			            return false;
			        }
			    });
			    if(!error){
			    	var name = id.replace(/\d+/g, '')
			        $("#msg"+id).html(""); 
			        $('#div'+id).append('<br><div class="col-md-8"><label for="Title">Name of '+id+'</label><input  type="text" class="form-control" name="'+name+'[]" id="'+id+more+'" placeholder="Enter '+id+' here" onkeyup="names(this.id)" autocomplete="off" required><ul class="ul-on-input" id="ul-on-input-'+id+more+'"></ul></div><div class="col-md-4"><label for="Title">Position / title</label><input type="text" class="form-control" name="'+name+'-position[]" id="'+id+more+'-position" placeholder="Enter position here" required></div>');

			    more = more + 1;
			    }


  		
	}




</script>