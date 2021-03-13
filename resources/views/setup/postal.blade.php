<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bolo Count') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-4">
                        <form method="POST" action="/csv" enctype="multipart/form-data">
                            @csrf
                            <!-- Csv File -->
                            <div class="mt-4">
                                <x-label for="csv" :value="__('CSV Input')" />

                                <x-input id="csv" class="block mt-1 w-full" type="file" name="csv" required />
                            </div>
                            <div class="flex items-center justify-end mt-4">        
                                <x-button class="ml-4">
                                    {{ __('Upload') }}
                                </x-button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>