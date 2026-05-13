@extends('backend.layout.master')
@section('title', __('All Reels'))
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-validation.error/>
                <x-msg.success/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('All Reels')}}</h4>
                        </div>
                        <div class="table-wrap table-responsive">
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
                                                <small>(@{{$reel->user->username}})</small>
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
                                            <a href="{{asset('assets/uploads/reels/'.$reel->video)}}" target="_blank" class="btn btn-info btn-xs">
                                                <i class="ti-video-camera"></i> {{__('View Video')}}
                                            </a>
                                        </td>
                                        <td>{{Str::limit($reel->description, 50)}}</td>
                                        <td>
                                            <x-delete-popover :url="route('admin.reels.delete',$reel->id)"/>
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
@endsection
