<tr>
    <td class="text-center">{{ $position->id }}</td>
    <td>{{ $position->name }}</td>
    <td class="text-center">
        <a href="{{ route('admin.get.positions_edit', [$position->id]) }}" class="edit-button button success small"><span class="fas fa-edit"></span></a>
        <button class="delete-button button danger small" data-id="{{ $position->id }}"><span class="fas fa-trash-alt"></span></button>
    </td>
</tr>
