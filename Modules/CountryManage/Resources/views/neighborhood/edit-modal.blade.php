<!-- Neighborhood Edit Modal -->
<div class="modal fade" id="editNeighborhoodModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ __('Edit Neighborhood') }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route('admin.neighborhood.edit')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="neighborhood_id" id="neighborhood_id" value="">

                <div class="modal-body">
                    <x-form.text :title="__('Neighborhood')" :type="__('text')" :name="'neighborhood'" :id="'neighborhood_name'" :placeholder="__('Enter neighborhood name')"/>
                    
                    <div class="single-input">
                        <label class="label-title mt-3">{{ __('Select Country') }}</label>
                        <select name="country" id="country_id" class="form-control select22-country">
                            <option value="">{{ __('Select Country') }}</option>
                            @foreach($all_countries as $data)
                                <option value="{{ $data->id }}">{{ $data->country }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="single-input">
                        <label class="label-title mt-3">{{ __('Select State') }}</label>
                        <select name="state" id="state_id" class="form-control select22-state">
                            <option value="">{{ __('Select State') }}</option>
                            @foreach($all_states as $data)
                                <option value="{{ $data->id }}">{{ $data->state }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="single-input mb-3">
                        <label class="label-title mt-3">{{ __('Select City') }}</label>
                        <select name="city" id="city_id" class="form-control select22-city">
                            <option value="">{{ __('Select City') }}</option>
                            @foreach($all_cities as $data)
                                <option value="{{ $data->id }}">{{ $data->city }}</option>
                            @endforeach
                        </select>
                        <span class="info_msg"></span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-4" data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <x-btn.submit :title="__('Update')" :class="'btn btn-primary mt-4 pr-4 pl-4 edit_neighborhood'" />
                </div>
            </form>
        </div>
    </div>
</div>
