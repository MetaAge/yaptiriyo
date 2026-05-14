@extends('backend.layout.master')
@section('title', __('Emergency SOS Requests'))
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-12">
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <div class="customMarkup__single__item__flex">
                            <h4 class="customMarkup__single__title">{{ __('Emergency SOS Requests') }}</h4>
                        </div>
                        <div class="customMarkup__single__inner mt-4">
                            <div class="custom_table style-04">
                                <table class="DataTable_Activation">
                                    <thead>
                                        <tr>
                                            <th>{{ __('ID') }}</th>
                                            <th>{{ __('Client') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Freelancer') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Tracking Status') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($all_emergencies as $emergency)
                                            <tr>
                                                <td>{{ $emergency->id }}</td>
                                                <td>{{ $emergency->client?->fullname }}</td>
                                                <td>{{ $emergency->category?->category }}</td>
                                                <td>{{ $emergency->acceptedFreelancer?->fullname ?? __('Not Assigned') }}</td>
                                                <td>
                                                    @php
                                                        $status_class = match($emergency->status) {
                                                            'pending' => 'info',
                                                            'accepted' => 'primary',
                                                            'completed' => 'success',
                                                            'cancelled' => 'danger',
                                                            'expired' => 'warning',
                                                            default => 'secondary'
                                                        };
                                                    @endphp
                                                    <span class="badge bg-{{ $status_class }}">{{ ucfirst($emergency->status) }}</span>
                                                </td>
                                                <td>
                                                    @if($emergency->freelancer_status)
                                                        <span class="badge bg-info">{{ str_replace('_', ' ', ucfirst($emergency->freelancer_status)) }}</span>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>{{ $emergency->created_at->format('d M Y H:i') }}</td>
                                                <td>
                                                    <div class="dropdownCustom">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                            {{ __('Action') }}
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="{{ route('admin.emergency.details', $emergency->id) }}">{{ __('View Details') }}</a></li>
                                                            <li>
                                                                <form action="{{ route('admin.emergency.delete', $emergency->id) }}" method="POST">
                                                                    @csrf
                                                                    <button type="submit" class="dropdown-item text-danger" onclick="return confirm('{{ __('Are you sure?') }}')">{{ __('Delete') }}</button>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="mt-4">
                                    {{ $all_emergencies->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
