<div class="container">
	<div class="row">
		<div class="col-md-12">
			<section class="related-products">
				<!-- Block heading two -->
				<div class="block-heading-two">
					<h3><span>محصولات ویژه</span></h3>
				</div>
						<!-- <div class="product-control-nav">
							<a class="prev"><i class="fa fa-angle-left"></i></a>
							<a class="next"><i class="fa fa-angle-right"></i></a>
						</div> -->
						<div class="row product-listing">
							<div id="product-carousel" class="product-listing owl-carousel owl-theme">
								<?php
								$specialProd=$frontend->getSpecialProd(10);
								while ($specialRows=$frontend->getRow($specialProd)) {
									$prodUrl=SITE_URL.'/product/'.$specialRows['id'].'/'.$frontend->dashReplacer($specialRows['title_en']);

								?>
								<div class="product  item first ">
									<article>
										<figure>
											<a target="_blank" href="<?php print $prodUrl; ?>" >
												<img src="<?php print SITE_URL.$specialRows['thumb_img'] ?>" class="img-responsive" alt="<?php print $specialRows['title_fa'] ?>" title="<?php print $specialRows['title_fa'] ?>" >
											</a>
											<figcaption class=" <?php ($specialRows['discount']!='')?print 'd-block':print 'd-none'; ?>">
											<span><?php print number_format($frontend->toInt($specialRows['discount'])); ?></span>
											<span>تومان</span>
											</figcaption>
										</figure>
										<h4 class="title py-2 mb-0"><a target="_blank" href="<?php print $prodUrl; ?>" ><?php print $specialRows['title_fa'] ?></a></h4>
										
										<div class="title-farsi col-md-12 col-sm-12 py-2 bg-info text-white" dir="rtl" style="border-bottom:1px solid #e5e5e5;border-left:0 !important;<?php ($specialRows['discount']!='')?print 'text-decoration: line-through;':print ''; ?> " >
											<span><?php print number_format($frontend->toInt($specialRows['price'])); ?></span>
											<span>تومان</span>
										</div>
										
										<a href="#" class="rounded-0 button-add-to-cart btn w-100 col-sm-12 col-md-12"><i class="fa fa-shopping-cart"></i> افزودن به سبد خرید </a>
									</article>
								</div>
								<?php
								}
								?>
							</div>
						</div>
			</section>
		</div>
	</div>
</div>
