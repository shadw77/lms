<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
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
                <x-bladewind::button onclick="window.location.href='{{ route('courses.create') }}'">Create Course</x-bladewind::button>
                @endif
                <form method="GET" action="{{ route('courses.index') }}" class="flex items-center gap-2">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by title or description"
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
                    <th>Description</th>
                    <th class="w-40">Actions</th>
                </x-slot>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>
                            <button onclick="showModal('course_{{ $course->id }}')" style="cursor:pointer;">
                                <x-bladewind::icon name="eye" class="!h-5 !w-5 text-emerald-500 me-1" />
                            </button>
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm">
                                <span title="Enroll">
                                    <x-bladewind::icon name="document-check" class="cursor-pointer !h-5 !w-5 !stroke-green-500" />
                                </span>    
                                </button>
                            </form>
                            @if (auth()->user()->is_admin)
                            <button onclick="window.location.href='{{ route('courses.edit', $course->id) }}'" style="cursor:pointer;">
                                <x-bladewind::icon name="pencil" class="!h-5 !w-5 text-amber-500" />
                            </button>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
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
                            title="{{ $course->title }}"
                            name="course_{{ $course->id }}">
                            <div>
                                <strong>Course:</strong> {{ $course->title ?? 'N/A' }}<br><br>
                                <strong>Lessons:</strong>
                                    <ul class="list-disc list-inside text-gray-700 mt-1">
                                        @forelse ($course->lessons as $lesson)
                                            <li>{{ $lesson->title }}</li>
                                        @empty
                                            <h6 class="text-danger">There is no lessons yet!</h6>
                                        @endforelse
                                    </ul>
                                    <br>
                                <strong>Description:</strong><br>
                                {!! nl2br(e($course->description)) !!}
                            </div>
                        </x-bladewind::modal>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </div>
    </div>
</x-app-layout>
