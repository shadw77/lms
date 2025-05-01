<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                        <td></td>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </div>
    </div>
</x-app-layout>
