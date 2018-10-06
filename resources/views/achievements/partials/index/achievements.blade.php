<div class="table-responsive">
    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Requires</th>
                <th scope="col">Unlocked</th>
                <th scope="col">In Progress</th>
            </tr>
        </thead>
        <tbody>
            @foreach($achievements as $achievement)
                <tr>
                    <td>
                        <a href="{{ route('achievements.show', ['achievement' => $achievement->id]) }}">{{ $achievement->name }}</a>
                    </td>
                    <td>{{ $achievement->description }}</td>
                    <td>{{ number_format($achievement->points) }}</td>
                    <td>{{ number_format($achievement->unlocks()->count()) }}</td>
                    <td>{{ number_format($achievement->progress()->where('unlocked_at', '=', null)->count()) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>