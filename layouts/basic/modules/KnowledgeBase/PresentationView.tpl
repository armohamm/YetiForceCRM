{*<!-- {[The file is published on the basis of YetiForce Public License that can be found in the following directory: licenses/License.html]} --!>*}
	<div class="col-xs-12 knowledgePresentation">
		<div id="carouselPresentation" class="carousel slide" data-interval="false">
			<div class="row">
				<div class="knowledgePresentationInner">
					<div class="carousel-inner">
						{foreach from=$CONTENT item=SLIDE name=carousel}
						<div class="item{if $smarty.foreach.carousel.first} active{/if}">
							<div class="carousel-content knowledgePresentationContent">
								<div>
									<h3>#{$smarty.foreach.carousel.iteration}</h3>
									<span class="knowledgePresentationText">
										{$SLIDE}
									</span>
								</div>
							</div>
						</div>
						{/foreach}
					</div>
				</div>
			</div>

			<a class="left carousel-control knowledgePresentationControl" href="#carouselPresentation" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only">{vtranslate('LBL_PREVIOUS',$MODULE_NAME)}</span>
			</a>
			<a class="right carousel-control knowledgePresentationControl" href="#carouselPresentation" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only">{vtranslate('LBL_NEXT',$MODULE_NAME)}</span>
			</a>
		</div>
	</div>
