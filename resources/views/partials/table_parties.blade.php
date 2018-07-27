<tr>
    <td class="text-center">{{ $party->id }}</td>
    <td>{{ $party->name }}</td>
    <td class="text-center">
        <a href="{{ route('admin.get.parties_edit', [$party->id]) }}" class="edit-button button success small"><span class="fas fa-edit"></span></a>
        <button class="delete-button button danger small" data-id="{{ $party->id }}"><span class="fas fa-trash-alt"></span></button>
    </td>
</tr>
