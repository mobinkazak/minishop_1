<div class="col-md-3 col-md-push-9">
						<div class="sidebar-navigation">
							<?php 
							$resMainCategories=$frontend->getParentCategoryList(0,'title');

							?>
							
							<div class="title">دسته بندی محصولات <i class="fa fa-angle-down"></i></div>
							<?php
							while ($catRows=$frontend->getRow($resMainCategories)) {
								$resSubCat=$frontend->getParentCategoryList($catRows['id'],'title');
							 ?>
							<div class="list">
								<span data-rows="<?php ($resSubCat->num_rows > 0)? print 1: print 0; ?>" class="entry m-closed">
									<span>
									<?php print $catRows['title']; ?>
									</span>
									<span class="pull-left">
									<i class="fa <?php ($resSubCat->num_rows > 0)?print 'fa-angle-left ': print ''; ?>"></i>
										<a style="background-color:#1faabe;color:#fff !important;padding:5px 20px;font-weight:bold;" href="">برو</a>
									</span>

								</span>

								<div class="list-group list-group-flush" style="display:none;">
									<?php 
								while ($catRows2=$frontend->getRow($resSubCat)) {
								?>
									<a class="list-group-item" style="padding: 5px 35px !important;" href=""><?php print $catRows2['title']; ?></a>
									<?php 
								}
								?>
								</div>
								
							</div>
							<?php 
							}
							?>
						</div>
						<div class="clear"></div>
					</div>