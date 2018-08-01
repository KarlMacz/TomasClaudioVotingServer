<tr>
    <td class="text-center">{{ $candidate->id }}</td>
    <td>{{ $candidate->student_info->full_name() }}</td>
    <td>{{ $candidate->position_info->name }}</td>
    <td>{{ $candidate->party_info->name }}</td>
    <td class="text-right">{{ $candidate->votes->count() }}</td>
</tr>
