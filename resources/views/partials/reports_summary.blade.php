<tr>
    <td class="text-center">{{ $student->id }}</td>
    <td>{{ $student->full_name() }}</td>
    <td>{{ $student->college }}</td>
    <td>{{ $student->course }}</td>
    <td class="text-center">{{ $student->year_level }}</td>
    <td class="text-center">{{ ($student->account_info->has_voted == 1 ? 'Voted' : 'Pending') }}</td>
</tr>
