<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0 text-center" style="background: transparent;">
            <div class="modal-body">
                @if(isset($card->meta_data['orientation']) && $card->meta_data['orientation'] === 'portrait')
                    <img src="{{ $card->meta_data['hd_image_url'] }}" alt="{{ $card->name }}" width="100%" style="max-width: 750px;" class="portrait" />
                @else
                    <img src="{{ $card->meta_data['hd_image_url'] }}" alt="{{ $card->name }}" width="100%" style="max-width: 750px;" />
                @endif
            </div>
        </div>
    </div>
</div>