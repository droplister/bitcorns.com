<div class="content">
    <div class="container">
        @include('partials.session')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        @include('farms.partials.edit.menu', ['tab' => 'profile'])
                    </div>
                    <div class="card-body">
                        @include('farms.partials.edit.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>