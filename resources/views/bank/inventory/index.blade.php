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

                    {{-- Filters --}}

                    <div>
                        <form action="{{route('banks.inventories.index', ['bank' => $bank])}}" method="GET">
                            <x-form.select-filter name="blood_group" id="" class="uppercase">
                                <option value="">Blood Group</option>
                                @foreach (config('project.blood_groups') as $bloodGroup)
                                    <option class="uppercase" value="{{$bloodGroup}}"
                                    @if(request('blood_group') == $bloodGroup)
                                    selected 
                                    @endif>
                                    {{$bloodGroup}}
                                </option>
                                @endforeach
                            </x-form.select-filter>
                            <x-form.select-filter name="blood_component" id="" class="uppercase">
                                <option value="">Blood Component</option>
                                @foreach (config('project.blood_components') as $bloodComponent)
                                    <option class="uppercase" value="{{$bloodComponent}}"
                                    @if(request('blood_component') == $bloodGroup)
                                    selected 
                                    @endif>
                                    {{$bloodComponent}}
                                </option>
                                @endforeach
                            </x-form.select-filter>
                            <x-button.w-full>
                                {{ __('Search') }}
                            </x-button.w-full>
                        </form>
                    </div>
                    
                    <x-table.table>
                        <x-slot name="thead">
                            <tr>
                                <x-table.th>Blood Component</x-table.th>
                                <x-table.th>Blood Group</x-table.th>
                                <x-table.th>Units Available</x-table.th>
                            </tr>                        
                        </x-slot>
                     
                        @forelse ($inventories as $inventory)
                        <tr>
                            <x-table.td class="uppercase">{{$inventory->blood_component}}</x-table.td>
                            <x-table.td class="uppercase">{{$inventory->blood_group}}</x-table.td>
                            <x-table.td class="uppercase">{{$inventory->units}}</x-table.td>
                        </tr>
                        @empty
                        <tr>
                            <x-table.td colspan="3" class="text-center">No Data Found</x-table.td>
                        </tr>
                        @endforelse
                    </x-table.table>               
                </div>
            </div>
        </div>
    </div>
</x-app-layout>