@extends('layouts.app')
@section('title', isset($profile->login) ? 'Профиль пользователя '.$profile->login: $errors->first())
@section('title-category', isset($profile->login) ? 'Профиль пользователя '.$profile->login: $errors->first())
@section('description', $description ?? env('APP_DESCRIPTION_SITE'))
@section('content')
    @include('errors.profile')
    <ul class="nav nav-tabs md-tabs info-color-dark" id="myTabMD" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab-md" data-toggle="tab"
               href="#{{ $profile->login }}" role="tab"
               aria-controls="{{ $profile->login }}" aria-selected="true">Профиль</a>
        </li>
        @if(Auth::check())
            @if(Auth::id() === $profile->id)
                <li class="nav-item">
                    <a class="nav-link" id="edit-tab-md" data-toggle="tab"
                       href="#Edit-{{ $profile->login }}"
                       role="tab" aria-controls="Edit-{{ $profile->login }}" aria-selected="false">Редактировать</a>
                </li>
            @endif
        @endif
    </ul>
    <div class="tab-content card pt-5" id="myTabContentMD">
        <div class="tab-pane fade show active" id="{{ $profile->login }}" role="tabpanel"
             aria-labelledby="{{ $profile->login }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 d-flex flex-column justify-content-between">
                        @include('profile.panels.main')
                    </div>
                    <div class="col-md-3 d-flex mb-2">
                        <div class="avatar mx-4 w-100 white d-flex justify-content-center align-items-center">
                            <img src="{{ !empty($profile->photo) ?
                                    asset('storage/avatars/'. $profile->photo) :
                                    asset('images/no_avatar.png' )}}"
                                 class="img-fluid z-depth-1" alt="{{ $profile->login }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::check())
            @if(Auth::id() === $profile->id)
                <div class="tab-pane fade" id="Edit-{{ $profile->login }}" role="tabpanel"
                     aria-labelledby="Edit-{{ $profile->login }}">
                    @include('profile.panels.edit')
                </div>
            @endif
        @endif
    </div>
@endsection
