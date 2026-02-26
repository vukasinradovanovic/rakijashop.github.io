@foreach ($allData as $data)
<tr>
    <td>{{ mb_strtolower($data->name) }}</td>
    <td>{{ mb_strtolower($data->type) }}</td>
    <td>{{ $data->count }}</td>
</tr>
@endforeach