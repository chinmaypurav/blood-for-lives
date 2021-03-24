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

                    
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Blood Component</x-table.th>
                            <x-table.th>Blood Group</x-table.th>
                            <x-table.th>Units Available</x-table.th>                            
                        </x-slot>
                        {{-- td --}}
                        @if ($inventories->count())
                            {{-- @foreach ($inventories as $keyComponent => $component)
                                @foreach ($component as $keyGroup => $group) 
                                <tr>
                                    <x-table.td class="uppercase">{{$keyComponent}}</x-table.td>
                                    <x-table.td class="uppercase">{{$keyGroup}}</x-table.td>
                                    <x-table.td class="uppercase">{{$group->count()}}</x-table.td>
                                </tr>
                                @endforeach
                            @endforeach --}}

                            @foreach ($inventories as $inventory)
                            <tr>
                                <x-table.td class="uppercase">{{$inventory->blood_component}}</x-table.td>
                                <x-table.td class="uppercase">{{$inventory->blood_group}}</x-table.td>
                                <x-table.td class="uppercase">{{$inventory->units}}</x-table.td>
                            </tr>
                            @endforeach


                        @else
                            <tr>
                                <x-table.td colspan="3" class="text-center">No Data Found</x-table.td>
                            </tr>
                        @endif
                    </x-table.table>               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>