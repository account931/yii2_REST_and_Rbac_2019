<?php
//View for Booking CPH
//USES ajax, ALL JS IS IN -> web/js/booking_cph.js!!!!

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
//use yii\jui\DatePicker;
//use yii\helpers\BaseHtml;
/* @var $this yii\web\View */




 use app\assets\CPH_AssertOnly;   // use your custom asset
 CPH_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the name of Class)
	   
$this->title = 'Booking';
$this->params['breadcrumbs'][] = $this->title;
?>





  <div class="">
    <h1><?= Html::encode($this->title) ?>  <span class="glyphicon glyphicon-ok-sign"></span> </h1>
  </div>


  <div class="row">
    <div class="col-sm-12 col-xs-12">
    <h3><?php echo "Today: " . date('j-M-D-Y');  // today day ?></h3>
	<hr>
 
 
 
 
    
	
  <!------ FLASH Success from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('successX') ): ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('successX'); ?>
    </div>
    <?php endif;?>
  <!------ END FLASH Successfrom BookingCpg/actionIndex() ----->
	
	
	
	<!------ FLASH FAIL from BookingCpg/actionIndex() ----->
   <?php if( Yii::$app->session->hasFlash('failedX') ): ?>
     <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <?php echo Yii::$app->session->getFlash('failedX'); ?>
		<?php 
		//opens the form 
$js = <<< JS
	//$("#rbacAdd").show(999);
JS;
           $this->registerJs($js);
		   
		?>
	
     </div>
    <?php endif;?>
  <!------ END FAIL Successfrom BookingCpg/actionIndex() ----->
	
	
	
	
	<!----------------------- START hidden FORM SECTION which adds new booking dates ----------------------------->
    <div class="col-sm-12 col-xs-12 rightt">
	   
	   <button class="btn btn-large btn-info" data-toggle="collapse" data-target="#rbacAdd">New booking</button><p></p>
	   <div id="rbacAdd" class="collapse"><br>
	   
           <div class="col-sm-6 col-xs-12">
		   <!----------------- FORM to add new booking to table {} ---------------------->
           <?php 
		    
			echo "<p class='alert-danger'>You are logged as <i class='fa fa-address-book-o' style='font-size:1.3em;'></i> <b>" . Yii::$app->user->identity->username . "</b></p>";
			
			
		
		    $form = ActiveForm::begin (/*[
           'id' => 'login-form',
           'layout' => 'horizontal',
           'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
            'enableAjaxValidation' => true, // my ajax
           ],
           ]*/); ?>

           <?php 
		    //$model->book_user = Yii::$app->user->identity->username; //set default value for $model->book_user with current username 
            //echo $form->field($model, 'book_user')->textInput(['maxlength' => true, /*'value'=> $d*/ ]); //Current logged user
            echo $form->field($model, 'book_guest' /*,  ['enableAjaxValidation' => true]*/)->textInput();
		   /* echo $form->field($model, 'book_from'); */ 
		   /* echo $form->field($model, 'book_to');  */ ?>
		   <!--<lable> from &nbsp;</lable><input type="date" value="" id="calendarPick_from"/> 
		   <lable>&nbsp;&nbsp;&nbsp;to </lable><input type="date" value="" id="calendarPick_to"/><hr>-->
		   
		   
		   <?= $form->field($model, 'book_from' ,['inputOptions' => ['id' => 'uniqueIDFrom',],]) ->input('date') ; //FROM datepicker, html5 inject ?>
		   <?= $form->field($model, 'book_to',   ['inputOptions' => ['id' => 'uniqueIDTo',],])->input('date'); //TO datepicker,html5 inject, can use "color" ?>
		   	   
           
		   
           <div class="form-group">
            <?= Html::submitButton('Add', ['class' => 'btn btn-primary']) ?>
           </div>
           <?php ActiveForm::end(); ?>	
	       <!----------------- END FORM to add new booking to table {} ---------------------->
		   </div>
		   
		   <div class="col-sm-4 col-xs-12">
		   </div>
			
       </div>
	</div><!-- END of class="right"--> <!-- END of RIGHT Block, SECTION to add new RBAC role to auth_items -->
	<!----------------------- END START hidden FORM SECTION which adds new booking dates ----------------------------->
	<br><br><br>
	
	
	
 
 
 
 
  <!------------ Div that will hold all 6 month (htmled with ajax) js/booking_cph.js/function get_6_month()--------> 
  <div class="row all-6-month">
    <?php
	 //START dislaying all future 6 month, was used just for test--------
	 //displays current month ($current is from Controller)
	 /*echo '<div class="col-sm-3 col-xs-5 my-month badge badge1" id="0"><span class="v">' . $current  . '</div>'; 
	
	 //echo 5 future months ($current is from Controller)
	 for ($i = 1; $i < 6; $i++){    //($i=1; $i<4; $i++) // for 5 future months
	     echo '<div class="col-sm-3 col-xs-5 my-month badge badge1" id='. $i . '> <span class="v">' . ${'current'.$i}  . '</span></div>';
	 }*/
	 //END dislaying all future 6 month-------
	?>
  </div><!-- END  class="row all-6-month"-->
  <!------------ END Div that will hold all 6 month (htmled with ajax) js/booking_cph.js/function get_6_month()-------->
  
  
  
	
    <!-- Div that will dispaly 1 single selected month -->
    <div class="col-sm-12 col-xs-12 single-clicked-month">
	    <?php
		    /*foreach($all_records as $i){
				echo "<p style='font-size:1.14em;'>" . $i->book_user . " -> " . $i->book_guest . " from:" . $i->book_from . " to: " . $i->book_to.  " Unix:" . $i->book_from_unix . "/" . $i->book_to_unix ."</p>";
			}*/
		?>
	</div><!-- class "single-clicked-month" -->


    </div><!-- END class="col-sm-12 col-xs-12" -->
  </div> <!-- END class="row" -->
  
  
  <div class="loader" id="loader"></div>