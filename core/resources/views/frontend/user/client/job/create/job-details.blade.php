<!-- About Job Start -->
<div class="setup-wrapper-contents active">
    <div class="setup-wrapper-contents-item">
        <div class="setup-bank-form">
            <x-form.text :title="__('Job Title')" :type="'text'" :id="'title'" :name="'title'" :divClass="'mb-0'"
                :class="'form--control'" :value="old('title')" :placeholder="__('e.g. I need  landing page')" />
            <span id="job_title_char_length_check"></span>

            <x-form.text :title="__('Slug')" :type="'text'" :id="'slug'" :name="'slug'" :value="old('slug')"
                :divClass="'mb-0'" :class="'form--control d-none'" :labelClass="'d-none display_label_title'" :placeholder="__('Slug')" />
            <div class="mb-0">

                <strong>{{ __('Slug:') }}</strong>
                <span class="full-slug-show"></span>
                <span class="edit_job_slug"><i class="fas fa-edit"></i></span>
            </div>

            <x-form.category-dropdown :title="__('Select Category')" :name="'category'" :id="'category'" :class="'form-control category_select2'" />

            <div class="single-input">
                <label class="label-title">{{ __('Select Subcategory') }}</label>
                <select name="subcategory[]" id="subcategory" class="form-control get_subcategory subcategory_select2"
                    multiple>
                </select>

                <span id="subcategory_info"></span>
            </div>

            @if ($all_lengths->count() >= 1)
                <div class="single-input">
                    <label class="label-title">{{ __('Job duration') }}</label>
                    <select name="duration" id="duration" class="form-control">
                        <option value="">{{ __('Select Duration') }}</option>
                        @foreach ($all_lengths as $length)
                            <option value="{{ $length->length }}">{{ ucfirst($length->length) }}</option>
                        @endforeach
                    </select>
                </div>
            @else
                <div class="single-input">
                    <label class="label-title">{{ __('Job duration') }}</label>
                    <select name="duration" id="duration" class="form-control">
                        <option value="">{{ __('Select Duration') }}</option>
                        <option value="1 Days">{{ __('1 Days') }}</option>
                        <option value="1 Days">{{ __('2 Days') }}</option>
                        <option value="1 Days">{{ __('3 Days') }}</option>
                        <option value="less than a week">{{ __('Less than a Week') }}</option>
                        <option value="less than a month">{{ __('Less than a month') }}</option>
                        <option value="less than 2 month">{{ __('Less than 2 month') }}</option>
                        <option value="less than 3 month">{{ __('Less than 3 month') }}</option>
                        <option value="More than 3 month">{{ __('More than 3 month') }}</option>
                    </select>
                </div>
            @endif
            <x-form.experience-level-dropdown :title="__('Select Experience Level')" :class="'form-control'" :name="'level'"
                :id="'level'" />

            @php
                $restrictionEnabled = get_static_option('job_country_restriction_enabled', 0);
            @endphp

            @if($restrictionEnabled)
                <div class="country-restrictions-section mt-4">
                    <h5 class="label-title mb-3">{{ __('Freelancer Location Requirements') }}</h5>

                    <div class="single-input">
                        <label class="label-title">{{ __('Location Restriction Type') }}</label>
                        <select name="country_restriction_type" id="country_restriction_type" class="form-control">
                            <option value="none">{{ __('No Location Restrictions (Global)') }}</option>
                            <option value="include">{{ __('Only Allow Specific Countries') }}</option>
                            <option value="exclude">{{ __('Exclude Specific Countries') }}</option>
                        </select>
                        <small class="form-text text-muted">
                            {{ __('Choose how you want to restrict freelancer locations for this job') }}
                        </small>
                    </div>

                    <!-- Include Countries Section -->
                    <div class="single-input country-selection-wrapper" id="include_countries_wrapper"
                        style="display: none;">
                        <label class="label-title">
                            {{ __('Select Allowed Countries') }}
                            <span class="text-success">({{ __('Only freelancers from these countries can apply') }})</span>
                        </label>
                        <select name="allowed_countries[]" id="allowed_countries"
                            class="form-control allowed_countries_select2" multiple>
                            @foreach ($all_countries = \Modules\CountryManage\Entities\Country::all_countries() as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            {{ __('Select one or more countries. Only freelancers from these countries will see and can apply to this job.') }}
                        </small>
                    </div>

                    <!-- Exclude Countries Section -->
                    <div class="single-input country-selection-wrapper" id="exclude_countries_wrapper"
                        style="display: none;">
                        <label class="label-title">
                            {{ __('Select Excluded Countries') }}
                            <span class="text-danger">({{ __('Freelancers from these countries cannot apply') }})</span>
                        </label>
                        <select name="excluded_countries[]" id="excluded_countries"
                            class="form-control excluded_countries_select2" multiple>
                            @foreach ($all_countries = \Modules\CountryManage\Entities\Country::all_countries() as $country)
                                <option value="{{ $country->id }}">{{ $country->country }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">
                            {{ __('Select countries to exclude. Freelancers from these countries will not see or be able to apply to this job.') }}
                        </small>
                    </div>

                    <!-- Preview Section -->
                    <div class="country-preview mt-3" id="country_preview" style="display: none;">
                        <div class="alert alert-info">
                            <strong>{{ __('Preview:') }}</strong>
                            <span id="country_preview_text"></span>
                        </div>
                    </div>
                </div>
            @endif


            <div class="single-input mb-4 mt-4">
                <label class="label-title flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="is_urgent" value="1" class="w-5 h-5 accent-primary">
                    <span class="font-bold text-red-600 uppercase tracking-wide"><i class="fa-solid fa-bolt"></i> {{ __('Bu bir ACİL İŞ talebidir') }}</span>
                </label>
                <small class="text-gray-500 font-medium">{{ __('Acil işler ustalara öncelikli bildirim olarak gider ve listede vurgulanır.') }}</small>
            </div>

            <x-form.summernote :title="__('Write a job description')" :name="'description'" :id="'description'" :rows="'10'"

                :cols="30" :value="old('description')" :class="'description '" />
            <span id="job_description_char_length_check"></span>

            <x-form.text :title="__('Meta Title - ideal length is 50–60 characters (optional)')" :type="'text'" :id="'meta_title'" :name="'meta_title'" :divClass="'mb-0'"
                :class="'form--control'" :value="old('meta_title')" :placeholder="__('Enter meta title')" />

            <div class="single-input">
                <label
                    class="label-title">{{ __('Meta Description - ideal length is 150-160 characters (optional)') }}</label>
                <textarea name="meta_description" id="meta_description" class="form-message" cols="30" rows="3"
                    placeholder="{{ __('Enter meta description') }}"></textarea>
            </div>

        </div>
    </div>
</div>
<!-- About Job Ends -->
