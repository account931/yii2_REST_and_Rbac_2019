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
	

	
	
	 //all products array, as if we get from DB
     $productsX = [
      ['id'=> 0, 'name'=> 'Esprit Ruffle Shirt', 'price' => 16.64, 'image' => 'product-01.jpg', 'description' => 'Esprit Ruffle Shirt.....some description'],
      ['id'=> 1, 'name'=> 'Herschel supply',     'price' => 35.31, 'image' => 'product-02.jpg', 'description' => 'Herschel supply.........some description'],
	  ['id'=> 2, 'name'=> 'Classic Trench Coat', 'price' => 75.00, 'image' => 'product-03.jpg', 'description' => 'Classic Trench Coat.....some description'],
	  ['id'=> 3, 'name'=> 'Front Pocket Jumper', 'price' => 75.00, 'image' => 'product-05.jpg', 'description' => 'Front Pocket Jumper.....some description'],
	  
	  ['id'=> 4, 'name'=> 'Shirt in Stretch Cotton', 'price' => 2.66,  'image' => 'product-04.jpg', 'description' => 'some description'],
	  ['id'=> 5, 'name'=> 'Pieces Metallic Printed', 'price' => 18.96, 'image' => 'product-06.jpg', 'description' => 'some description'],
	  ['id'=> 6, 'name'=> 'Femme T-Shirt In Stripe', 'price' => 25.85, 'image' => 'product-07.jpg', 'description' => 'some description'],
	  ['id'=> 7, 'name'=> 'T-Shirt with Sleeve',     'price' => 18.49, 'image' => 'product-08.jpg', 'description' => 'some description'],
  ];
 
  
  $_SESSION['productCatalogue'] = $productsX; //all products from DB to session
  
  
  
  //passing PHP variable {$productsX } to javascript -> 
        use yii\helpers\Json; 
		 $this->registerJs(
            "var productsJS = ". Json::encode($productsX).";",  
             yii\web\View::POS_HEAD, 
            'myproduct-events-script'
     );
	
	
	
	
	
	
	
	
	   //passing PHP variable {currentURL} to javascript ->  
	     $urll = Yii::$app->getUrlManager()->getBaseUrl();
		 //use yii\helpers\Json; 
		 $this->registerJs(
            "var urlX = ". Json::encode($urll).";",  
             yii\web\View::POS_HEAD, 
            'myproduct2-events-script'
     );
	
	if (isset($_SESSION['cart'])){
       
      //passing PHP variable {$_SESSION['cart']} to javascript -> 
        //use yii\helpers\Json; 
		$this->registerJs(
            "var cartJS = ".Json::encode($_SESSION['cart']).";",  
             yii\web\View::POS_HEAD, 
            'myproduct-events-script55'
        ); 
		
		echo "<p>Cart contains <b><span id='countCart'>" . count($_SESSION['cart']) . "</span></b> products</p>";
		var_dump($_SESSION['cart']);
		echo "<br>";
	
	}
    ?>
	
	<!-------------------- Progress Status Icons by component ----------------->
	<?php
	       //display shop timeline progress => Progress Status Icons
	       echo \app\componentsX\views_components\LiqPay\ShopTimelineProgress::showProgress("Cart");
	?>
	<!-------------------- Progress Status Icons by component ----------------->
	
	
	
	
	
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
                                                    <span class="qty-minus my-cart-minus"><i class="fa fa-minus size-x" aria-hidden="true"></i></span>
                                                    
													
													<!--------------    Quantity    --------->
													<input type="number" class="qty-text my-quantity-field qtyXX" id="qty<?=$i?>" step="1" min="1" max="300" name="quantity" value="<?=$value;?>" />
                                                    
													
													<!-------------- CART ++ plus operation --------->
                                                    <span class="qty-plus  my-cart-plus"><button class="my-btn-fix"><i class="fa fa-plus size-x" aria-hidden="true"></i></button></span>
                                                
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
                            <ul class="summary-table list-group testt">
                                <!--<li><span>subtotal:</span> <span>$140.00</span></li>-->
                                <li class="list-group-item"><span>delivery:</span> <span>Free</span></li>
                                <li class="list-group-item"><span>total:</span> <span  id="finalSum"> 0 </span></li>
								<li class="list-group-item"><span>By Object:</span> <span  id="finalSumByObject"> 0 </span></li><!-- just test, erase in production -->
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
