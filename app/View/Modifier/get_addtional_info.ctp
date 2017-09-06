<?php 
if(!empty($pageVar)){
foreach ($pageVar as $key => $info) {
?>
<fieldset class="clear" id="<?php echo $key; ?> ">
  <legend><?php echo $info['modifierInfo']['Modifier']['title']; ?> </legend>
  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Default Modifier</label>
    <div class="col-sm-9">
      <?php 
        $default_option_id = (!empty($this->request->data['Product']['added'][$key]['default_option_id']))?$this->request->data['Product']['added'][$key]['default_option_id']:0;
        echo $this->Form->input('default_option_id',array('name'=>"data[Product][added][$key][default_option_id][]",'options'=>$info['optionList'],'label'=>false,'class'=>'form-control','selected'=>$default_option_id)); ?>
   </div>
  </div>

  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Is Required?</label>
    <div class="col-sm-9">
      <?php 
          $is_required = (!empty($this->request->data['Product']['added'][$key]['is_required']))?$this->request->data['Product']['added'][$key]['is_required']:0;
        echo $this->Form->input('is_required',array('name'=>"data[Product][added][$key][is_required][]",'options'=>YesNo(),'label'=>false,'class'=>'form-control','selected'=>$is_required)); ?>
   </div>
  </div>

  <div class="form-group col-sm-6 clear">
  <label class="col-sm-3 control-label">Choice</label>
    <div class="col-sm-9">
      <?php 
        $choice = (!empty($this->request->data['Product']['added'][$key]['choice']))?$this->request->data['Product']['added'][$key]['choice']:0;
        echo $this->Form->input('choice',array('name'=>"data[Product][added][$key][choice][]",'options'=>choices(),'label'=>false,'class'=>'form-control','selected'=>$choice)); ?>
   </div>
  </div>

  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Min Choice</label>
    <div class="col-sm-9">
      <?php 
        $min_choice = (!empty($this->request->data['Product']['added'][$key]['min_choice']))?$this->request->data['Product']['added'][$key]['min_choice']:'';
        echo $this->Form->input('min_choice',array('name'=>"data[Product][added][$key][min_choice][]",'label'=>false,'class'=>'form-control','value'=>$min_choice)); ?>
   </div>
  </div>

  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Max Choice</label>
    <div class="col-sm-9">
      <?php 
        $max_choice = (!empty($this->request->data['Product']['added'][$key]['max_choice']))?$this->request->data['Product']['added'][$key]['max_choice']:'';
        echo $this->Form->input('max_choice',array('name'=>"data[Product][added][$key][max_choice][]",'label'=>false,'class'=>'form-control','value'=>$max_choice)); ?>
   </div>
  </div>
  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">No Of Free modifiers</label>
    <div class="col-sm-9">
      <?php 
          $free = (!empty($this->request->data['Product']['added'][$key]['free']))?$this->request->data['Product']['added'][$key]['free']:0;
        echo $this->Form->number('free',array('name'=>"data[Product][added][$key][free][]",'label'=>false,'class'=>'form-control','value'=>$free)); ?>
   </div>
  </div>
  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Display Price</label>
    <div class="col-sm-9">
      <?php 
        $display_price = (!empty($this->request->data['Product']['added'][$key]['display_price']))?$this->request->data['Product']['added'][$key]['display_price']:0;


        $attributes = array(
            'legend' => false,
            'value' => $display_price,
            'class' => '',
            'hidden'=>false,
            'name'=>"data[Product][added][$key][display_price][]",
        );

        echo $this->Form->radio('display_price', YesNo(), $attributes);
      ?>
   </div>
  </div>
  <div class="form-group col-sm-6">
  <label class="col-sm-3 control-label">Sort Order</label>
    <div class="col-sm-9">
      <?php 
        $sort_order = (!empty($this->request->data['Product']['added'][$key]['sort_order']))?$this->request->data['Product']['added'][$key]['sort_order']:0;
        echo $this->Form->input('sort_order',array('name'=>"data[Product][added][$key][sort_order][]",'options'=>SortLimit(),'label'=>false,'class'=>'form-control','selected'=>$sort_order)); ?>
   </div>
  </div>
</fieldset>
<?php } } ?>

