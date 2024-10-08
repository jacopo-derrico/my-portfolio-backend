<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <a href="{{ route('projects.index') }}">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="rgb(229 231 235)"><path d="m313-440 224 224-57 56-320-320 320-320 57 56-224 224h487v80H313Z"/></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ms-4">
                {{ __('Edit project') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('projects.update', $project->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="flex w-full gap-3">
                            <!-- Title -->
                            <div class="w-full">
                                <x-input-label for="title" :value="__('Title')" />
                                <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" value="{{ old('title') ?? $project->title }}" required autofocus/>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>
                            <!-- date -->
                            <div class="w-full">
                                <x-input-label for="date" :value="__('Date')" />
                                <x-text-input id="date" class="block mt-1 w-full" type="number" min="1994" max="2099" step="1" name="date" value="{{ old('date') ?? $project->date }}" required autofocus/>
                                <x-input-error :messages="$errors->get('date')" class="mt-2" />
                            </div>
                        </div>
                        <div class="flex w-full gap-3 mt-4">
                            <!-- link -->
                            <div class="w-full">
                                <x-input-label for="link" :value="__('Link')" />
                                <x-text-input id="link" class="block mt-1 w-full" type="text" name="link" value="{{ old('link') ?? $project->link }}" autofocus/>
                                <x-input-error :messages="$errors->get('link')" class="mt-2" />
                            </div>
                            <!-- git-link -->
                            <div class="w-full">
                                <x-input-label for="git_link" :value="__('Git link')" />
                                <x-text-input id="git_link" class="block mt-1 w-full" type="text" name="git_link" value="{{ old('git_link') ?? $project->git_link }}" autofocus/>
                                <x-input-error :messages="$errors->get('git_link')" class="mt-2" />
                            </div>
                        </div>
                        <!-- cover_path -->
                        <div class="mt-4">
                            <x-input-label for="cover_path" :value="__('Cover image')" />
                            <div class="flex items-start justify-start gap-5 mt-1">
                                <div class="w-[100px]">
                                    <img class="w-full h-auto rounded-2xl" src="{{ Vite::asset('storage/app/public/'.$project->cover_path) }}" alt="cover image">
                                </div>
                                <x-text-input id="cover_path" class="block mt-1 w-3/4" type="file" accept="image/*,.gif" name="cover_path" autofocus/>
                            </div>
                            <x-input-error :messages="$errors->get('cover_path')" class="mt-2" />
                        </div>
                        <!-- description -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Description')" />
                            <x-textarea-input id="description" class="block mt-1 w-full" type="textarea" row="20" name="description" autofocus text="{{ old('description') ?? $project->description }}" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <div class="flex w-full justify-between gap-5">
                            {{-- edit category tags --}}
                            <div class="mt-4 w-1/2">
                                <x-input-label for="categories" :value="__('Category')" />
                                <p class="text-xs">Hold down Ctrl or CMD to selecte multiple tags</p>
                                <select name="categories[]" multiple class="w-full h-48 mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    
                    
                                  @foreach ($categories as $category)
                                  
                                     @if ($errors->any())
                                        <option value="{{ $category->id }}"
                                            {{ in_array($category->id, old('categories', [])) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}"
                                            {{ $project->categories->contains($category->id) ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endif
                                    
                                  @endforeach
                    
                                </select>
                            </div>
    
                            {{-- edit technology tags --}}
                            <div class="mt-4 w-1/2">
                                <x-input-label for="technologies" :value="__('Technology')" />
                                <p class="text-xs">Hold down Ctrl or CMD to selecte multiple tags</p>
                                <select name="technologies[]" multiple class="w-full h-48 mt-1 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    
                    
                                  @foreach ($technologies as $technology)
                                  
                                     @if ($errors->any())
                                        <option value="{{ $technology->id }}"
                                            {{ in_array($technology->id, old('technologies', [])) ? 'selected' : '' }}>{{ $technology->name }}</option>
                                    @else
                                        <option value="{{ $technology->id }}"
                                            {{ $project->technologies->contains($technology->id) ? 'selected' : '' }}>{{ $technology->name }}</option>
                                    @endif
                                    
                                  @endforeach
                    
                                </select>
                            </div>
                        </div>


                        <!-- add multiple images -->
                        <div class="mt-4">
                            <x-input-label for="image_path" :value="__('Add multiple images')" />
                            <p class="text-xs">Hold down Ctrl or CMD to selecte multiple images</p>
                            <x-text-input id="image_path" class="block mt-1 w-full" type="file" accept="image/*,.gif" name="image_path[]" multiple autofocus/>
                            <x-input-error :messages="$errors->get('image_path')" class="mt-2" />
                        </div>
                        <div class="mt-4">
                            <h6 class="text-sm">Images already uploaded</h6>
                            <div class="w-full flex gap-6">
                                @foreach ($project->images as $image)
                                    <img src="{{ Vite::asset('storage/app/public/' . $image->image_path) }}" alt="Project Image" class="w-1/6 h-auto object-cover border border-gray-100 rounded-xl p-2">
                                @endforeach
                            </div>
                        </div>

                        @if (session()->has('new_images'))
                            <h6 class="text-sm mt-4">New Images</h6>
                            <div class="w-full flex gap-6">
                                @foreach (session('new_images') as $newImage)
                                    <img src="{{ Vite::asset('storage/app/public/' . $newImage) }}" alt="New Project Image" class="w-1/6 h-auto object-cover border border-gray-100 rounded-xl p-2">
                                @endforeach
                            </div>
                            <div id="imagePreview"></div>
                        @endif
                
                        
                        <div class="flex items-center justify-end mt-4" type="submit">
                            <x-primary-button class="ms-3">
                                {{ __('Save edits to project') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const coverPathInput = document.getElementById('cover_path');
        
        coverPathInput.addEventListener('change', function() {
                if (!this.files || this.files.length === 0) {
                    this.value = null;
                }
            });
        });

        function previewImage(event) {
            var input = event.target;
            var reader = new FileReader();
            reader.onload = function(){
                var img = document.getElementById('imagePreview');
                img.src = reader.result;
                img.style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
    </script>
</x-app-layout>
