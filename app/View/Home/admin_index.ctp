<?php extract($pageVar); ?>
<div class="col-md-12" style="margin-bottom:5%;">
	<section class="content-header">
		<h1><?=$title?></h1>
		<ol class="breadcrumb">
			<?=$breadcrumb?>
		</ol>
	</section>
</div>
<section class="content">
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="col-md-12">
	<div class="panel-group">
		<div class="panel panel-primary welcome">
                        <section class="content">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?=$product_count?>+
                    </h3>
                    <p>
                        Products
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="<?=ADMIN_WEBROOT?>product" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?=$modifier_groups_count?>+
                    </h3>
                    <p>
                        Modifier Groups
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="<?=ADMIN_WEBROOT?>modifier" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?=$modifier_count?>+
                    </h3>
                    <p>
                        Modifiers
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?=ADMIN_WEBROOT?>modifier/options" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6">
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?=$choice_count?>+
                    </h3>
                    <p>
                        Choices
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?=ADMIN_WEBROOT?>modifier/sub_options" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>




			<div class="panel-heading" style="height:100%;">NKD PIZZA Admin Panel</div>
		</div>
	</div>
</div>
</section>
<div class="clearfix"></div>
    

      

 