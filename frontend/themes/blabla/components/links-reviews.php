<div class="reviews">
	<button type="submit" value="<?= Comment::RATING_GOOD ?>">
		<svg><use xlink:href="#positive"></use></svg>
	</button> 

	<button type="submit" value="<?= Comment::RATING_NEUTRAL ?>">
		<svg><use xlink:href="#neutral"></use></svg>
	</button> 

	<button type="submit" value="<?= Comment::RATING_BAD ?>">
		<svg class="jump"><use xlink:href="#negative"></use></svg>
	</button>
</div>