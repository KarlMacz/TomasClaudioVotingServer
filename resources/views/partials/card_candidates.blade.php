<div class="card" style="width: 200px;">
    <div class="card-image" style="max-height: 200px;">
        <img src="{{ ($candidate->candidacy_image != null ? asset('uploads/' . $candidate->candidacy_image) : asset('img/' . ($candidate->student_info->gender === 'Female' ? 'female.png' : 'male.png'))) }}">
    </div>
    <div class="card-header">
        <div class="card-title">{{ $candidate->student_info->full_name() }}</div>
        <div class="card-subtitle">{{ $candidate->party_info->name }} Party</div>
    </div>
    <div class="card-body"></div>
    <div class="card-footer" style="background-color: #4c9261; color: white; padding-top: 10px;">
        <h2 class="text-center no-margin">{{ $candidate->votes->count() . ($candidate->votes->count() === 1 ? ' vote' : ' votes') }}</h2>
    </div>
</div>
