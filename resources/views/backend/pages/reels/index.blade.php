@extends('backend.layout.master')
@section('title', __('All Reels'))
@section('style')
    <x-data-table.data-table-css />
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('All Reels') }}</h4>
                        </div>
                        <x-validation.error />
                        <div class="customMarkup__single__inner mt-4">
                            <div class="custom_table style-04 search_result">
                                <table class="table table-default">
                                    <thead>
                                    <th>{{__('ID')}}</th>
                                    <th>{{__('User')}}</th>
                                    <th>{{__('Thumbnail')}}</th>
                                    <th>{{__('Video')}}</th>
                                    <th>{{__('Description')}}</th>
                                    <th>{{__('Action')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($all_reels as $reel)
                                        <tr>
                                            <td>{{$reel->id}}</td>
                                            <td>
                                                @if($reel->user)
                                                    {{$reel->user->first_name}} {{$reel->user->last_name}}
                                                    <br>
                                                    <small>(@ {{$reel->user->username}})</small>
                                                @else
                                                    <span class="text-danger">{{__('User not found')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($reel->thumbnail)
                                                    <img src="{{asset('assets/uploads/reels/thumbnails/'.$reel->thumbnail)}}" style="width: 80px; border-radius: 5px;" alt="">
                                                @else
                                                    <span class="text-muted">{{__('No Thumbnail')}}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{asset('assets/uploads/reels/'.$reel->video)}}" target="_blank" class="btn btn-info btn-xs text-white">
                                                    <i class="ti-video-camera"></i> {{__('View Video')}}
                                                </a>
                                            </td>
                                            <td>{{Str::limit($reel->description, 50)}}</td>
                                            <td>
                                                <x-popup.delete-popup :url="route('admin.reels.delete',$reel->id)"/>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="pagination">
                                {{$all_reels->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-sweet-alert.sweet-alert2-js />
@endsection
