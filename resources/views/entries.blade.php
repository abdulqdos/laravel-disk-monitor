<h1> Disk metrics </h1>

<table>
    <thead>
        <tr>
            <th>Disk name</th>
            <th>File Count</th>
            <th> Recorded at</th>
        </tr>
    </thead>
    <tbody>
    @foreach($entries as $entry)
        <tr>
            <td>
                {{ $entry->disk_name }}
            </td>
            <td>
                {{ $entry->file_count }}
            </td>
            <td>
                {{ $entry->created_at->format('y-m-d H:i:s') }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
