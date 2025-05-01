<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>
    @if (session('message'))
        <x-bladewind::alert type="success" shade="dark" class="container">
            {{ session('message') }}
        </x-bladewind::alert>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 p-4 bg-white shadow rounded-lg mb-6">
                @if (auth()->user()->is_admin)
                <x-bladewind::button  no_data_message="The lessons is empty"
                onclick="window.location.href='{{ route('lessons.create') }}'"
                >Create Lesson</x-bladewind::button>
                @endif
                <form method="GET" action="{{ route('lessons.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title or content"
                        class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" />

                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow">
                        🔍 Search
                    </button>
                </form>
            </div>
            <x-bladewind::table>
                <x-slot name="header">
                    <th>Title</th>
                    <th>Content</th>
                    <th>Course</th>
                    <th>Actions</th>
                </x-slot>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->content }}</td>
                        <td>{{ $lesson->course->title}}</td>
                        <td>
                            <button onclick="showModal('lesson_{{ $lesson->id }}')" style="cursor:pointer;">
                                <x-bladewind::icon name="eye" class="!h-5 !w-5 text-emerald-500 me-1" />
                            </button>
                            @if (auth()->user()->is_admin)
                            <button onclick="window.location.href='{{ route('lessons.edit', $lesson->id) }}'" style="cursor:pointer;">
                                <x-bladewind::icon name="pencil" class="!h-5 !w-5 text-amber-500" />
                            </button>
                            
                            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                    <x-bladewind::icon name="trash" class="!h-5 !w-5 text-danger" />
                                </button>
                            </form>
                            @endif
                        </td>
                        <x-bladewind::modal
                            type="info"
                            title="{{ $lesson->title }}"
                            name="lesson_{{ $lesson->id }}">
                            <div>
                                <strong>Lesson:</strong> {{ $lesson->title }}<br><br>
                                <strong>Course:</strong> {{ $lesson->course->title ?? 'N/A' }}<br><br>
                                <strong>Content:</strong><br>
                                {!! nl2br(e($lesson->content)) !!}
                            </div>
                        </x-bladewind::modal>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </div>
    </div>
</x-app-layout>
