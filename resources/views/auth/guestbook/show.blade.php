@extends('layouts.app')

@section('title', __('main.record_from') . $guestbook->guest->name)

@section('content')
    <div class="col-md-12 container">
        <h1>@yield('title')</h1>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    @lang('main.field')
                </th>
                <th>
                    @lang('main.value')
                </th>
            </tr>
            <tr>
                <td>ID</td>
                <td>{{ $guestbook->id}}</td>
            </tr>
            <tr>
                <td>@lang('main.author')</td>
                <td>{{ $guestbook->guest->name }}</td>
            </tr>
            <tr>
                <td>@lang('main.text')</td>
                <td>{{ $guestbook->comment }}</td>
            </tr>
            <tr>
                <td>@lang('main.create_date')</td>
                <td>{{ $guestbook->created_at }}</td>
            </tr>
            <tr>
                <td>@lang('main.update_date')</td>
                <td>@isset($guestbook->updated_at)
                        {{ $guestbook->updated_at }}
                    @else
                        -
                    @endisset</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
