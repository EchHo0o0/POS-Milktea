<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100%;
	}
	img#cimg2{
		height: 50vh;
		width: 100%;
		object-fit: contain;
		/* border-radius: 100%; */
	}

    /* Milk Tea-inspired color palette */
    body {
        background-color: #f5f5f5; /* Milky White background */
        font-family: Arial, sans-serif;
    }

    .card {
        background-color: #fff5e1; /* Milky White for the card background */
        border: 1px solid #d8b095; /* Light Tea Brown border for card */
    }

    .card-header {
        background-color: #d8b095; /* Creamy Beige for card header */
        color: #3e2a47; /* Dark Brown for title text */
    }

    .card-body {
        background-color: #fff5e1; /* Milky White for card body */
        padding: 20px;
    }

    .form-group label {
        color: #3e2a47; /* Dark Brown for form labels */
    }

    .form-control {
        background-color: #ffffff; /* Milky White for input fields */
        color: #3e2a47; /* Dark Brown for input text */
        border: 1px solid #d8b095; /* Light Tea Brown border */
        padding: 10px;
        font-size: 14px;
    }

    .custom-file-input {
        border: 1px solid #d8b095; /* Light Tea Brown border for file input */
        padding: 10px;
    }

    .custom-file-label {
        color: #3e2a47; /* Dark Brown for custom file input label */
    }

    .btn-primary {
        background-color: #c67c4f; /* Caramel for primary buttons */
        border-color: #c67c4f;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #c27b44; /* Slightly darker caramel for hover effect */
    }

    .img-thumbnail {
        border-radius: 8px;
        border: 1px solid #d8b095; /* Light Tea Brown border for image thumbnails */
    }

    .alert-success {
        background-color: rgb(39, 226, 83); /* Green for success alert */
        color: #155724;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .alert-danger {
        background-color: rgb(229, 22, 39); /* Red for error alert */
        color: #721c24;
        border-radius: 5px;
        padding: 15px;
        font-size: 14px;
        margin-bottom: 20px;
    }

    .toast {
        background-color: #c67c4f; /* Caramel toast background */
        color: white;
        font-size: 14px;
        border-radius: 8px;
        padding: 10px 20px;
        text-align: center;
    }

</style>

<div class="col-lg-12">
	<div class="card card-outline rounded-0 card-navy">
		<div class="card-header">
			<h5 class="card-title" style="color: #3e2a47;">System Information</h5> <!-- Dark Brown for card title -->
		</div>
		<div class="card-body">
			<form action="" id="system-frm">
				<div id="msg" class="form-group"></div>
				<div class="form-group">
					<label for="name" class="control-label">System Name</label>
					<input type="text" class="form-control form-control-sm" name="name" id="name" value="<?php echo $_settings->info('name') ?>">
				</div>
				<div class="form-group">
					<label for="short_name" class="control-label">System Short Name</label>
					<input type="text" class="form-control form-control-sm" name="short_name" id="short_name" value="<?php echo  $_settings->info('short_name') ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="" class="control-label">Banner Images</label>
				<div class="custom-file">
	              <input type="file" class="custom-file-input rounded-circle" id="customFile3" name="banners[]" multiple accept=".png,.jpg,.jpeg" onchange="displayImg3(this,$(this))">
	              <label class="custom-file-label" for="customFile3">Choose file</label>
	            </div>
				<small><i>Choose to upload new banner images</i></small>
			</div>
			<?php 
            $upload_path = "uploads/banner";
            if(is_dir(base_app.$upload_path)): 
			$file= scandir(base_app.$upload_path);
                foreach($file as $img):
                    if(in_array($img,array('.','..')))
                        continue;
            ?>
                <div class="d-flex w-100 align-items-center img-item">
                    <span><img src="<?php echo base_url.$upload_path.'/'.$img."?v=".(time()) ?>" width="150px" height="100px" style="object-fit:cover;" class="img-thumbnail" alt=""></span>
                    <span class="ml-4"><button class="btn btn-sm btn-default text-danger rem_img" type="button" data-path="<?php echo base_app.$upload_path.'/'.$img ?>"><i class="fa fa-trash"></i></button></span>
                </div>
            <?php endforeach; ?>
            <?php endif; ?>
			</form>
		</div>
		<div class="card-footer">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm btn-primary" form="system-frm">Update</button> <!-- Caramel for update button -->
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
		var fnames = [];
		Object.keys(input.files).map(function(k){
			fnames.push(input.files[k].name)
		})
		_this.siblings('.custom-file-label').html(fnames.join(", "))
	}
	function delete_img($path){
        start_loader()
        
        $.ajax({
            url: _base_url_+'classes/Master.php?f=delete_img',
            data:{path:$path},
            method:'POST',
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("An error occured while deleting an Image","error");
                end_loader()
            },
            success:function(resp){
                $('.modal').modal('hide')
                if(typeof resp =='object' && resp.status == 'success'){
                    $('[data-path="'+$path+'"]').closest('.img-item').hide('slow',function(){
                        $('[data-path="'+$path+'"]').closest('.img-item').remove()
                    })
                    alert_toast("Image Successfully Deleted","success");
                }else{
                    console.log(resp)
                    alert_toast("An error occured while deleting an Image","error");
                }
                end_loader()
            }
        })
    }
	$(document).ready(function(){
		$('.rem_img').click(function(){
            _conf("Are you sure to delete this image permanently?",'delete_img',["'"+$(this).attr('data-path')+"'"])
        })
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>
