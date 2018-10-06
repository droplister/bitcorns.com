<div class="dropdown float-right mt-3 show">
    <a role="button" id="dropdownMenuLink" class="btn btn-primary dropdown-toggle" href="{{ route('achievements.index') }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
       Sort
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
        <h6 class="dropdown-header">
            Difficulty
        </h6>
        <a class="dropdown-item" href="{{ route('achievements.index', ['sort' => 'easy']) }}">
            <i class="fa fa-{{ $sort === 'sortByDesc' ? 'check-' : '' }}circle-o mr-1"></i>
            Easy
        </a>
        <a class="dropdown-item" href="{{ route('achievements.index', ['sort' => 'hard']) }}">
            <i class="fa fa-{{ $sort === 'sortBy' ? 'check-' : '' }}circle-o mr-1"></i>
            Hard
        </a>
    </div>
</div>
<h1 class="display-4 my-5">
    Achievements
</h1>