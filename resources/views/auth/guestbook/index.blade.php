@extends('layouts.app')

@section('title', __('main.guestbook'))

@section('content')
    <div class="col-md-12 container">
        <h1>@lang('main.guestbook')</h1>
        <a class="btn btn-success" type="button" href="{{ route('guestbook.create') }}">@lang('main.add')</a>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    @lang('main.author')
                </th>
                <th>
                    @lang('main.text')
                </th>
                <th>
                    @lang('main.create_date')
                </th>
                <th>
                    @lang('main.update_date')
                </th>
                <th>
                </th>
            </tr>
            @foreach($records as $record)
                <tr>
                    <td>{{ $record->id }}</td>
                    <td>{{ $record->guest->name }}</td>
                    <td>{{ Str::limit($record->comment, 70) }}</td>
                    <td>
                        {{ $record->created_at }}
                    </td>
                    <td>
                        @isset($record->updated_at)
                            {{ $record->updated_at }}
                        @else
                            -
                        @endisset
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('guestbook.destroy', $record) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('guestbook.show', $record) }}">@lang('main.open')</a>
                                <a class="btn btn-warning" type="button" href="{{ route('guestbook.edit', $record) }}">@lang('main.edit')</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="@lang('main.delete')"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mt-2">
            {{ $records->withQueryString()->links() }}
        </div>
    </div>
@endsection
