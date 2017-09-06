<div class="col-sm-9">
<?php $selected = json_decode($this->request->data['alreadySet']); ?>
  <?php echo $this->Form->input('included_modifiers',array('name'=>"data[Product][included]",'options'=>$selOptions,'selected'=>$selected,'label'=>false,'class'=>'form-control','multiple'=>true)); ?>
</div>