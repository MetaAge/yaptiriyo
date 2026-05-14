@extends('backend.layout.master')
@section('title', __('Emergency SOS Details'))
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Emergency SOS Details') }} #{{ $emergency->id }}</h4>
                            <a href="{{ route('admin.emergency.all') }}" class="btn btn-primary">{{ __('Back to List') }}</a>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h5>{{ __('Client Information') }}</h5></div>
                                    <div class="card-body">
                                        <p><strong>{{ __('Name') }}:</strong> {{ $emergency->client?->fullname }}</p>
                                        <p><strong>{{ __('Email') }}:</strong> {{ $emergency->client?->email }}</p>
                                        <p><strong>{{ __('Phone') }}:</strong> {{ $emergency->client?->phone }}</p>
                                        <p><strong>{{ __('Address') }}:</strong> {{ $emergency->address }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header"><h5>{{ __('Freelancer Information') }}</h5></div>
                                    <div class="card-body">
                                        @if($emergency->acceptedFreelancer)
                                            <p><strong>{{ __('Name') }}:</strong> {{ $emergency->acceptedFreelancer->fullname }}</p>
                                            <p><strong>{{ __('Phone') }}:</strong> {{ $emergency->acceptedFreelancer->phone }}</p>
                                            <p><strong>{{ __('Tracking Status') }}:</strong> {{ str_replace('_', ' ', ucfirst($emergency->freelancer_status)) }}</p>
                                            @if($emergency->freelancer_lat && $emergency->freelancer_long)
                                                <p><strong>{{ __('Location') }}:</strong> 
                                                    <a href="https://www.google.com/maps/search/?api=1&query={{ $emergency->freelancer_lat }},{{ $emergency->freelancer_long }}" target="_blank" class="btn btn-sm btn-info">
                                                        <i class="fas fa-map-marker-alt"></i> {{ __('View on Google Maps') }}
                                                    </a>
                                                </p>
                                            @endif
                                        @else
                                            <p class="text-muted">{{ __('No freelancer accepted yet.') }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h5>{{ __('Request Details') }}</h5></div>
                                    <div class="card-body">
                                        <p><strong>{{ __('Category') }}:</strong> {{ $emergency->category?->category }}</p>
                                        <p><strong>{{ __('Status') }}:</strong> {{ ucfirst($emergency->status) }}</p>
                                        <p><strong>{{ __('Description') }}:</strong></p>
                                        <div class="p-3 bg-light border rounded">
                                            {{ $emergency->description }}
                                        </div>
                                        <p class="mt-3"><strong>{{ __('Created At') }}:</strong> {{ $emergency->created_at->format('d M Y H:i:s') }}</p>
                                        @if($emergency->accepted_at)
                                            <p><strong>{{ __('Accepted At') }}:</strong> {{ \Carbon\Carbon::parse($emergency->accepted_at)->format('d M Y H:i:s') }}</p>
                                        @endif
                                        <p><strong>{{ __('Expires At') }}:</strong> {{ \Carbon\Carbon::parse($emergency->expires_at)->format('d M Y H:i:s') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header"><h5>{{ __('Offers Received') }} ({{ $emergency->offers->count() }})</h5></div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('Freelancer') }}</th>
                                                    <th>{{ __('Price') }}</th>
                                                    <th>{{ __('Status') }}</th>
                                                    <th>{{ __('Created At') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($emergency->offers as $offer)
                                                    <tr class="{{ $offer->status == 'accepted' ? 'table-success' : '' }}">
                                                        <td>{{ $offer->freelancer?->fullname }}</td>
                                                        <td>{{ amount_with_currency_symbol($offer->offered_price) }}</td>
                                                        <td>{{ ucfirst($offer->status) }}</td>
                                                        <td>{{ $offer->created_at->format('d M Y H:i') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
