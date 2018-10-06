<div class="table-responsive">
    <table class="table mb-0 text-left" style="overflow-y: auto;white-space: nowrap;">
        <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Points</th>
                <th scope="col">{{ $locked ? 'Progress' : 'Achieved' }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($achievements as $achievement)
                <tr>
                    <td>
                        <a href="{{ $achievement->achiever->url }}">{{ $achievement->achiever_type === 'App\Farm' ? $achievement->achiever->display_name : $achievement->achiever->name }}</a>
                    </td>
                    <td>{{ number_format($achievement->points) }}</td>
                    @if($locked)
                        <td>{{ number_format($achievement->points / $achievement->details->points * 100) }}%</td>
                    @else
                        <td>{{ $achievement->unlocked_at->format('M d, Y') }}</td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>