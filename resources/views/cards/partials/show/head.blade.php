<h1 class="display-4">
    {{ $card->name }}
</h1>
<p class="text-muted">
    {{ __('Issued:') }} {{ $card->asset ? $card->asset->confirmed_at->toFormattedDateString() : __('Syncing') }} &nbsp;&nbsp;&nbsp;
    {{ __('Last Traded:') }} {{ $card->lastMatch() ? $card->lastMatch()->confirmed_at->toFormattedDateString() : __('N/A') }}
</p>