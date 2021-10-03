<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Banks Listings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 mb-4 bg-white border-b border-gray-200">
                    This is a new sec
                </div>
                
                <div class="p-6 bg-white border-b border-gray-200">

                  


                    <x-table.table>
                        <x-slot name="thead">
                           <tr>
                                <x-table.th>Index</x-table.th>
                                <x-table.th>Bank Name</x-table.th>
                                <x-table.th>Camps</x-table.th>
                                <x-table.th>Inventories</x-table.th>
                           </tr>
                        </x-slot>
                        {{-- td --}}
                        @forelse ($banks as $bank)
                        <tr>
                            <x-table.td>{{ $loop->iteration }}</x-table.td>
                            <x-table.td>{{ $bank->name }}</x-table.td>
                            
                            <x-table.td>
                                <a href="{{route('banks.inventories.index',  ['bank' => $bank ])}}">
                                    Inventories
                                </a>
                            </x-table.td>
                            
                        </tr>
                        @empty
                        <tr>
                            <x-table.td class="text-center" colspan="6">No Data Found</x-table.td>
                        </tr>
                        @endforelse


                        

                    </x-table.table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>