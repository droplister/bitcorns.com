<div class="position-relative">
    <a href="{{ url(route('farms.edit', ['farm' => $farm->slug])) }}" class="btn btn-sm btn-light btn-absolute">
        <i class="fa fa-edit"></i> Edit
    </a>
    <img loading="lazy" src="{{ $farm->display_image_url }}" alt="{{ $farm->name }}" width="100%" height="auto" />
</div>