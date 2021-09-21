<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0 text-center" style="background: transparent;">
            <div class="modal-body">
                @if(isset($card->meta_data['orientation']) && $card->meta_data['orientation'] === 'landscape')
                    <img loading="lazy" src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" class="landscape" />
                @else
                    <img loading="lazy" src="{{ $card->image_url }}" alt="{{ $card->name }}" width="100%" />
                @endif
            </div>
        </div>
    </div>
</div>