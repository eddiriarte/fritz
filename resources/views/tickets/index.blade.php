@extends('layouts.master')

@section('content')

<div class="container-fluid">
    <table class="table">
        <thead>
            <th scope="col">#</th>
            <th scope="col">Signatur</th>
            <th scope="col">Bild</th>
            <th scope="col">Abfahrtsort</th>
            <th scope="col">Ziel</th>
            <th scope="col">Datum</th>
            <th scope="col">Tags</th>
            <th scope="col">Aktionen</th>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <th scope="row">{{ $ticket->id }}</th>
                    <td>{{ $ticket->signature }}</td>
                    <td><img src="/storage/{{ $ticket->image }}" alt="{{ $ticket->signature }}" class="img-thumbnail"></td>
                    <td>
                        @if ($ticket->pointOfDeparture)
                            <a href="{{ route('locations.edit', ['id' => $ticket->point_of_departure_id]) }}">{{ $ticket->pointOfDeparture->name }}</a>
                        @endif
                    </td>
                    <td>
                        @if ($ticket->destination)
                            <a href="{{ route('locations.edit', ['id' => $ticket->destination_id]) }}">{{ $ticket->destination->name }}</a>
                        @endif        
                    </td>
                    <td>
                        @if ($ticket->date)
                            {{ $ticket->date->format('d / m / Y') }}</td>
                        @endif
                    <td>
                        <ul>
                            @foreach ($ticket->tags as $tag)
                                <li><a href="#">{{ $tag->name }}</a></li>
                            @endforeach
                        </ul>
                    </td>
                    <td class="d-flex">
                        <a href="{{ route('tickets.edit', ['id' => $ticket->id]) }}" class="btn btn-sm btn-primary mr-2" role="button">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        <form method="POST" action="{{ route('tickets.destroy', ['id' => $ticket->id]) }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
    
</body>
</html>
@endsection