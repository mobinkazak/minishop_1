<?php require_once 'loader.php';

$product = $frontend->getProduct($frontend->get('productId'));
if (!isset($product['id'])) {
	$frontend->redirect(SITE_URL);
}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->

<head>
	<title><?php print $product['title_fa']; ?> | <?php print BRAND_NAME; ?></title>
	<base href="<?php print SITE_URL; ?>">

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="meta" content="<?php print $product['meta_keywords']; ?>">
	<meta name="description" content="<?php print $product['meta_desc']; ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Fav icon -->
	<link rel="shortcut icon" href="img/favicon.ico">

	<!-- Font -->
	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap.css">

	<!--flex slider stylesheet-->
	<link rel="stylesheet" href="css/flexslider.css" />
	<!--lightbox stylesheet-->
	<link rel="stylesheet" href="css/image-light-box.css" />

	<!-- Magnific Popup -->
	<link href="css/magnific-popup.css" rel="stylesheet">

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/skin-lblue.css">

	<!-- Owl carousel -->
	<link href="css/owl.carousel.min.css" rel="stylesheet">
	<link href="css/owl.theme.default.min.css" rel="stylesheet">

	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/responsive.css">
	<link rel="stylesheet" href="css/setting.css">
	<link rel="stylesheet" href="css/font-face.css">
	<link rel="stylesheet" href="css/template.css">
	<link rel="stylesheet" href="css/responsive.css">


	<script src="js/vendor/modernizr-2.6.2.min.js"></script>
</head>

<body class="style-14">
	<!--[if lt IE 7]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->


	<!-- Start Loading -->
	<section class="loading-overlay">
		<div class="Loading-Page">
			<h1 class="loader">Loading...</h1>
		</div>
	</section>
	<!-- End Loading  -->

	<!-- start header -->
	<?php require_once 'template/header.php' ?>
	<!-- end header -->

	<!-- start main content -->
	<main class="main-container">

		<section class="product_content_area pt-40" dir="rtl">

			<div class="lookcare-product-single container">

				<div class="row">

					<div class="main col-xs-12" role="main">

						<div class=" product">

							<div class="row">

								<div class="col-md-5 col-sm-6 summary-before ">

									<div class="product-slider product-shop">
										<span class="onsale <?php ($product['is_special'] > 0) ? print 'd-block' : print 'd-none'; ?>"><?php ($product['is_special'] > 0) ? print 'محصول ویژه' : print ''; ?></span>
										<ul class="slides">
											<li data-thumb="<?php print $product['thumb_img']; ?>">
												<a href="<?php print $product['thumb_img']; ?>" data-imagelightbox="gallery" class="hoodie_7_front">
													<img src="<?php print $product['thumb_img']; ?>" class="img-responsive attachment-shop_single" alt="<?php print $product['title_fa']; ?>">
												</a>
											</li>
											<?php
											$product_image = $frontend->getImageProductList($product['id']);
											while ($pimg = $frontend->getRow($product_image)) {
											?>
												<li data-thumb="<?php print $pimg['img']; ?>">
													<a href="<?php print $pimg['img']; ?>" data-imagelightbox="gallery" class="hoodie_7_back">
														<img src="<?php print $pimg['img']; ?>" class="img-responsive attachment-shop_single" alt="<?php print $pimg['alt']; ?>">
													</a>
												</li>
											<?php
											}
											?>


										</ul>
									</div>
								</div>

								<div class="col-sm-6 col-md-7 product-review entry-summary">

									<h1 class="product_title"><?php print $product['title_fa']; ?></h1>

									<!-- <div class="woocommerce-product-rating">
									<div class="star-rating" title="Rated 4.00 out of 5">
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-o"></i>
									</div>
									<a href="#reviews" class="woocommerce-review-link">(<span class="count">3</span> customer reviews)</a>
								</div> -->
									<?php
									if ($product['discount'] == '') {
									?>
										<div>
											<p class="price">
												<ins>
													<span class="amount"><?php print number_format($frontend->toInt($product['price'])); ?></span>
													<span>تومان</span>
												</ins>
											</p>
										</div>
									<?php
									} else {
									?>
										<div>
											<p class="price">
												<del>
													<span class="amount">
														<?php print number_format($frontend->toInt($product['price'])); ?>
													</span>
												</del>
												<ins>
													<span class="amount"><?php print number_format($frontend->toInt($product['discount'])); ?></span>
													<span>تومان</span>
												</ins>
											</p>
										</div>
									<?php
									}
									?>
									<p>
										<?php print $product['short_desc'] ?>
									</p>
									<form class="variations_form cart" action="" method="post">
										<div class="quantity">
											<input type="number" step="1" name="num" value="1" class="input-text qty text" size="4" min="1">
										</div>

										<button type="submit" class="cart-button">افزودن به سبد خرید</button>

									</form>
									<div class="product_meta">
										<?php
										if ($product['model'] != '') {
										?>
											<span class="sku_wrapper">
												مدل محصول :
												<span><?php print $product['model'] ?></span>
											</span>
										<?php
										}
										?>
										<?php
										if ($product['code'] != '') {
										?>
											<span class="sku_wrapper">
												کد محصول :
												<span><?php print $product['code'] ?></span>
											</span>
										<?php
										}
										?>
										<span class="posted_in">دسته بندی ها:
											<a href="#" rel="tag">
												<?php
												$cat_id = $frontend->getCategoryTitle($product['cat_id']);
												$sub_cat_id = $frontend->getCategoryTitle($product['sub_cat_id']);
												print $cat_id['title'];
												?>
											</a>
											,
											<a href="#">
												<?php
												print $sub_cat_id['title'];
												?></a>
										</span>
									</div>


								</div>
								<!-- .summary -->

							</div>

							<div class="wrapper-description">

								<ul class="tabs-nav clearfix">
									<li class="active">توضیحات</li>
									<li>دیدگاه کاربران</li>
								</ul>
								<div class="tabs-container product-comments">

									<div class="tab-content">
										<section class="related-products">

											<h2>درباره محصول</h2>

											<p>
												<?php print html_entity_decode($product['long_desc'], ENT_QUOTES, 'utf-8'); ?>
											</p>
											<hr>
											<h3 class="section-title">محصولات مرتبط</h3>

											<?php require_once 'template/releated_prod.php'; ?>

										</section>
									</div>



									<div class="tab-content">

										<div class="panel entry-content">

											<div id="reviews">
												<div class="row">
													<div class="col-md-6">
														<div id="comments">
															<h3></h3>

															<ol class="commentlist">
																<li class="comment depth-1">

																	<div class="comment_container">

																		<img alt="gravatar" src="img/temp-images/com-grav1.jpg" class="avatar photo">
																		<div class="comment-text">

																			<p class="meta">

																				<strong>جواد</strong>
																				–
																				<time datetime="2013-06-07T13:03:29+00:00">June 7, 2013</time>
																				<span class="star-rating" title="Rated 4.00 out of 5">
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star-o"></i>
																				</span>
																			</p>

																			<div class="description">
																				<p>Another great quality product that anyone who see’s me wearing has asked where to purchase one of their own.</p>
																			</div>
																		</div>
																	</div>
																</li>
																<!-- #comment-## -->
																<li class="comment depth-1">

																	<div class="comment_container">

																		<img alt="gravatar" src="img/temp-images/com-grav1.jpg" class="avatar photo">
																		<div class="comment-text">

																			<p class="meta">

																				<strong>جواد</strong>
																				–
																				<time datetime="2013-06-07T13:03:29+00:00">June 7, 2013</time>
																				<span class="star-rating" title="Rated 4.00 out of 5">
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star"></i>
																					<i class="fa fa-star-o"></i>
																				</span>
																			</p>

																			<div class="description">
																				<p>Another great quality product that anyone who see’s me wearing has asked where to purchase one of their own.</p>
																			</div>
																		</div>
																	</div>
																</li>

																<!-- #comment-## -->

																<!-- #comment-## -->
															</ol>


														</div>

													</div>
													<div class="col-md-6">
														<div id="review_form_wrapper">
															<div id="review_form">
																<div id="respond" class="comment-respond">
																	<h3 class="comment-reply-title">دیدگاه خود را بنویسید</h3>
																	<form action="#" method="post" id="commentform" class="comment-form">
																		<p class="comment-form-author"><label for="author">نام <span class="required">*</span></label> <input id="author" name="author" type="text"></p>
																		<p class="comment-form-email"><label for="email">ایمیل <span class="required">*</span></label> <input id="email" name="email" type="text"></p>
																		<p class="comment-form-comment"><label for="comment">نظر شما</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>
																		<p class="form-submit">
																			<input name="submit" type="submit" id="submit" class="submit" value="ثبت">
																		</p>
																	</form>
																</div>
																<!-- #respond -->
															</div>
														</div>
													</div>
												</div>

												<div class="clear"></div>
											</div>
										</div>
									</div>

								</div>

							</div>





						</div>
						<!-- #product-293 -->



					</div>
					<!-- end of main -->

				</div>
				<!-- end of .row -->

			</div>

		</section>


	</main>
	<!-- end main content -->



	<!-- start footer area -->
	<footer class="footer-area-content">
		<?php require_once 'template/footer.php' ?>
	</footer>
	<!-- footer area end -->


	<!-- All script -->
	<script src="js/vendor/jquery-1.10.2.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/smoothscroll.js"></script>
	<!-- Scroll up js
============================================ -->
	<script src="js/jquery.scrollUp.js"></script>
	<script src="js/menu.js"></script>

	<script src="js/flexslider/jquery.flexslider-min.js"></script>
	<script src="js/image-lightbox/imagelightbox.js"></script>

	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
	<script src="js/app.js"></script>

	<script type="text/javascript">
		if (jQuery().flexslider) {

			// Product Page Flex Slider
			$('.product-slider').flexslider({
				animation: "slide",
				animationLoop: false,
				slideshow: false,
				prevText: '<i class="fa fa-angle-left"></i>',
				nextText: '<i class="fa fa-angle-right"></i>',
				animationSpeed: 250,
				controlNav: "thumbnails"
			});

		}
		/*-----------------------------------------------------------------------------------*/
		/* Product Carousel
		 /*-----------------------------------------------------------------------------------*/
		if (jQuery().owlCarousel) {
			var productCarousel = $("#product-carousel");
			productCarousel.owlCarousel({
				rtl: true,
				margin: 8,
				loop: false,
				dots: true,
				responsive: {
					0: {
						items: 1
					},
					600: {
						items: 3
					},
					1000: {
						items: 4
					}
				}
			});

		}

		/*-----------------------------------------------------------------------------------*/
		/* Tabs
		 /*-----------------------------------------------------------------------------------*/
		$(function() {
			var $tabsNav = $('.tabs-nav'),
				$tabsNavLis = $tabsNav.children('li');

			$tabsNav.each(function() {
				var $this = $(this);
				$this.next().children('.tab-content').stop(true, true).hide()
					.first().show();
				$this.children('li').first().addClass('active').stop(true, true).show();
			});

			$tabsNavLis.on('click', function(e) {
				var $this = $(this);
				$this.siblings().removeClass('active').end()
					.addClass('active');
				var idx = $this.parent().children().index($this);
				$this.parent().next().children('.tab-content').stop(true, true).hide().eq(idx).fadeIn();
				e.preventDefault();
			});

		});

		/*-----------------------------------------------------------------------------------*/
		/*	Tabs Widget
		 /*-----------------------------------------------------------------------------------*/
		$('.footer .tabbed .tabs li:first-child, .tabbed .tabs li:first-child').addClass('current');
		$('.footer .block:first, .tabbed .block:first').addClass('current');


		$('.tabbed .tabs li').on("click", function() {
			var $this = $(this);
			var tabNumber = $this.index();

			/* remove current class from other tabs and assign to this one */
			$this.siblings('li').removeClass('current');
			$this.addClass('current');

			/* remove current class from current block and assign to related one */
			$this.parent('ul').siblings('.block').removeClass('current');
			$this.closest('.tabbed').children('.block:eq(' + tabNumber + ')').addClass('current');
		});


		/*-----------------------------------------------------------------------------------*/
		/*	Image Lightbox
		 /*  http://osvaldas.info/image-lightbox-responsive-touch-friendly
		 /*-----------------------------------------------------------------------------------*/
		if (jQuery().imageLightbox) {

			// ACTIVITY INDICATOR

			var activityIndicatorOn = function() {
					$('<div id="imagelightbox-loading"><div></div></div>').appendTo('body');
				},
				activityIndicatorOff = function() {
					$('#imagelightbox-loading').remove();
				},


				// OVERLAY

				overlayOn = function() {
					$('<div id="imagelightbox-overlay"></div>').appendTo('body');
				},
				overlayOff = function() {
					$('#imagelightbox-overlay').remove();
				},


				// CLOSE BUTTON

				closeButtonOn = function(instance) {
					$('<button type="button" id="imagelightbox-close" title="Close"></button>').appendTo('body').on('click touchend', function() {
						$(this).remove();
						instance.quitImageLightbox();
						return false;
					});
				},
				closeButtonOff = function() {
					$('#imagelightbox-close').remove();
				},

				// ARROWS

				arrowsOn = function(instance, selector) {
					var $arrows = $('<button type="button" class="imagelightbox-arrow imagelightbox-arrow-left"></button><button type="button" class="imagelightbox-arrow imagelightbox-arrow-right"></button>');

					$arrows.appendTo('body');

					$arrows.on('click touchend', function(e) {
						e.preventDefault();

						var $this = $(this),
							$target = $(selector + '[href="' + $('#imagelightbox').attr('src') + '"]'),
							index = $target.index(selector);

						if ($this.hasClass('imagelightbox-arrow-left')) {
							index = index - 1;
							if (!$(selector).eq(index).length)
								index = $(selector).length;
						} else {
							index = index + 1;
							if (!$(selector).eq(index).length)
								index = 0;
						}

						instance.switchImageLightbox(index);
						return false;
					});
				},
				arrowsOff = function() {
					$('.imagelightbox-arrow').remove();
				};

			// Lightbox for individual image
			var lightboxInstance = $('a[data-imagelightbox="lightbox"]').imageLightbox({
				onStart: function() {
					overlayOn();
					closeButtonOn(lightboxInstance);
				},
				onEnd: function() {
					closeButtonOff();
					overlayOff();
					activityIndicatorOff();
				},
				onLoadStart: function() {
					activityIndicatorOn();
				},
				onLoadEnd: function() {
					activityIndicatorOff();
				}
			});

			// Lightbox for product gallery
			var gallerySelector = 'a[data-imagelightbox="gallery"]';
			var galleryInstance = $(gallerySelector).imageLightbox({
				quitOnDocClick: false,
				onStart: function() {
					overlayOn();
					closeButtonOn(galleryInstance);
					arrowsOn(galleryInstance, gallerySelector);
				},
				onEnd: function() {
					overlayOff();
					closeButtonOff();
					arrowsOff();
					activityIndicatorOff();
				},
				onLoadStart: function() {
					activityIndicatorOn();
				},
				onLoadEnd: function() {
					activityIndicatorOff();
					$('.imagelightbox-arrow').css('display', 'block');
				}
			});

		}
	</script>
</body>

</html>