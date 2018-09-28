<h1 class="display-4">
    {{ $card->name }}
</h1>
<p class="text-muted">
    {{ __('Issued:') }} {{ $asset ? $asset->confirmed_at->toFormattedDateString() : __('Syncing') }} &nbsp;&nbsp;&nbsp;
    {{ __('Last Traded:') }} {{ $last_match ? $last_match->confirmed_at->toFormattedDateString() : __('N/A') }}
</p>