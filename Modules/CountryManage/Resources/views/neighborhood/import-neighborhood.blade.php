@extends('backend.layout.master')
@section('title', __('Import Neighborhoods'))
@section('style')
    <x-data-table.data-table-css />
@endsection
@section('content')
    <div class="dashboard__body">
        <div class="row">
            <div class="col-lg-8">
                <x-validation.error/>
                <div class="customMarkup__single">
                    <div class="customMarkup__single__item">
                        <h4 class="customMarkup__single__title">{{ __('Import Neighborhood (only csv file)') }}</h4>
                        <div class="customMarkup__single__inner mt-4">
                            @if(empty($import_data))
                                <form action="{{route('admin.neighborhood.import.csv.update.settings')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="#" class="label-title">{{__('File')}}</label>
                                        <input type="file" name="csv_file" accept=".csv" class="form-control" required>
                                        <div class="info-text">{{__('only csv file are allowed with separate by (,) comma.')}}</div>
                                    </div>
                                    <button type="submit" class="btn btn-primary loading-btn">{{__('Submit')}}</button>
                                </form>
                            @else
                                @php
                                    $option_markup = '';
                                    foreach(current($import_data) as $map_item ){
                                        $option_markup .= '<option value="'.trim($map_item).'">'.$map_item.'</option>';
                                    }
                                @endphp

                                <form action="{{route('admin.neighborhood.import.database')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <table class="table table-striped">
                                        <thead>
                                        <th style="width: 200px">{{__('Field Name')}}</th>
                                        <th>{{__('Set Field')}}</th>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td><h6>{{__('Country')}}</h6></td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control" name="country_id" id="country_id" required>
                                                        <option value="">{{ __('Select Country') }}</option>
                                                        @foreach($all_countries as $country)
                                                            <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <p class="text-info">{{ __('Select state country ') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{__('State')}}</h6></td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="state_id" id="state_id" class="form-control" required>
                                                        <option value="">{{ __('Select State') }}</option>
                                                    </select>
                                                </div>
                                                <p class="text-info">{{ __('Select cities state') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{__('City')}}</h6></td>
                                            <td>
                                                <div class="form-group">
                                                    <select name="city_id" id="city_id" class="form-control" required>
                                                        <option value="">{{ __('Select City') }}</option>
                                                    </select>
                                                </div>
                                                <p class="text-info">{{ __('Select city') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{__('Neighborhood')}}</h6></td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control mapping_select" required>
                                                        <option value="">{{__('Select Field')}}</option>
                                                        {!! $option_markup !!}
                                                    </select>
                                                    <input type="hidden" name="neighborhood">
                                                </div>
                                                <p class="text-info">{{ __('Select neighborhood column and only unique neighborhoods will be added automatically.') }}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><h6>{{__('Status')}}</h6></td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control mapping_select">
                                                        <option value="1">{{__('Publish')}}</option>
                                                        <option value="0">{{__('Draft')}}</option>
                                                    </select>
                                                    <input type="hidden" name="status" value="1">
                                                </div>
                                            </td>
                                        </tr>

                                        </tbody>
                                    </table>
                                    <button type="submit" class="btn btn-primary loading-btn">{{__('Import')}}</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.loading-btn',function (){
                    $(this).append('<i class="ml-2 fas fa-spinner fa-spin"></i>')
                });

                $(document).on('change','.mapping_select',function (){
                    $('.mapping_select option').attr('disabled',false);
                    $(this).next('input').val($(this).val());
                    let allValue = $('.mapping_select');
                    $.each(allValue,function (index,item){
                        $('.mapping_select option[value="'+$(this).val()+'"]').attr('disabled',true);
                    });
                })

                // change country and get state
                $('#country_id').on('change', function() {
                    let country = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.state.all') }}",
                        data: {
                            country: country
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select State')}}</option>";
                                let all_state = res.states;
                                $.each(all_state, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.state + "</option>";
                                });
                                $("#state_id").html(all_options);
                                $("#city_id").html("<option value=''>{{__('Select City')}}</option>");
                            }
                        }
                    })
                });

                // change state and get city
                $('#state_id').on('change', function() {
                    let state = $(this).val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('au.city.all') }}",
                        data: {
                            state: state
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                let all_options = "<option value=''>{{__('Select City')}}</option>";
                                let all_cities = res.cities;
                                $.each(all_cities, function(index, value) {
                                    all_options += "<option value='" + value.id +
                                        "'>" + value.city + "</option>";
                                });
                                $("#city_id").html(all_options);
                            }
                        }
                    })
                });

            });
        }(jQuery));
    </script>
@endsection
