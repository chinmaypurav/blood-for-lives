<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Camp Donation Index') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">                
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="text-red-500">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="post" action="{{ route('manager.camp.donation.store') }}" 
                        x-data>
                        @csrf

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
                            <x-label for="donorCardNo" :value="__('Donor Card No')" />

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
</x-app-layout>