<!-- Project Introduction Start -->
@if(request()->has('debug_project'))
    <div class="alert alert-info">
        Title: {{ $project_details->title }} <br>
        Description: {{ $project_details->description }} <br>
        Attributes: {{ json_encode($project_details->getAttributes()) }}
    </div>
@endif
<div class="setup-wrapper-contents active">
    <div class="create-project-wrapper-item">
        <div class="create-project-wrapper-item-top profile-border-bottom">
            <h4 class="create-project-wrapper-title">{{ __('Project Intro') }}</h4>
        </div>
        <div class="create-project-intro-contents">
            <div class="create-project-intro-contents-form custom-form">

                <div class="single-input mt-3">
                    <label class="label-title">{{ __('Select Category') }}</label>
                    <select name="category" id="category" class="form-control category_select2">
                        @foreach(\Modules\Service\Entities\Category::all_categories() as $data)
                            <option value="{{ $data->id }}" @if($project_details->category_id == $data->id) selected @endif>{{ $data->category }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="single-input">
                    <label class="label-title">{{ __('Select Subcategory') }}</label>
                    <select name="subcategory[]" id="subcategory" class="form-control get_subcategory subcategory_select2" multiple>
                        @foreach ($get_sub_categories_from_project_category as $subcategory)
                            <option
                                @foreach($project_details->project_sub_categories as $project_subcategory)
                                    {{$project_subcategory->id === $subcategory->id ? 'selected' :''}}
                                @endforeach
                                value="{{ $subcategory->id }}">{{ $subcategory->sub_category }}
                            </option>
                        @endforeach
                    </select>
                    <span id="subcategory_info"></span>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <x-form.country-dropdown :title="__('Service Country')" :name="'country_id'" :id="'country_id'" :class="'form-control country_select2'" :selected="$project_details->country_id" />
                    </div>
                    <div class="col-md-4">
                        <div class="single-input">
                            <label class="label-title">{{ __('Service State/Province') }}</label>
                            <select name="state_id" id="state_id" class="form-control state_select2 get_state_city">
                                <option value="">{{ __('Select State') }}</option>
                                @if($project_details->country_id)
                                    @foreach(\Modules\CountryManage\Entities\State::where('country_id', $project_details->country_id)->get() as $state)
                                        <option value="{{ $state->id }}" @selected($project_details->state_id == $state->id)>{{ $state->state }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="single-input">
                            <label class="label-title">{{ __('Service City/District') }}</label>
                            <select name="city_id" id="city_id" class="form-control city_select2">
                                <option value="">{{ __('Select City') }}</option>
                                @if($project_details->state_id)
                                    @foreach(\Modules\CountryManage\Entities\City::where('state_id', $project_details->state_id)->get() as $city)
                                        <option value="{{ $city->id }}" @selected($project_details->city_id == $city->id)>{{ $city->city }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
               <x-form.text :title="__('What are you offering to clients?')" :type="'text'" :id="'project_title'" :name="'project_title'" :divClass="'mb-0'" :class="'form--control'" :value="$project_details->title ?? old('project_title')" :placeholder="__('You’ll get a Mobile application designed')" />
                <span id="project_title_char_length_check"></span>
                <x-form.text :title="__('Slug')" :type="'text'" :id="'slug'" :name="'slug'" :divClass="'mb-0'" :class="'form--control d-none'" :labelClass="'d-none display_label_title'" :value="$project_details->slug ?? old('slug')" :placeholder="__('Slug')" />

                <div class="mb-4">
                    <strong>{{ __('Slug:') }}</strong>
                    <span class="display_project_slug"></span>
                    <span class="full-slug-show"></span>
                    <span class="edit_project_slug"><i class="fas fa-edit"></i></span>
                </div>

                <x-form.summernote
                    :title="__('Write a description about your service')"
                    :name="'project_description'"
                    :id="'project_description'"
                    :rows="'10'" :cols="30"
                    :value="$project_details->description ?? old('project_description')"
                />
                <span id="project_description_char_length_check"></span>

                <x-form.text :title="__('Meta Title - ideal length is 50–60 characters (optional)')" :type="'text'" :id="'meta_title'" :name="'meta_title'" :divClass="'mb-0'" :class="'form--control'" :value="$project_details->meta_title ?? old('meta_title')" :placeholder="__('Enter meta title')" />

                <div class="single-input">
                    <label class="label-title">{{ __('Meta Description - ideal length is 150-160 characters (optional)') }}</label>
                    <textarea name="meta_description" id="meta_description" class="form-message" cols="30" rows="3" placeholder="{{ __('Enter meta description') }}">{{ $project_details->meta_description ?? '' }}</textarea>
                </div>

            </div>
        </div>
    </div>
</div>
<!-- Project Introduction Ends -->
