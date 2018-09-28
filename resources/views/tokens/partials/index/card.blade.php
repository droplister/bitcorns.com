<div class="card mb-4">
    <div class="card-header">
        {{ ucfirst($token->type) }} Token
    </div>
    <div class="card-body">
        <h4 class="card-title">
            <a href="{{ $token->url }}">
                {{ $token->name }}
                <img class="float-left mr-2" src="{{ $token->image_url }}" alt="{{ $token->name }} Icon" height="30" width="30" />
            </a>
        </h4>
        <p class="card-text">{{ $token->content }}</p>
        <a href="#" class="card-link"><i class="fa fa-info-circle"></i> More Info</a>
        <a href="#" class="card-link" target="_blank"><i class="fa fa-external-link-square"></i> Explorer</a>
    </div>
</div>