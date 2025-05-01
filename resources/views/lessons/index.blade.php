<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lessons') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-bladewind::table>
                <x-slot name="header">
                    <th>Title</th>
                    <th>Content</th>
                    <th>Actions</th>
                </x-slot>
                @foreach ($lessons as $lesson)
                    <tr>
                        <td>{{ $lesson->title }}</td>
                        <td>{{ $lesson->content }}</td>
                        <td></td>
                    </tr>
                @endforeach
            </x-bladewind::table>
        </div>
    </div>
</x-app-layout>
