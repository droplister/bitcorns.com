<div class="content">
    <div class="container">
        @include('partials.session')
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs" id="editTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">
                                    Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="upload-tab" data-toggle="tab" href="#upload" role="tab" aria-controls="upload" aria-selected="true">
                                    Image
                                </a>
                            </li>
                            <li class="nav-item d-none d-sm-inline">
                                <a class="nav-link" id="coop-tab" data-toggle="tab" href="#coop" role="tab" aria-controls="coop" aria-selected="true">
                                    Coop
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="editTabContent">
                            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @include('farms.partials.edit.forms.profile')
                            </div>
                            <div class="tab-pane fade" id="upload" role="tabpanel" aria-labelledby="upload-tab">
                                @include('farms.partials.edit.forms.upload')
                            </div>
                            <div class="tab-pane fade" id="coop" role="tabpanel" aria-labelledby="coop-tab">
                                @include('farms.partials.edit.forms.coop')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>