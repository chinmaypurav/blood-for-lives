<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('manager.donation.search') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" class="block mt-1 w-full" 
                                    type="email" 
                                    name="email" 
                                    :value="old('email')" 
                                    autocomplete="off" />
                        </div>

                        

                        <!-- Donor Card No -->
                        <div class="mt-4">
                            <x-label for="donor_card_no" :value="__('Donor Card No')" />

                            <x-input id="donor_card_no" class="block mt-1 w-full" 
                                        type="text" 
                                        name="donor_card_no" 
                                        autocomplete="off" />
                        </div>


                        <div class="flex items-center justify-end mt-4">        
                            <x-button class="ml-4">
                                {{ __('Search') }}
                            </x-button>
                        </div>

                    </form>

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>