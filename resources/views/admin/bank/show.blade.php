<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bank') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    
                    <p>
                        Bank Name: {{$bank->name}}
                    </p>
                    <p>
                        Bank Address: {{$bank->address}}
                    </p>
                    <p>
                        Bank Postal Code: {{$bank->postal}}
                    </p>
                    <p>
                        Bank Created At: {{$bank->created_at}}
                    </p>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>