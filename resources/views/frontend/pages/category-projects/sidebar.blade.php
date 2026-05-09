<!-- Sidebar Filter -->
<div id="sidebar" class="fixed inset-0 bg-black/40 z-[9999] hidden">
    <div class="w-80 bg-white rounded-lg shadow-lg border border-gray-200 p-6 h-screen overflow-y-auto fixed left-0 top-0 custom-scrollbar overflow-hidden">
        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-bold text-base-300">{{ __('All Filters') }}</h2>
            <button id="closeSidebar"
                    class="w-[32px] h-[32px] min-w-[32px] min-h-[32px] flex items-center justify-center transition-all duration-300 rounded-md bg-primary/10 hover:bg-primary text-base-300 hover:text-white leading-none p-0">
                <span class="text-2xl leading-none block font-bold" style="margin-top: -4px;">×</span>
            </button>
        </div>

        <!-- Search by Keywords -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Search by Keywords') }}</label>
            <div class="relative">
                <svg class="absolute left-3 top-3 w-5 h-5 text-gray-400" fill="none"
                     stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <input type="text" id="job_search_string" placeholder="{{ __('e.g. Adobe photoshop') }}"
                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary">
            </div>
        </div>

        <!-- Categories (Hidden since we're in a category) -->
        <input type="hidden" id="category" value="{{ $category->id ?? '' }}">

        <!-- Subcategories (Only for this category) -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Subcategories') }}</label>
            <select id="subcategory" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select Subcategory') }}</option>
                @foreach($subcategories as $subcat)
                    <option value="{{ $subcat->id }}">{{ $subcat->sub_category }}</option>
                @endforeach
            </select>
        </div>

        <!-- Skills (Only for this category) -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Skills') }}</label>
            <select id="skills" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select Skill') }}</option>
                @foreach($skills as $skill)
                    <option value="{{ $skill->id }}">{{ $skill->skill }}</option>
                @endforeach
            </select>
        </div>

        <!-- Country -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Country') }}</label>
            <select id="country" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select Country') }}</option>
                @foreach($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->country }}</option>
                @endforeach
            </select>
        </div>

        <!-- States -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('States') }}</label>
            <select id="state" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select State') }}</option>
                @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->state }}</option>
                @endforeach
            </select>
        </div>

        <!-- Delivery Time -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Delivery Time') }}</label>
            <select id="delivery_day" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select Delivery Time') }}</option>
                @php $all_lengths = \App\Models\Length::where('status',1)->get() @endphp
                @if($all_lengths->count() >= 1)
                    @foreach($all_lengths as $length)
                        <option value="{{ $length->length }}">{{ $length->length }}</option>
                    @endforeach
                @else
                    <option value="1">{{ __('1 Day') }}</option>
                    <option value="2">{{ __('2 Days') }}</option>
                    <option value="3">{{ __('3 Days') }}</option>
                    <option value="7">{{ __('7 Days') }}</option>
                    <option value="14">{{ __('14 Days') }}</option>
                    <option value="30">{{ __('30 Days') }}</option>
                @endif
            </select>
        </div>

        <!-- Experience Level -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Experience Level') }}</label>
            <select id="level" class="my-select custom-select w-full px-3 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:border-primary bg-white">
                <option value="">{{ __('Select Experience Level') }}</option>
                @php $experienceLevels = \App\Models\ExperienceLevel::where('status', 1)->get() @endphp
                @foreach($experienceLevels as $level)
                    <option value="{{ $level->level }}">{{ $level->level }}</option>
                @endforeach
            </select>
        </div>

        <!-- Price Range -->
        <div class="mb-12">
            <label class="block text-lg font-medium mb-4 text-base-300 text-black/80">{{ __('Price Range') }}</label>
            <div class="flex items-center gap-2 mb-4">
                <input type="text" id="priceMin" placeholder="0"
                       class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-primary" />
                <span>-</span>
                <input type="text" id="priceMax" placeholder="{{ $maxProjectPrice ?? 1000 }}"
                       class="w-full px-3 py-2 border rounded-lg text-sm focus:outline-primary" />
            </div>

            <div class="relative w-full">
                <div class="absolute top-1/2 left-0 right-0 h-1 bg-gray-300 rounded-full -translate-y-1/2"></div>
                <div id="rangeTrack" class="absolute top-1/2 h-1 bg-primary rounded-full -translate-y-1/2"></div>

                <input type="range" id="priceRangeStart" min="0" max="{{ $maxProjectPrice ?? 1000 }}" value="0" class="range-slider">
                <input type="range" id="priceRangeEnd" min="0" max="{{ $maxProjectPrice ?? 1000 }}" value="{{ $maxProjectPrice ?? 1000 }}" class="range-slider">
            </div>
        </div>

        <!-- Choose Ratings Section -->
        <div class="mb-8">
            <label class="block text-lg font-medium mb-4 text-black/80">{{ __('Choose Rating') }}</label>
            <div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating1" name="rating" value="1"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating1" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating2" name="rating" value="2"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating2" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating3" name="rating" value="3"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating3" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating4" name="rating" value="4"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating4" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-gray-300"></i>
                    </label>
                </div>
                <div class="flex items-center pb-2">
                    <input type="radio" id="rating5" name="rating" value="5"
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="rating5" class="ml-3 text-sm text-gray-700 cursor-pointer flex items-center gap-0.5">
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                        <i class="icon-base ti tabler-star-filled icon-16px text-amber-400"></i>
                    </label>
                </div>
                <div class="flex items-center">
                    <input type="radio" id="ratingAll" name="rating" value=""
                           class="w-4 h-4 text-primary cursor-pointer accent-teal-600">
                    <label for="ratingAll" class="ml-3 text-sm text-gray-700 cursor-pointer">{{ __('All') }}</label>
                </div>
            </div>
        </div>
    </div>
</div>