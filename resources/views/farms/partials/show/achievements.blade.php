<div class="row mt-5">
    <div class="col">
        <div class="card">
            <div class="card-header">
                Achievements
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Unlocked</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($achievements as $achievement)
                                <tr>
                                    <td>{{ $achievement->details->name }}</td>
                                    <td>{{ $achievement->details->description }}</td>
                                    <td>{{ $achievement->unlocked_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>