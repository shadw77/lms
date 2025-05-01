<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-bladewind::statistic
            class="mb-4"
            number="{{ $userCount }}"
            label="Total Users">

            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="currentColor" 
                    class="h-16 w-16 p-2 text-white rounded-full bg-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.5 20.25a8.25 8.25 0 0115 0" />
                </svg>
            </x-slot>
        </x-bladewind::statistic>

        <x-bladewind::statistic
            class="mb-4"
            number="{{ $courseCount }}"
            label="Total Courses">

            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="currentColor" 
                    class="h-16 w-16 p-2 text-white rounded-full bg-blue-500">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M12 6v12m0 0H6a2 2 0 01-2-2V6a2 2 0 012-2h6m0 12h6a2 2 0 002-2V6a2 2 0 00-2-2h-6" />
                </svg>
            </x-slot>
        </x-bladewind::statistic>

        <x-bladewind::statistic
            class="mb-4"
            number="{{ $lessonCount }}"
            label="Total Lessons">

            <x-slot name="icon">
                <svg xmlns="http://www.w3.org/2000/svg" 
                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" 
                    stroke="currentColor" 
                    class="h-16 w-16 p-2 text-white rounded-full bg-green-500">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M4.5 6.75h15m-15 4.5h15m-15 4.5h15M4.5 6.75v10.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V6.75" />
                </svg>
            </x-slot>

        </x-bladewind::statistic>
        </div>
    </div>
</x-app-layout>
