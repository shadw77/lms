<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Enrolled Courses') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-bladewind::checkcards name="hosting-colours"
                border_color="red">
                <div class="grid grid-cols-2 gap-4">
                @foreach($my_enrollments as $enrollment)
                    <x-bladewind::checkcards.card 
                        value="{{ $enrollment->course->title }}" title="{{ $enrollment->course->title }}" icon="check-badge">
                        {{ $enrollment->course->description }}
                    </x-bladewind::checkcards.card>
                @endforeach
                </div>
            </x-bladewind::checkcards>
        </div>
    </div>
</x-app-layout>
