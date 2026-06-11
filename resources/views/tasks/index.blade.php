    <x-app-layout>
        <x-slot name="header">
            <div class="flex justify-between items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tasks</h2>

                <a href="{{ route('tasks.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">+ Task nou</a>
            </div>
        </x-slot>

        

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex gap-2 mb-4">
            <a href="{{ route('tasks.index') }}" class="px-3 py-1 rounded text-sm {{ !request('status') ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Toate</a>
            <a href="{{ route('tasks.index',['status' => 'pending']) }}" class="px-3 py-1 rounded text-sm {{ request('status') === 'pending' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Pending</a>
            <a href="{{ route('tasks.index',['status' => 'in_progress']) }}" class="px-3 py-1 rounded text-sm {{ request('status') === 'in_progress' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">In Progress</a>
            <a href="{{ route('tasks.index',['status' => 'completed']) }}" class="px-3 py-1 rounded text-sm {{ request('status') === 'completed' ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300' }}">Completed</a>
        </div>

                @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif

                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg" x-data="{ search: '' }">
                    <div class="p-6">
                        <input type="text" x-model="search" placeholder="Cauta dupa titlu..." class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                        @forelse($tasks as $task)
                            <div class="border-b dark:border-gray-700 py-4 flex justify-between items-center"
                            x-show="search === '' || '{{strtolower($task->title) }}'.includes(search.toLowerCase()) ">
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200">{{ $task->title }}</h3>
                                    @if(auth()->user()->role === 'admin')
                                        <p class="text-xs text-gray-400">Creat de: {{ $task->user->name }}</p>
                                    @endif

                                    <p class="text-sm text-gray-500">{{ $task->description }}</p>

                                    <span class="text-xs px-2 py-1 rounded 
                                    {{ $task->status === 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800' : ''}}
                                    {{ $task->status === 'pending' ? 'bg-red-100 text-red-800' : '' }}"> 
                                    {{ ucwords(str_replace('_',' ', $task->status)) }}
                                    </span>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('tasks.edit', $task) }}"
                                    class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold py-1 px-3 rounded text-sm">Edit
                                    </a>
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm" onclick="return confirm('Sigur stergi?')">Sterge</button>
                                    </form>
                                </div>
                            </div>
                        @empty 
                            <p class="text-gray-500">Nu ai niciun task inca</p>
                        @endforelse    
                    </div>
                </div>
            </div>
        </div>
    </x-app-layout>