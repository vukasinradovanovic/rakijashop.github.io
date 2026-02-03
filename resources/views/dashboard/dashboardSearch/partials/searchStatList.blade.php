@foreach ($allData as $data)
<tr>
    <td>{{ strtolower($data->name) }}</td>
    <td>{{ strtolower($data->type) }}</td>
    <td>{{ $data->count }}</td>
</tr>
@endforeach