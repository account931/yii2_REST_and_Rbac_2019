<?php

/* @var $this yii\web\View */

// shop uses 2 $_SESSION vars =>  
//   a.) $_SESSION['productCatalogue'] => contains array of all products (extracted from DB table) (see example at viws/shop-liqpay/index)
//   b.) $_SESSION['cart'] => contains all products a user selected to buy (in format of assoc array('PRODUCR_ID1'=> 5, 'PRODUCR_ID2'=> 3, ))


use yii\helpers\Html;

use app\assets\Shop_LiqPay_AssertOnly;   // use your custom asset
Shop_LiqPay_AssertOnly::register($this); // register your custom asset to use this js/css bundle in this View only(1st name-> is the na

$this->title = 'Cart';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about my-cart">
    <h1><?= Html::encode($this->title) ?></h1>
	
    <?php 
	echo Html::a( '<i class="fa fa-angle-double-left" style="font-size:19px"></i> Go back', ['/shop-liqpay/index', ], $options = ["title" => "go back",] ); 
	
	   //passing PHP variable {currentURL} to javascript ->  
	     $urll = Yii::$app->getUrlManager()->getBaseUrl();
		 use yii\helpers\Json; 
		 $this->registerJs(
            "var urlX = ". Json::encode($urll).";",  
             yii\web\View::POS_HEAD, 
            'myproduct2-events-script'
     );
	
	if (isset($_SESSION['cart'])){
        echo "<p>Cart contains <b><span id='countCart'>" . count($_SESSION['cart']) . "</span></b> products</p>";
		var_dump($_SESSION['cart']);

	
      //passing PHP variable {$_SESSION['cart']} to javascript -> 
        //use yii\helpers\Json; 
		$this->registerJs(
            "var cartJS = ".Json::encode($_SESSION['cart']).";",  
             yii\web\View::POS_HEAD, 
            'myproduct-events-script55'
        ); 
	
	}
    ?>
	
	
	<!-------------------- Progress Status Icons ----------------->
	<div class="row">
	
		  <center>
            <h3 class="shadowX widthX">Status</h3>
			<br>
			
			<div class="row">
			
			  <div class="col-sm-2 col-xs-2">
		          <!--<span class="badge badge-pill badge-secondary myactive-icon">-->
			         <i class="fa fa-shopping-cart" style="font-size:24px; color:black;"></i>
			     <!-- </span> -->
				  <p style="color:black;"><b>Cart</b></p>
			  </div>
			  
			  <div class="col-sm-1 col-xs-1">
			     <p class="line"></p>
			  </div>
			  
			
			  <div class="col-sm-2 col-xs-2 myinactive">
			    <i class="fa fa-tablet" style="font-size:24px"></i>
				<p>Place order</p>
			  </div>
			  
			  <div class="col-sm-1 col-xs-1">
			     <p class="line"></p>
			  </div>
			
			  <div class="col-sm-2 col-xs-2 myinactive">
			    <i class="fa fa-money" style="font-size:24px"></i>
				<p>Payment</p>
			  </div>
			
			  <div class="col-sm-1 col-xs-1">
			     <p class="line"></p>
			  </div>
			  
			  <div class="col-sm-2 col-xs-2 myinactive">
			    <i class="fa fa-check" style="font-size:24px"></i>
				<p>Complete</p>
			  </div>
			
		
		</div>
	  <!--<hr>-->
	  </center>
	</div>	
	<!--------------  END  Progress Status Icons ----------------->
	
	
	
	
	
	<?php
	
	//var_dump($_SESSION['productCatalogue']);
	
	

	
	if ( !isset($_SESSION['cart']) || (count($_SESSION['cart']) == 0) ){
		echo "<h2> So far the cart is empty  <i class='fa fa-cart-arrow-down' aria-hidden='true'></i></h2>";
		echo "<i class='fa fa-question-circle-o' style='font-size:78px;color:red'></i>";
	} else {
	?>

    <!-- ##### Main Content Wrapper Start ##### -->
    <div class="main-content-wrapper d-flex clearfix">

        <div class="cart-table-area section-padding-100">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <div class="cart-title mt-50">
                            <h2 class="shadowX widthX">&nbsp; Shopping Cart</h2>
                        </div>

                        <div class="cart-table clearfix">
                            <table class="table table-responsive table-bordered shadowX">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                    </tr>
                                </thead>
                                <tbody>
								
								
	<!-------------------------------------- Foreach $_SESSION['cart'] to dispaly all cart products --------------------------------------------->
									<?php
									$i = 0;
									//for ($i = 0; $i < count($_SESSION['cart']); $i++) {
									foreach($_SESSION['cart'] as $key => $value){
									    $i++;
										
										 //find in $_SESSION['productCatalogue'] index the product by id
										 $keyN = array_search($key, array_keys($_SESSION['productCatalogue'])); //find in $_SESSION['productCatalogue'] index the product by id
										    
									?>
									
                                    <tr class="list-group-item" id="<?php echo $_SESSION['productCatalogue'][$keyN]['id']; ?>">
                                        <td class="cart_product_img">
										<?php
										   
											//echo image
											echo Html::img(Yii::$app->getUrlManager()->getBaseUrl().'/images/shopLiqPay/' . $_SESSION['productCatalogue'][$keyN]['image'] , $options = ["id"=>"","margin-left"=>"","class"=>"my-one","width"=>"","title"=>"product"]); 
                                            ?>
											<!--<a href="#"><img src="img/bg-img/cart1.jpg" alt="Product"></a>-->
                                        </td>
                                        <td class="cart_product_desc">
                                            <h5> 
											
											    <?php
												//echo product name from $_SESSION['productCatalogue']		
											    echo $_SESSION['productCatalogue'][$keyN]['name'];
											    ?> 
												
												
											</h5>
                                        </td>
										<!-----  1 product Price column --------->
                                        <td class="price">
                                            <span class="priceX"> <?=$_SESSION['productCatalogue'][$keyN]['price'];?> </span>
                                        </td>
                                        <td class="qty border">
                                            <div class="qty-btn d-flex">
                                                <p>Qty</p>
                                                <div class="quantity"> 
												
												    <!-------------- CART -- minus operation --------->
                                                    <span class="qty-minus my-cart-minus"><i class="fa fa-minus" aria-hidden="true"></i></span>
                                                    
													
													<!--------------    Quantity    --------->
													<input type="number" class="qty-text my-quantity-field qtyXX" id="qty<?=$i?>" step="1" min="1" max="300" name="quantity" value="<?=$value;?>" />
                                                    
													
													<!-------------- CART ++ plus operation --------->
                                                    <span class="qty-plus  my-cart-plus"><i class="fa fa-plus" aria-hidden="true"></i></span>
                                                
												</div>
                                            </div>
                                        </td>
                                    </tr>
									
									<!---------------------- END Foreach -------------------------->
									<?php
									}
									?>
									
                                    
								
                                </tbody>
                            </table>
                        </div>
                    </div>
					
					
					<!----------- final general sum in cart ----------------------->
                    <div class="col-12 col-lg-4">
                        <div class="cart-summary shadowX">
                            <h5>Cart Total</h5>
                            <ul class="summary-table list-group">
                                <!--<li><span>subtotal:</span> <span>$140.00</span></li>-->
                                <li class="list-group-item"><span>delivery:</span> <span>Free</span></li>
                                <li class="list-group-item"><span>total:</span> <span  id="finalSum"> 0 </span></li>
                            </ul>
                            <div class="cart-btn mt-100">
							    <?=Html::a( "Check-out", ["/shop-liqpay/check-out"], $options = ["title" => "Check-out", "class" => "btn amado-btn w-100 my-check-out"]); ?>
                                <!--<a href="cart.html" class="btn amado-btn w-100">Checkout</a>-->
                            </div>
                        </div>
                    </div>
					
					
                </div>
            </div>
        </div>
    </div>
    <!-- ##### Main Content Wrapper End ##### -->
	
	
	

<?php
	} //end else (if $_SESSION['productCatalogue'] is SET) of {if (!isset($_SESSION['productCatalogue']}
?>






	

</div>
