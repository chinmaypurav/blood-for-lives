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
                    
                    <form method="POST" action="{{ route('manager.donation.store') }}">
                        @csrf
                        <x-input id="donorId" type="hidden" name="donorId" value="{{$donor->id}}" readonly />
                        <!-- Name -->
                        <div>
                            <x-label for="name" :value="__('Name')" />

                            <x-input id="name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="name" 
                                                value="{{ $donor->user()->name }}" readonly />
                        </div>

                        <!-- Blood Group -->
                        <div class="mt-4">
                            <x-label for="bloodGroup" :value="__('Blood Group')" />

                            <x-input id="bloodGroup" class="block mt-1 w-full" type="text" name="bloodGroup" value="{{$donor->blood_group}}" readonly />
                        </div>

                        {{-- Last Donated At --
                        <div class="mt-4">
                            <x-label for="donatedAt" :value="__('Last Donated At')" />
                            @if ($donor->donated_at)
                                <x-input id="donatedAt" class="block mt-1 w-full" 
                                                        type="date" 
                                                        name="donatedAt" 
                                value="{{Carbon\Carbon::parse($donor->safe_donate_at)->format('Y-m-d')}}" readonly />
                            @else
                                <x-input id="donatedAt" class="block mt-1 w-full" 
                                                        type="text" 
                                                        name="donatedAt" 
                                                        value="Never Donated Before" readonly />
                            @endif
                        </div> --}}

                        <div class="mt-4">
                            <x-label for="bloodComponent" :value="__('Component to Donate')" />
                            <x-select id="bloodComponent" name="bloodComponent">
                                <option>Whole</option>
                                <option>WBC</option>
                                <option>RBC</option>
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