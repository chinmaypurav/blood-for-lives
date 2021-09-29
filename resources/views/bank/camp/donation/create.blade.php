<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation Create Page') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="GET" action="{{ route('bank.camps.donations.create', ['camp' => $camp]) }}" 
                        x-data>
                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" 
                                    type="email" 
                                    name="email" 
                                    x-ref="email" 
                                    @input="$refs.email.value ? $refs.donor_card_no.disabled = true : $refs.donor_card_no.disabled = false; $refs.email.value || $refs.donor_card_no.value ? $refs.search.disabled = false : $refs.search.disabled = true"
                                    autocomplete="off" />
                        </div>

                        <div class="mt-4">
                            <p class="text-center text-gray-500">OR</p>
                        </div>

                        <!-- Donor Card No -->
                        <div>
                            <x-label for="donor_card_no" :value="__('Donor Card No')" />

                            <x-input id="donor_card_no" class="block mt-1 w-full" 
                                    type="text" 
                                    name="donor_card_no" 
                                    x-ref="donor_card_no" 
                                    @input="$refs.donor_card_no.value ? $refs.email.disabled = true : $refs.email.disabled = false; $refs.email.value || $refs.donor_card_no.value ? $refs.search.disabled = false : $refs.search.disabled = true"
                                    autocomplete="off" />
                        </div>


                        <div class="flex items-center mt-4">        
                            <x-button.w-full x-ref="search" disabled>
                                {{ __('Search') }}
                            </x-button.w-full>
                        </div>

                    </form>                   

                </div>
            </div>
        </div>
    </div>
    @if (!empty($donor))
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('bank.camps.donations.store', ['camp' => $camp]) }}">
                        @csrf
                        <x-input id="donor_id" type="hidden" name="donor_id" value="{{$donor->id}}" />
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="name" 
                                                value="{{ $donor->name }}" readonly />
                        </div>

                        <!-- Blood Group -->
                        <div class="mt-4">
                            <x-label for="blood_group" :value="__('Blood Group')" />

                            <x-input id="blood_group" class="block mt-1 w-full" type="text" name="blood_group" value="{{$donor->blood_group}}" readonly />
                        </div>


                        <div class="mt-4">
                            <x-label for="blood_component" :value="__('Component to Donate')" />
                            <x-select id="blood_component" name="blood_component" class="uppercase">
                                @foreach (config('project.blood_components') as $bloodComponent)
                                    <option value="{{ $bloodComponent }}">{{ $bloodComponent }}</option>
                                @endforeach
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
    @endif
</x-app-layout>