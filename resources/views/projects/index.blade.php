<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('All projects') }}
        </h2>
        <a href="{{ route('projects.create')}}">
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
                            <th class="text-left">Cover</th>
                            <th class="text-left ps-2">Title</th>
                            <th class="text-left">Slug</th>
                            <th class="text-left">Date</th>
                            <th class="text-left">Description</th>
                            <th class="text-left ps-2">Links</th>
                            <th class="text-left">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($projects as $item)
                          <tr class="border-b-2 border-b-white">
                            <td>{{ $item->id }}</td>
                            <td class="w-[100px] py-6">
                                <img class="w-full h-auto rounded-2xl" src="{{ Vite::asset('storage/app/public/'.$item->cover_path) }}" alt="cover image">
                            </td>
                            <td class="ps-2">{{ $item->title }}</td>
                            <td>{{ $item->slug }}</td>
                            <td>{{ $item->date }}</td>
                            <td class="max-w-[150px] truncate">{{ $item->description }}</td>
                            <td class="flex gap-3 items-center mt-12 ps-2 w-[80px]">
                                <a href="{{ isset($item->link) ? $item->link : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" 
                                    fill="{{ isset($item->link) ? '#ffffff' : '#999999' }}"><path d="M480-80q-82 0-155-31.5t-127.5-86Q143-252 111.5-325T80-480q0-83 31.5-155.5t86-127Q252-817 325-848.5T480-880q83 0 155.5 31.5t127 86q54.5 54.5 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-82q26-36 45-75t31-83H404q12 44 31 83t45 75Zm-104-16q-18-33-31.5-68.5T322-320H204q29 50 72.5 87t99.5 55Zm208 0q56-18 99.5-55t72.5-87H638q-9 38-22.5 73.5T584-178ZM170-400h136q-3-20-4.5-39.5T300-480q0-21 1.5-40.5T306-560H170q-5 20-7.5 39.5T160-480q0 21 2.5 40.5T170-400Zm216 0h188q3-20 4.5-39.5T580-480q0-21-1.5-40.5T574-560H386q-3 20-4.5 39.5T380-480q0 21 1.5 40.5T386-400Zm268 0h136q5-20 7.5-39.5T800-480q0-21-2.5-40.5T790-560H654q3 20 4.5 39.5T660-480q0 21-1.5 40.5T654-400Zm-16-240h118q-29-50-72.5-87T584-782q18 33 31.5 68.5T638-640Zm-234 0h152q-12-44-31-83t-45-75q-26 36-45 75t-31 83Zm-200 0h118q9-38 22.5-73.5T376-782q-56 18-99.5 55T204-640Z"/></svg>
                                </a>
                                <a href="{{ isset($item->git_link) ? $item->git_link : '' }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="{{ isset($item->git_link) ? '#ffffff' : '#999999' }}"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg>
                                </a>
                                {{ $item->git_link }}
                            </td>
                            <td class="max-w-[200px]">
                                <a href="">
                                    <x-primary-button>
                                        {{ __('Edit') }}
                                    </x-primary-button>
                                </a>
                                <a href="{{ route('projects.show', $item->id)}}">
                                    <x-secondary-button>
                                        {{ __('See') }}
                                    </x-secondary-button>
                                </a>
                                <form action="{{ route('projects.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button 
                                        type="submit" 
                                        class="outline-pink-600"
                                    >
                                        {{ __('Delete') }}
                                    </x-danger-button>
                                </form>
                                
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal() {
            document.querySelector("delete-modal").style.display = "block";
        }
        
        window.onclick = function(event) {
            if (event.target == document.querySelector("delete-modal")) {
                document.querySelector("delete-modal").style.display = "none";
            }
        }
        </script>
        
</x-app-layout>