<h1 class="display-4 my-5" style="white-space: nowrap;">
    <img loading="lazy" src="{{ $token->image_url }}" alt="{{ $token->name }}" class="float-left mr-3" width="60" />
    {{ $token->name }} <small class="lead d-none d-sm-inline">{{ ucfirst($token->type) }} Token</small>
</h1>