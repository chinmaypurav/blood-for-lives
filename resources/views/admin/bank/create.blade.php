<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New Blood Bank Create') }}
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

                    <form method="POST" action="{{ route('admin.bank.store') }}">
                        @csrf

                        <!-- Name -->
                        <div>
                            <x-label for="user_name" :value="__('Name')" />

                            <x-input id="user_name" class="block mt-1 w-full" 
                                                type="text" 
                                                name="user_name" 
                                                autocomplete="off"
                                                :value="old('user_name')" 
                                                required autofocus />
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-label for="manager_email" :value="__('Email')" />

                            <x-input id="manager_email" class="block mt-1 w-full" type="email" name="manager_email" :value="old('manager_email')" required />
                        </div>

                        <!-- Bank Name -->
                        <div class="mt-4">
                            <x-label for="name" :value="__('Bank Name')" />

                            <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        </div>

                        <!-- Bank Code -->
                        <div class="mt-4">
                            <x-label for="bank_code" :value="__('Bank Code')" />

                            <x-input id="bank_code" class="block mt-1 w-full" type="text" name="bank_code" :value="old('bank_code')" required />
                        </div>

                        <!-- Address -->
                        <div class="mt-4">
                            <x-label for="address" :value="__('Address')" />

                            <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required />
                        </div>

                        <!-- Postal -->
                        <div class="mt-4">
                            <x-label for="postal" :value="__('Postal')" />

                            <x-input id="postal" class="block mt-1 w-full" type="text" name="postal" :value="old('postal')" required />
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