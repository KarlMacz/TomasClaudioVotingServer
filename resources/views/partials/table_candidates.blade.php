<tr>
    <td class="text-center">{{ $candidate->id }}</td>
    <td>{{ $candidate->student_info->full_name() }}</td>
    <td>{{ $candidate->party_info->name }}</td>
    <td>{{ $candidate->position_info->name }}</td>
    <td class="text-center">
        <button class="button info small"><span class="fas fa-bars"></span></button>
        <button class="button success small"><span class="fas fa-edit"></span></button>
        <button class="button danger small"><span class="fas fa-trash-alt"></span></button>
    </td>
</tr>
