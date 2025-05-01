<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="d-grid gap-2 d-flex justify-content-end mb-2">
                @if (auth()->user()->is_admin)
                <x-bladewind::button  no_data_message="The lessons is empty"
                onclick="window.location.href='{{ route('lessons.create') }}'"
                >Create Lesson</x-bladewind::button>
                @endif
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
                                <x-bladewind::icon name="eye" class="!h-6 !w-6 text-emerald-500 me-2" />
                            </button>
                            @if (auth()->user()->is_admin)
                            <button onclick="window.location.href='{{ route('lessons.edit', $lesson->id) }}'" style="cursor:pointer;">
                                <x-bladewind::icon name="pencil" class="!h-6 !w-6 text-amber-500" />
                            </button>
                            
                            <form action="{{ route('lessons.destroy', $lesson->id) }}" method="POST" style="display:inline-block;">
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
