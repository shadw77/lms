<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Lesson') }}
        </h2>
    </x-slot>
    <div class="py-12 w-50 container bg-white mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('lessons.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <x-bladewind::input required="true" label="Title" name="title" value="{{ old('title') }}" />
                    @error('title')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-bladewind::textarea required="true" placeholder="Content" selected_value="{{ old('content') }} " rows="5" name="content"></x-bladewind::textarea>
                    @error('content')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <x-bladewind::select required="true" label_key="title" name="course_id" value_key="id" :data="$courses" label="Choose course title"/>
                    @error('course_id')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</x-app-layout>
