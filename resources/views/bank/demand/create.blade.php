<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Demand') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                                       
                    This is Create

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('bank.demands.store') }}">
                        @csrf

                        <!-- Guardian Name -->
                        <div>
                            <x-label for="guardian_name" :value="__('Guardian Name')" />

                            <x-input id="guardian_name" class="block mt-1 w-full" 
                                    type="text" 
                                    name="guardian_name" 
                                    :value="old('guardian_name')" required autofocus />
                        </div class="mt-4">

                         <!-- Guardian Contact -->
                         <div class="mt-4">
                            <x-label for="guardianContact" :value="__('Guardian Contact')" />

                            <x-input id="guardian_phone" class="block mt-1 w-full" 
                                    type="text" 
                                    name="guardian_phone" 
                                    :value="old('guardian_phone')" required />
                        </div>

                        <!-- Recipient Name -->
                        <div class="mt-4">
                            <x-label for="recipient_name" :value="__('Recipient Name')" />

                            <x-input id="recipient_name" class="block mt-1 w-full" 
                                    type="text" 
                                    name="recipient_name" 
                                    :value="old('recipient_name')" required />
                        </div>


                        <!-- Recipient Blood Group -->
                        <div class="mt-4 col-span-6 sm:col-span-3">
                            <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="blood_group" name="blood_group" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @foreach (config('project.blood_groups') as $bloodGroup)
                                <option value="{{$bloodGroup}}">{{$bloodGroup}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Recipient Blood Component -->
                        <div class="mt-4 col-span-6 sm:col-span-3">
                            <label for="blood_component" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="blood_component" name="blood_component" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm uppercase">
                                @foreach (config('project.blood_components') as $bloodComponent)
                                    <option value="{{$bloodComponent}}">{{$bloodComponent}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- required at -->
                        <div class="mt-4">
                            <x-label for="required_at" :value="__('Required At')" />

                            <x-input id="required_at" class="block mt-1 w-full" 
                                    type="date" 
                                    name="required_at" 
                                    :min="today()->toDateString()"
                                    :value="today()->toDateString()" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">        
                            <x-button class="ml-4">
                                {{ __('Create') }}
                            </x-button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>