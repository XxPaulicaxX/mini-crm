<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Editeaza task
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('tasks.update', $task) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">Titlu</label>
                            <input type="text" name="title" value="{{ old('title', $task->title) }}"
                            class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                            @error('title')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">Descriere</label>
                            <textarea name="description" rows="3"
                            class="w-full rounded px-3 py-2 dark:bg-gray-700 dark:text-white">{{ old('description', $task->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 dark:text-gray-300 mb-2">Status</label>
                            <select name="status" class="w-full border rounded px-3 py-2 dark:bg-gray-700 dark:text-white">
                                <option value="pending" {{ $task->status === 'pending' ? 'selected': '' }}>Pending</option>
                                <option value="in_progress" {{ $task->status === 'in_progress' ? 'selected': '' }}>In Progress</option>
                                <option value="completed" {{ $task->status === 'completed' ? 'selected': '' }}>Completed</option>
                            </select>
                        </div>

                        <div class="flex gap-2">
                            <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Actualizeaza</button>
                            <a href="{{ route('tasks.index') }}"
                            class="bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded">Anuleaza</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>