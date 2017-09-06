<?php extract($pageVar); ?>
<div id="block<?=$block?>" style="margin-bottom: 1%;" class="col-xs-12">
  <div class="col-xs-1 fl-left">Option : </div>
  <div class="col-xs-2 fl-left">
    <?php 
      echo $this->Form->input('answer',array('name'=>"data[Question][Answers][$block][answer][]",'label'=>false,'class'=>'fl-left','required'=>true,'title'=>'please enter question option'));
    ?>
  </div>
  <div class="col-xs-2 fl-left">Is this correct option? : </div>
  <div class="col-xs-2 fl-left">
    <?php 
      echo $this->Form->input('is_correct',array('label'=>false,'name'=>"data[Question][Answers][$block][is_correct][]",'options'=>YesNo(),'value'=>0));
    ?>
  </div>
  <div class="col-xs-2 fl-left">
    <a data-block="<?=$block?>" href="javascript:void(0)" title="Remove" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a>
  </div>
</div>