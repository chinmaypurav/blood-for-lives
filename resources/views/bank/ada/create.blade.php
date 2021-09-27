<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ada Create') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                                       
                   

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    
                    <form method="POST" action="{{ route('manager.ada.store') }}">
                        @csrf

                        <!-- Guardian Name -->
                        <div>
                            <x-label for="maxVolCount" :value="__('Maximum Volunteer Count')" />

                            <x-input id="maxVolCount" class="block mt-1 w-full" 
                                    type="number" 
                                    name="maxVolCount" 
                                    :value="old('guardianName') ? old('guardianName') : 5" required autofocus />
                        </div class="mt-4">

                        <x-input id="demandId" type="hidden" name="demandId" :value="$demandId" />
                        
                        <div class="flex items-center justify-end mt-4">        
                            <x-button class="ml-4">
                                {{ __('ADA') }}
                            </x-button>
                        </div>
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>