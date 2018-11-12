@inject('helper', 'App\Services\ViewsHelperService')

<table class="table table-view {{ isset($table_classes) ? implode(' ', $table_classes) : ''}}">
    @foreach ($fields as $field => $label)
        @if(!$field)
            {{-- Display only label if field not available --}}
            <tr class="active">
                <th>{{ $label }}</th>
                <td></td>
            </tr>
        @elseif($content = $helper->get_dot_notation($entity, $field))
            <tr>
                <th>{{ $label }}</th>
                <td>
                    {!! $content !!}
                </td>
            </tr>
        @endif
    @endforeach
</table>