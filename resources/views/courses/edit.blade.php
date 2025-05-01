<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Course') }}
        </h2>
    </x-slot>
    <div class="py-12 w-50 container bg-white mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('courses.update', $course) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <x-bladewind::input required="true" label="Title" name="title" value="{{ $course->title }}" />
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-bladewind::textarea required="true" placeholder="Description" rows="5" name="description" selected_value="{{ $course->description }}"></x-bladewind::textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
