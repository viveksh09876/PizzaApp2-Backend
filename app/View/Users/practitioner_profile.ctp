<section class="content-header">
	<div class="pull-left update-img image">
		<a data-toggle="modal" data-target="#ProfileUpload" href="javascript:void(0)"> <?php if((!empty($loggedUser['profile_pic']))){ ?>
              <img src="<?=IMG_PRACTITIONER.'user/thumb/'.$loggedUser['profile_pic']?>" width="100%" height="" class="user-image" alt="User Image">
            <?php  }else{ ?>
                <img src="<?=IMG_PRACTITIONER?>user2-160x160.jpg" width="100%" height="" class="img-circle" alt="User Image">
              <?php } ?>
        </a>
    </div>
	<h1 style="margin-top: 2%"; class="pull-left">
	<?php echo __('Edit Profile');?>
	
	<small>Edit logged user profile info</small>
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=PRACTITIONER_WEBROOT;?>home"><i class="fa fa-dashboard"></i> Home</a></li>
		<li class="active"><?php echo __('Edit Profile');?></li>
	</ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<?php echo $this->Form->create('User');	?>
				<div class="box-body">
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Email</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('email', array('label'=>false,'disabled'=>true,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Password</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('password', array('type'=>'password','label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">First Name</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('first_name', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Last Name</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('last_name', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Phone</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('phone', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Address</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('address', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">City</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('city', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">State</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('state', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Country</label>
						<div class="col-sm-9">
							<?php 
							$country=array(0=>'');
							if(isset($Country)){
								foreach($Country as $Countryx){
									$country[$Countryx['Country']['country_id']]=$Countryx['Country']['country_name'];
								}
							}
							echo $this->Form->input('country_id', array('label'=>false,'options'=>$country,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-6">
						<label class="col-sm-3 control-label" for="inputPassword3">Zipcode</label>
						<div class="col-sm-9">
							<?php echo $this->Form->input('zip_code', array('label'=>false,'class'=>'form-control')); ?>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<label class="col-sm-12 control-label" for="inputPassword3">Short Description</label>
						<div class="col-sm-12">
							<?php 
							echo $this->Form->input('user_short_description', array('label'=>false,'class'=>'form-control ckeditor')); 
							?>
						</div>
					</div>
					<div class="form-group col-sm-12">
						<label class="col-sm-12 control-label" for="inputPassword3">Details Description</label>
						<div class="col-sm-12">
							<?php 
							echo $this->Form->input('user_description', array('label'=>false,'class'=>'form-control ckeditor')); 
							echo $this->Form->input('user_id',array('type'=>'hidden'));
							?>
						</div>
					</div>

				</div><!-- /.box-body -->
				<div class="box-footer">
					<button class="btn btn-info pull-right" type="submit">Update</button>
				</div><!-- /.box-footer -->
				<?php echo $this->Form->end();?>
			</div>
		</div>
	</div>
</section>
<!-- Modal -->
<div id="ProfileUpload" class="modal modal-info fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Your Profile Picture</h4>
      </div>
      <div class="modal-body">
        <input id="fileupload" class="col-md-6 pull-left" type="file" /><button class="basic-result pull-right btn btn-default">Crop</button>
        <div id="dvPreview">
        </div>
      </div>
      <div class="modal-footer clearfix">
        <button type="button" class="btn btn-success update pull-left">Update</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>

  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
  <?php

  echo $this->Html->css(array('admin/croppie'));
  echo $this->Html->script(array('admin/croppie'));

  ?>
  <script language="javascript" type="text/javascript">
    jQuery(function ($) {
      $("#fileupload").change(function () {
        $("#dvPreview").html("");
        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
        if (regex.test($(this).val().toLowerCase())) {
          if ($.browser.msie && parseFloat(jQuery.browser.version) <= 9.0) {
            $("#dvPreview").show();
            $("#dvPreview")[0].filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = $(this).val();
          }
          else {
            if (typeof (FileReader) != "undefined") {
              $("#dvPreview").show();
              $('#dvPreview').append($('<div>').addClass('img_crop pull-right'));
              var img = $('<img>');
              var reader = new FileReader();
              reader.onload = function (e) {
                var basic = $('#dvPreview').croppie({
                  viewport: {
                    width: 160,
                    height: 160,
                    type:'circle'
                  },

                });
                basic.croppie('bind', {
                  url: e.target.result,
                  points: [77,469,280,739]
                });
              //on button click
              $('.basic-result').on('click', function (ev) {
                basic.croppie('result', {
                  type: 'canvas',
                  size:'viewport',
                  format: 'png'
                }).then(function (resp) {
                  $('.img_crop').html(img.attr('src',resp));
                });
              });

              $('.update').on('click',function(){
                var src = $('.img_crop img').attr('src');
                if(typeof (src) != "undefined"){
                  $.ajax({
                    url:'<?=PRACTITIONER_WEBROOT?>users/upload_pic',
                    type:'POST',
                    data:{'profile_pic':src},
                    beforeSend:function(){

                    },
                    success:function(response){
                       // window.location.href = window.location.href;
                    }

                  });
                 
                }
              });
            }
            reader.readAsDataURL($(this)[0].files[0]);
          } else {
            alert("This browser does not support FileReader.");
          }
        }
      } else {
        alert("Please upload a valid image file.");
      }
    });
  });


  </script>
</div>
<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
  jQuery(function () {
    CKEDITOR.replace('.ckeditor');
  });
</script>