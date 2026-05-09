<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
    @forelse ($jobs as $job)
        @if($job->job_creator?->username)
            <div class="bg-white border border-gray-200 rounded-lg p-6 hover:shadow-lg transition-shadow duration-300">
                <div class="flex justify-between items-start mb-4">
                    <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}">
                        <h3 class="text-lg font-medium text-base-300 hover:text-primary transition">{{ $job->title }}</h3>
                    </a>
                    @if($job->created_at->diffInHours(now()) < 24)
                        <span class="bg-secondary text-white text-xs px-3 py-1 rounded-md">{{ __('New') }}</span>
                    @endif
                </div>

                <div class="flex items-center gap-2 mb-4 text-gray-600">
                    <span>{{ $job->created_at->diffForHumans() }}</span>
                    <span class="text-secondary font-extrabold">•</span>
                    <span class="font-medium text-black">{{ ucfirst(__($job->level)) }}</span>
                </div>

                <div class="flex items-center gap-2 mb-4 flex-wrap">
                    <div class="flex items-center gap-2">
                        <span class="text-xl font-medium text-base-300">{{ $job->display_price }}</span>
                        <span class="text-sm text-base-400 bg-gray-200 px-4 rounded-full py-1">
                           {{ ucfirst(__($job->type)) }}
                          </span>
                    </div>
                </div>

                <p class="text-base-400 text-sm mb-4 line-clamp-2">
                    {!! Str::limit(strip_tags($job->description), 150) !!}
                </p>

                <div class="flex gap-2 mb-6 flex-wrap">
                    @foreach ($job->job_skills as $skill)
                        <a href="{{ route('skill.jobs', $skill->id . '-' . skillToSlug($skill->skill)) }}"
                           class="px-3 py-2 text-base-400 border-gray-400 border text-xs rounded-full hover:border-primary hover:text-primary transition">
                            {{ $skill->skill ?? '' }}
                        </a>
                    @endforeach
                </div>

                <a href="{{ route('job.details', ['username' => $job->job_creator?->username, 'slug' => $job->slug]) }}"
                   class="text-primary font-medium text-sm border px-4 py-2 border-primary rounded-lg hover:bg-primary hover:text-white duration-300 inline-flex items-center gap-1 hover:gap-2 transition-all">
                    {{ __('View More') }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>
        @endif
    @empty
        <div class="col-span-2">
            <section>
                <div class="flex items-center justify-center min-h-[calc(100vh-171px)] w-full py-10">
                    <div class="max-w-md flex flex-col items-center justify-center">
                        <img src="{{ asset('assets/frontend/new_design/assets/images/error-images/no_jobs_found.svg') }}" alt="nothing-found">
                        <p class="text-base-300 text-2xl">Ops! Sorry, no results found.</p>
                    </div>
                </div>
            </section>
        </div>
    @endforelse
</div>

<!-- Pagination -->
<x-pagination.laravel-paginate-02 :allData="$jobs" />