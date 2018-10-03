<section class="jumbotron text-center" style="background: url({{ $farm->display_image_url }}) no-repeat center center / cover;">
    <a href="{{ route('farms.show', ['farm' => $farm->slug]) }}" class="btn btn-sm btn-light">
        <i class="fa fa-eye"></i> View
    </a>
</section>