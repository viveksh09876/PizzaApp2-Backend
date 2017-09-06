<?php extract($pageVar); ?>
<section class="content">
	<div class="col-md-8 col-md-offset-2">
		<div class="panel-group">
			<div class="panel panel-primary">
				<div class="panel-heading text-center"><h5>WELCOME TO NKD PIZZA</h5></div>
				<div class="panel-body language-panel">
				<?php 
					echo $this->Form->create('Language');
				?>
				<div class="col-md-12 text-center select-lang">
					<div class="col-md-3 col-md-offset-3"><b>Select Language : </b></div>
					<div class="col-md-4">
					<?php
						echo $this->Form->input('id',array('label'=>false,'class'=>'form-control','options'=>$languages));
					?>
					</div>
				</div>	
				<div class="col-md-12 text-center contiue-btn">
				<?php
					echo $this->Form->submit('Continue',array('class'=>'btn btn-primary'));
				?>	
				</div>
				<?php
					echo $this->Form->end();
				?>
			</div>
		</div>
	</div>
</section>
<div class="clearfix"></div>
    

      

 