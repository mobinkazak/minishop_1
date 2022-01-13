
<div class="related-products-wrapper">
	<div class="related-products-carousel">
		<div class="products-top"></div>
		<div class="row product-listing">
			<div id="product-carousel" class="product-listing owl-carousel owl-theme">
				<?php 
					$getReleatedProd=$frontend->getReleatedProd($product['cat_id'],16);
					while($releatedRow=$frontend->getRow($getReleatedProd)){
						$prodUrl=SITE_URL.'/product/'.$releatedRow['id'].'/'.$frontend->dashReplacer($releatedRow['title_en']);
				?>
				<div class="product  item first ">
					<article>
						<figure>
							<span style="border-left:0 !important;z-index: 999999;right:0;font-size:13px" class="rounded-sm w-100 position-absolute py-1 text-white bg-success <?php ($releatedRow['is_special']>0)?print 'd-inline':print 'd-none'; ?>"><?php ($releatedRow['is_special']>0)?print 'محصول ویژه':print ''; ?></span>

							<a href="<?php print $prodUrl; ?>">
								<img src="<?php print $releatedRow['thumb_img']; ?>" class="img-responsive" alt="<?php print $releatedRow['title_fa']; ?>" title="<?php print $releatedRow['title_fa']; ?>">
							</a>
							<figcaption class=" <?php ($releatedRow['discount']>0)?print 'd-block':print 'd-none'; ?>">
								<span><?php print number_format($frontend->toInt($releatedRow['discount'])); ?></span>
								<span>تومان</span>
							</figcaption>

						</figure>
						<h4 class="title py-2 mb-0 text-truncate"><a target="_blank" href="<?php print $prodUrl; ?>" ><?php print $releatedRow['title_fa'] ?></a></h4>
						
						<div class=" col-md-12 col-sm-12 py-2 bg-info text-white" dir="rtl" style="border-bottom:1px solid #e5e5e5;border-left:0 !important;<?php ($releatedRow['discount']>0)?print 'text-decoration: line-through;':print ''; ?> " >
							<span><?php print number_format($frontend->toInt($releatedRow['price'])); ?></span>
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
	</div>
</div>