<div id="resultContainer">
	<div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
		@foreach($universities as $university)
		<div class="col">
			<a href="/detail/{{$university->id}}" class="card-link">
				<div class="card h-100 text-center overflow-hidden" style="border: 1px solid #ddd; border-radius: 8px;">
					<div style=" text-align: left;" class="card-body d-flex flex-column align-items-start p-3">
						<div class="profile-photo mb-3">
							<img src="https://cdn-new.topcv.vn/unsafe/140x/https://static.topcv.vn/company_logos/cong-ty-tnhh-cnv-holdings-7520148eeea2bdf172c68a89e29a6d28-66fe67072e3ed.jpg" width="80" height="80" class="img-fluid rounded-circle" alt="{{ $university->name }}">
						</div>
						<h5 class="mb-2" style="font-size: 1.1em; font-weight: bold;">{{ $university->name }}</h5>
						<p class="text-muted mb-3" style="font-size: 0.9em; color: #666;">{{ Str::limit($university->description, 100, '...') }}</p>
						<a class="btn btn-outline-primary btn-sm px-4" href="{{ $university->website_url }}">Theo dõi</a>
					</div>
				</div>
			</a>
		</div>
		@endforeach
	</div>
</div>