<div class="col-md-12">
	<div class="page-header">
		<div class="row">
			<div class="col-md-10">
				<h4 class="header-indent-left">{{ $title }}</h4>
			</div>
			<div class="col-md-2 vcenter text-right">
				<div class="header-indent-right">
					@if(isset($links))
						@foreach($links as $link)
							<a href="{{ $link['route'] or '#' }}"
							   title="{{ $link['button_title'] or '' }}">{!!  $link['content'] or '' !!}</a>
						@endforeach
					@endif
				</div>
			</div>
		</div>


	</div>
</div>
