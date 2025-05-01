<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (auth()->user()->is_admin)
            <div class="d-grid gap-2 d-flex justify-content-end mb-2">
                <x-bladewind::button onclick="window.location.href='{{ route('courses.create') }}'">Create Course</x-bladewind::button>
            </div>
            @endif

            <x-bladewind::table>
                <x-slot name="header">
                    <th>Title</th>
                    <th>Description</th>
                    <th>Actions</th>
                </x-slot>
                @foreach ($courses as $course)
                    <tr>
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->description }}</td>
                        <td>
                            <button onclick="showModal('course_{{ $course->id }}')" style="cursor:pointer;">
                                <x-bladewind::icon name="eye" class="!h-6 !w-6 text-emerald-500 me-2" />
                            </button>
                            <form action="{{ route('courses.enroll', $course->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-sm">
                                <span title="Enroll">
                                    <x-bladewind::icon name="document-check" class="cursor-pointer !h-6 !w-6 !stroke-green-500" />
                                </span>    
                                </button>
                            </form>
                            @if (auth()->user()->is_admin)
                            <button onclick="window.location.href='{{ route('courses.edit', $course->id) }}'" style="cursor:pointer;">
                                <x-bladewind::icon name="pencil" class="!h-6 !w-6 text-amber-500" />
                            </button>
                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm" onclick="return confirm('Are you sure?')">
                                    <x-bladewind::icon name="trash" class="!h-6 !w-6 text-danger" />
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
