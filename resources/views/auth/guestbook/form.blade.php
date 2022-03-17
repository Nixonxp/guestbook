@extends('layouts.app')

@isset($guestbook)
    @section('title', __('main.edit'))
@else
    @section('title', __('main.create'))
@endisset

@section('content')
    <div class="col-md-12 container">
        <h1>@yield('title')</h1>
        <form method="POST" enctype="multipart/form-data"
              @isset($guestbook)
              action="{{ route('guestbook.update', $guestbook) }}"
              @else
              action="{{ route('guestbook.store') }}"
            @endisset
        >
            <div>
                @isset($guestbook)
                    @method('PUT')
                @endisset
                @if($errors->any())
                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first() }}
                            </div>
                        </div>
                    </div>
                @endif
                @csrf
                    <div class="input-group row">
                        <label for="user_id" class="col-sm-2 col-form-label">@lang('main.author') </label>
                        <div class="col-sm-6">
                            <select name="user_id" id="user_id" class="form-control">
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}"
                                            @isset($guestbook)
                                            @if($guestbook->guest->id == $user->id)
                                            selected
                                        @endif
                                        @endisset
                                    >{{ $user->name }} [{{ $user->email }}]</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                <br>
                <div class="input-group row">
                    <label for="comment" class="col-sm-2 col-form-label">@lang('main.text') </label>
                    <div class="col-sm-6">
								<textarea name="comment" id="comment" cols="72"
                                          rows="7">@isset($guestbook){{ $guestbook->comment }}@endisset</textarea>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">@lang('main.save')</button>
            </div>
        </form>
    </div>
@endsection
