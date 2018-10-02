<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <img src="{{ $card->meta_data['hd_image_url'] }}" alt="{{ $card->name }}" width="100%" style="max-width: 750px;" />
            </div>
        </div>
    </div>
</div>