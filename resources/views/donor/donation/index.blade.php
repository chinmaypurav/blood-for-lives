<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Bank Name</x-table.th>
                            <x-table.th>Component</x-table.th>
                            <x-table.th>Date</x-table.th>                          
                            <x-table.th>Action</x-table.th>                          
                        </x-slot>
                        {{-- td --}}
                            @foreach ($donations as $donation)
                                <tr>
                                    <x-table.td class="uppercase">{{$donation->banks->name}}</x-table.td>
                                    <x-table.td class="uppercase">{{$donation->blood_component}}</x-table.td>
                                    <x-table.td class="uppercase">{{$donation->donated_at}}</x-table.td>
                                    <x-table.td>
                                        {{-- <a href="{{route('manager.inventory.show', ['inventory' => $bank->id])}}">View</a> --}} Act
                                    </x-table.td>
                                </tr>
                            @endforeach
    
                    </x-table.table>
                    {{ $donations->links() }}     

                </div>
            </div>
        </div>
    </div>
</x-app-layout>