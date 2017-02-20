{if $content|trim}
	{capture name="text_banner_move"}
		<div class="banner-main">
			<div class="container-fluid">
			{$content nofilter}
			</div>
		</div>
	{/capture}
{/if}