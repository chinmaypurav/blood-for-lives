<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Donor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    @if (session('status'))
                        <div class="font-medium text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    Add Donor Registration
                    <form method="POST" action="{{ route('manager.donor.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        </div>

                        <!-- Contact -->
                        <div class="mt-4">
                            <x-label for="contact" :value="__('Contact')" />

                            <x-input id="contact" class="block mt-1 w-full" 
                                            type="text" 
                                            name="contact" :value="old('contact')" required />
                        </div>

                        <!-- Postal -->
                        <div class="mt-4">
                            <x-label for="postal" :value="__('Postal')" />

                            <x-input id="postal" class="block mt-1 w-full" type="text" name="postal" :value="old('postal')" required />
                        </div>

                        <!-- DOB -->
                        <div class="mt-4">
                            <x-label for="dob" :value="__('Date of Birth')" />

                            <x-input id="dob" class="block mt-1 w-full" type="date" name="date_of_birth" :value="old('dob')" required />
                        </div>

                        {{-- Blood Group --}}
                        <div class="mt-4 col-span-6 sm:col-span-3">
                            <label for="bloodGroup" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="bloodGroup" name="blood_group_id" autocomplete="bloodGroup" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach ($bloodGroups as $bloodGroup)
                                    <option value="{{$bloodGroup->id}}">{{$bloodGroup->blood_group}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">        
                            <x-button class="ml-4">
                                {{ __('Register') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>