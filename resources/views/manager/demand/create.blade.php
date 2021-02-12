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
                    
                    <form method="POST" action="{{ route('manager.demand.store') }}">
                        @csrf

                        <!-- Guardian Name -->
                        <div>
                            <x-label for="guardianName" :value="__('Guardian Name')" />

                            <x-input id="guardianName" class="block mt-1 w-full" 
                                    type="text" 
                                    name="guardianName" 
                                    :value="old('guardianName')" required autofocus />
                        </div class="mt-4">

                         <!-- Guardian Contact -->
                         <div>
                            <x-label for="guardianContact" :value="__('Guardian Contact')" />

                            <x-input id="guardianContact" class="block mt-1 w-full" 
                                    type="text" 
                                    name="guardianContact" 
                                    :value="old('guardianContact')" required />
                        </div>

                        <!-- Recipient Name -->
                        <div>
                            <x-label for="recipientName" :value="__('Recipient Name')" />

                            <x-input id="recipientName" class="block mt-1 w-full" 
                                    type="text" 
                                    name="recipientName" 
                                    :value="old('recipientName')" required />
                        </div>


                        <!-- Recipient Blood Group -->
                        <div class="mt-4 col-span-6 sm:col-span-3">
                            <label for="recipientGroup" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="recipientGroup" name="recipientGroup" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>A+</option>
                                <option>A-</option>
                                <option>B+</option>
                                <option>B-</option>
                                <option>AB+</option>
                                <option>AB-</option>
                                <option>O+</option>
                                <option>O-</option>
                                <option>HH</option>
                            </select>
                        </div>

                        <!-- Recipient Blood Component -->
                        <div class="mt-4 col-span-6 sm:col-span-3">
                            <label for="recipientComponent" class="block text-sm font-medium text-gray-700">Blood Group</label>
                            <select id="recipientComponent" name="recipientComponent" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>whole</option>
                                <option>wbc</option>
                                <option>rbc</option>
                                <option>plasma</option>
                                <option>platelets</option>
                            </select>
                        </div>

                        <!-- required at -->
                        <div class="mt-4">
                            <x-label for="requiredAt" :value="__('Required At')" />

                            <x-input id="requiredAt" class="block mt-1 w-full" 
                                    type="date" 
                                    name="requiredAt" 
                                    :value="old('requiredAt')" required />
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