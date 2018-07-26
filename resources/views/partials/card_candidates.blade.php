<div class="card">
    <div class="card-image">
        <img src="{{ asset('img/test_image.png') }}">
    </div>
    <div class="card-header">
        <div class="card-title">{{ $candidate->student_info->full_name() }}</div>
        <div class="card-subtitle">{{ $candidate->party_info->name }} Party</div>
    </div>
    <div class="card-body">
        <div class="progress">
            <div class="progress-bar" style="width: 50%;"></div>
            <div class="progress-text">{{ $candidate->votes->count() . ($candidate->votes->count() === 1 ? ' vote' : ' votes') }}</div>
        </div>
    </div>
</div>
