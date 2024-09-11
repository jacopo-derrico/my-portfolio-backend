<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('projects.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="rgb(229 231 235)"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ms-4">
                {{ $project->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div >
                        <div class="flex w-full gap-3">
                            <!-- Title -->
                            <div class="w-full">
                                <h6 class="text-sm">Title</h6>
                                <p class="text-3xl font-bold">{{ $project->title ?? '-' }}</p>
                            </div>
                            <!-- date -->
                            <div class="w-full">
                                <h6 class="text-sm">Date</h6>
                                <p class="text-3xl font-bold">{{ $project->date ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex w-full gap-3 mt-4">
                            <!-- link -->
                            <div class="w-full">
                                <h6 class="text-sm">Link</h6>
                                <p class="text-3xl font-bold">{{ $project->link ?? '-' }}</p>
                            </div>
                            <!-- git-link -->
                            <div class="w-full">
                                <h6 class="text-sm">GitHub link</h6>
                                <p class="text-3xl font-bold">{{ $project->git_link ?? '-' }}</p>
                            </div>
                        </div>
                        <!-- cover_path -->
                        <div class="mt-4">
                            <h6 class="text-sm">Cover img</h6>
                            <div class="w-1/2">
                                <img class="rounded-3xl" src="{{ Vite::asset('storage/app/public/'.$project->cover_path) }}" alt="{{ $project->title }} cover image">
                            </div>
                        </div>
                        <!-- description -->
                        <div class="mt-4">
                            <div class="w-full">
                                <h6 class="text-sm">GitHub link</h6>
                                <p class="text-md font-bold">{{ $project->description ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
