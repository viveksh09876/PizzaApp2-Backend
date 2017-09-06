<?php extract($pageVar); ?>
<div id="block<?=$block?>" style="margin-bottom: 1%;" class="col-xs-12">
  <div class="col-xs-1 fl-left">From : </div>
  <div class="col-xs-3 fl-left">
    <?php 
      echo $this->Form->input('from_day',array('name'=>'data[Store][Timeslot][from_day][]','options'=>days(),'label'=>false,'class'=>'fl-left'));
      echo $this->Form->input('from_time',array('name'=>'data[Store][Timeslot][from_time][]','options'=>times(),'label'=>false,'class'=>'fl-left'));
    ?>
  </div>
  <div class="col-xs-1">To : </div>
  <div class="col-xs-3 fl-left">
    <?php 
      echo $this->Form->input('to_day',array('name'=>'data[Store][Timeslot][to_day][]','options'=>days(),'label'=>false,'class'=>'fl-left'));
      echo $this->Form->input('to_time',array('name'=>'data[Store][Timeslot][to_time][]','options'=>times(),'label'=>false,'class'=>'fl-left'));
    ?>
  </div>
  <div class="col-xs-1 fl-left">
    <a data-block="<?=$block?>" href="javascript:void(0)" class="btn btn-sm btn-danger remove"><i class="fa fa-remove"></i></a>
  </div>
</div>