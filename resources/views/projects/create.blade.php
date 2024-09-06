<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('projects.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="rgb(229 231 235)"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ms-4">
                {{ __('Add new project') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('projects.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="flex w-full gap-3">
                            <!-- Title -->
                            <div class="w-full">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required autofocus/>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <!-- date -->
                            <div class="w-full">
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" class="block mt-1 w-full" type="number" min="1994" max="2099" step="1" name="date" required autofocus/>
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex w-full gap-3 mt-4">
                            <!-- link -->
                            <div class="w-full">
                                <x-input-label for="link" :value="__('Link')" />
                                <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" autofocus/>
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                            <!-- git-link -->
                            <div class="w-full">
                                <x-input-label for="git_link" :value="__('Git link')" />
                                <x-text-input id="git_link" class="block mt-1 w-full" type="text" name="git_link" autofocus/>
                                <x-input-error :messages="$errors->get('git_link')" class="mt-2" />
                            </div>
                        </div>
                        <!-- cover_path -->
                        <div class="mt-4">
                            <x-input-label for="cover_path" :value="__('Cover image')" />
                            <x-text-input id="cover_path" class="block mt-1 w-full" type="file" accept="image/*,.gif" name="cover_path" autofocus/>
                            <x-input-error :messages="$errors->get('cover_path')" class="mt-2" />
                        </div>
                        <!-- description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input id="description" class="block mt-1 w-full" type="textarea" row="20" name="description" autofocus/>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>
                
                        
                        <div class="flex items-center justify-end mt-4" type="submit">
                            <x-primary-button class="ms-3">
                                {{ __('Create new project') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
