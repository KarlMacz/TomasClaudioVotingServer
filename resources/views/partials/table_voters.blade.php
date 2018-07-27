<tr>
    <td class="text-center">{{ $voter->id }}</td>
    <td>{{ $voter->full_name() }}</td>
    <td>{{ $voter->account_info->email }}</td>
    <td>{{ $voter->gender }}</td>
    <td>{{ $voter->college }}</td>
    <td>{{ $voter->course }}</td>
    <td class="text-center">
        <a href="{{ route('admin.get.voters_edit', [$voter->id]) }}" class="edit-button button success small"><span class="fas fa-edit"></span></a>
        <button class="delete-button button danger small" data-id="{{ $voter->id }}"><span class="fas fa-trash-alt"></span></button>
    </td>
</tr>
