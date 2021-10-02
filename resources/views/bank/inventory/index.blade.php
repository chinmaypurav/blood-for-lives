<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Inventory Level') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <a href="{{route('bank.inventories.show', ['bank' => $thisBank->id])}}">This Bank</a>

                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <x-table.th>Bank id</x-table.th>
                            <x-table.th>Bank Name</x-table.th>
                            <x-table.th>Bank Code</x-table.th>                          
                            <x-table.th>Action</x-table.th>                          
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($banks as $bank)
                            <tr>
                                <x-table.td class="uppercase">{{$bank->id}}</x-table.td>
                                <x-table.td class="uppercase">{{$bank->name}}</x-table.td>
                                <x-table.td class="uppercase">{{$bank->bank_code}}</x-table.td>
                                <x-table.td>
                                    <a href="{{route('bank.inventories.show', ['inventory' => $bank->id])}}">View</a>
                                </x-table.td>
                            </tr>
                            @empty
                            <tr>
                                <x-table.td colspan="4" class="text-center">No Data Found</x-table.td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $banks->links() }}     

                </div>
            </div>
        </div>
    </div>
</x-app-layout>