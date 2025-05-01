<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Course') }}
        </h2>
    </x-slot>
    <div class="py-12 w-50 container bg-white mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('courses.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <x-bladewind::input label="Title" required="true" name="title" value="{{ old('title') }}" />
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-bladewind::textarea required="true" placeholder="Description" value="{{ old('description') }}" rows="5" name="description"></x-bladewind::textarea>
                    @error('description')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
