<?php extract($pageVar); ?>
<section class="content-header">
    <h1>
    <?=$title;?>
    <small><?=$sub_title;?></small>
  </h1>
  <ol class="breadcrumb">
    <?=$breadcrumb;?>
  </ol>
</section>
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box box-primary">
				<?php echo $this->Form->create('Content'); ?>
                  <div class="box-body">
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Page Title</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('page_title',array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Page Slug</label>
                      <div class="col-sm-9">
					  <?php echo $this->Form->input('page_slug',array('onfocus'=>'getPageSlug();','size'=>40,'after'=>'&nbsp;(It will be shown in URL.)','label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Page Sub Title</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('page_sub_title', array('label'=>false,'class'=>'form-control')); ?>
                      </div>
                    </div>
                    <div class="form-group col-sm-6">
                      <label class="col-sm-3 control-label" for="inputPassword3">Page Status</label>
                      <div class="col-sm-9">
                      	<?php echo $this->Form->input('status', array('label'=>false,'options'=>array('Publish'=>'Publish','Unpublish'=>'Unpublish'),'class'=>'form-control')); ?>
                      </div>
                    </div>
                    
                    <div class="form-group col-sm-12">
                      <label class="col-sm-12 control-label" for="inputPassword3">Page Content</label>
                      <div class="col-sm-12">
                      	<?php echo $this->Form->input('page_content', array('label'=>false,'class'=>'form-control ckeditor')); ?>
                      </div>
                    </div>
                    
                  </div><!-- /.box-body -->
                  <div class="box-footer">
                    <button class="btn btn-info pull-right" type="submit">Save</button>
                  </div><!-- /.box-footer -->
               	<?php echo $this->Form->end();?>
               	</div>
               	</div>
               	</div>
               	</section>

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<script>
  jQuery(function () {
    CKEDITOR.replace('.ckeditor');
  });
</script>
<script type="text/javascript">
function getPageSlug(){
	var str='';
	str+=$("input[name='data[Content][page_title]']").val().replace(/ /g,"_");
	$("input[name='data[Content][page_slug]']").val(str.toLowerCase());

}
</script>
