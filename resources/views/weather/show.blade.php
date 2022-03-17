Pogoda dla {{ $city->city }}<br/><br/>

@foreach($dataseries as $row)
{{ Arr::get($row, 'datetime') }}  {{ Arr::get($row, 'temp') }} *C<br/>
@endforeach
