@if($uploads->count() > 0 && $farm->access === 1)
    <div class="row mt-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Art History
                </div>
                <div class="card-body">
                    <div id="carouselExampleControls" class="carousel mb-0 slide" data-ride="carousel" data-interval="false" data-wrap="false">
                        <div class="carousel-inner">
                            @foreach($uploads as $upload)
                                <div class="carousel-item{{ $loop->first ? ' active' : '' }}">
                                    <a href="{{ $upload->new_image_url }}">
                                        <img class="d-block w-100" src="{{ $upload->new_image_url }}" /></a>
                                    </a>
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $upload->created_at->format('M d, Y') }}</h5>
                                    </div>
                                </div>
                                @if($loop->last)
                                    <div class="carousel-item">
                                        <a href="{{ $upload->old_image_url }}">
                                            <img class="d-block w-100" src="{{ $upload->old_image_url }}" />
                                        </a>
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $farm->firstCrops->confirmed_at->format('M d, Y') }}</h5>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif