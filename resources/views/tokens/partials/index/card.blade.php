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
    </div>
</div>