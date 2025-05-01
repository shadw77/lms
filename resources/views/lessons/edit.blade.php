<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Lesson') }}
        </h2>
    </x-slot>
    <div class="py-12 w-50 container bg-white mt-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('lessons.update', $lesson) }}" method="post">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <x-bladewind::input label="Title" name="title" value="{{ $lesson->title }}" />
                </div>
                <div class="mb-3">
                    <x-bladewind::textarea placeholder="Content" rows="5" name="content" selected_value="{{ $lesson->content }}"></x-bladewind::textarea>
                </div>
                <div class="mb-3">
                    <x-bladewind::select label_key="title" selected_value="{{ $lesson->course_id }}" name="course_id" value_key="id" :data="$courses" label="Choose course title"/>
                </div>
                
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</x-app-layout>
