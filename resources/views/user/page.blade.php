{{-- resources/views/clips/index.blade.php --}}

@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

        <!-- Display Validation Errors -->
        @include('common.errors')

        <!-- New clip Form -->
        <div class="clips-container">
            @include('block.user.left')

            <div class="col-4"><div>
                <form action="/clip" method="POST" class="form-horizontal elementCards maxPadding" enctype="multipart/form-data" ng-controller="newClip">
                    {{ csrf_field() }}

                   <!-- clip Audio file -->
                    <div class="form-group">
                        <div class="record-button">
                            <span ng-click="start($event)">Record</span>
                            <div class="record-option">
                                <div id="recordCircle" class="rcircle">
                                    <button class="stop-rec button-circle" ng-click="stop($event)">Stop</button>
                                    <button class="start-rec btn btn-default re-record" ng-click="start($event)">Restart</button>
                                </div>
                                 <input type="hidden" name="audio" id="clip-audio" class="form-control">
                            </div>
                            <div class="message-option">
                                 <input type="text" name="caption" id="clip-caption" class="form-control" size="60" placeholder="Text">

                                <button type="submit" class="btn btn-default" >
                                    <i class="fa fa-plus"></i> Add clip
                                </button>
                            </div>
                        </div>
                            <!--<svg class="spinner-container" width="50px" height="50px" viewBox="0 0 52 52">
                              <circle class="path" cx="26px" cy="26px" r="20px" fill="none" stroke-width="3px"></circle>
                            </svg>-->
                    </div>
                </form>

        <!-- Current clips -->
            @if (count($clips) > 0)
               <ul class="clips_content">
                @foreach ($clips as $clip)
                <li>
                    <div class="elementCards maxPadding" clips>
                        <!-- clip Caption -->
                        <div>{{ $clip->user->name }}</div>
                        <div>{{ $clip->caption }}</div>
                        <div class="clips-wave">
                            <div class="wave-controller play"><div class="player-morf"></div></div>
                            <div class="wave" data-url="{{ $url_clip_upload }}/{{ $clip->url_clip }}"></div>
                        </div>
                        <!--<div><audio src="{{ $url_clip_upload }}/{{ $clip->url_clip }}" controls ></audio></div>-->

                         <!-- Delete Button -->
                        <div class="options-clip">
                            <form action="/clip/{{ $clip->id }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <ul>
                                        <li class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                            <span class="caret"></span>
                                        </a>

                                        <ul class="dropdown-menu" role="menu">
                                            <li><button class="link-style">Delete Clip</button></li>
                                        </ul>
                                    </li>
                                </ul>
                            </form>
                        </div>


                    </div>
                </li>
                @endforeach
            </ul>
            @endif
        </div></div>
        <div class="col-2">
            <div class="col-pad">
                <div pin-to=".clips-container">
                    <div class="user elementCards">

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection