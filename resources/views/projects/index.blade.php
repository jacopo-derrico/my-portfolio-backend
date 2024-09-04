<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All projects') }}
        </h2>
        <a href="">
            <x-primary-button>
                {{ __('Add new') }}
            </x-primary-button>
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table-auto w-full">
                        <thead>
                          <tr>
                            <th class="text-left">ID</th>
                            <th class="text-left">Title</th>
                            <th class="text-left">Slug</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Description</th>
                            <th class="text-left">Cover</th>
                            <th class="text-left">Links</th>
                            <th class="text-left">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($projects as $item)
                          <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->date }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->cover }}</td>
                            <td>
                                {{ $item->link }}
                                {{ $item->git_link }}
                            </td>
                            <td>{{ $item->id }}</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>