<tr>
    <td class="text-center">{{ $student->id }}</td>
    <td>{{ $student->full_name() }}</td>
    <td>{{ $student->college }}</td>
    <td>{{ $student->course }}</td>
    <td class="text-center">{{ $student->year_level }}</td>
    <td class="text-center">{{ ($student->has_voted ? 'Voted' : 'Pending') }}</td>
</tr>
