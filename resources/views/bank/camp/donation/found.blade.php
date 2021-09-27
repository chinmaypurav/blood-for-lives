<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation Create Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('manager.camp.donation.update', ['donor' => $donor->id]) }}">
                        @method('put')
                        @csrf
                        <x-input id="donor_id" type="hidden" name="donor_id" value="{{$donor->id}}" readonly />
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="name" 
                                                value="{{ $donor->user->name }}" readonly />
                        </div>

                        <!-- Blood Group -->
                        <div class="mt-4">
                            <x-label for="blood_group" :value="__('Blood Group')" />

                            <x-input id="blood_group" class="block mt-1 w-full" type="text" name="blood_group" value="{{$donor->blood_group}}" readonly />
                        </div>


                        <div class="mt-4">
                            <x-label for="blood_component" :value="__('Component to Donate')" />
                            <x-select id="blood_component" name="blood_component" class="uppercase">
                                <option>whole</option>
                                <option>wbc</option>
                                <option>rbc</option>
                            </x-select>
                    
                        </div>

                        <div class="flex items-center content-center justify mt-4">        
                            <x-button class="w-full content-center" id="searchDonor">
                                {{ __('Donate') }}
                            </x-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>