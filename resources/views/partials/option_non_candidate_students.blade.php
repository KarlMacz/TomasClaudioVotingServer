@if(!$student->is_candidate())
    <option value="{{ $student->id }}">{{ $student->full_name() }}</option>
@endif
