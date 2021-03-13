<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Demand Supply Allocation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">


                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Stock ID</x-table.th>
                            <x-table.th>Group</x-table.th>
                            <x-table.th>Component</x-table.th>
                            <x-table.th>Expiry At</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @if ($inventories->count())
                            @foreach ($inventories as $inventory)
                            <tr>
                                <x-table.td>{{ $loop->iteration }}</x-table.td>
                                <x-table.td>{{ $inventory->id }}</x-table.td>
                                <x-table.td>{{ $inventory->blood_group }}</x-table.td>
                                <x-table.td class="uppercase">{{ $inventory->blood_component }}</x-table.td>
                                
                                <x-table.td>{{ $inventory->expiry_at }}</x-table.td>
                                

                                <form action="{{route('manager.demand.update', ['demand' => $demandId ])}}" method="post">
                                    @csrf
                                    @method('put')
                                    <x-table.td>
                                        <x-button>
                                            {{ __('Allocate') }}
                                        </x-button>
                                    </x-table.td>
                                </form>


                            </tr>
                            @endforeach
                        @else
                            <x-table.td class="text-center" colspan="6">No Data Found</x-table.td>
                        @endif

                        

                    </x-table.table>

                    <hr>
                    <div class="mt-4">
                        <h4 class="text-center">Ada for Blood new</h4>

                        <a href="{{route('manager.ada.create', ["id" => $demandId])}}">ADA Create</a>

                        <form action="{{route('manager.bolo.store')}}" method="POST">
                            @csrf
                            <x-input id="demandId" type="hidden" name="demandId" :value="$demandId" />

                            
                            <x-button>
                                {{ __('Ada') }}
                            </x-button>
                        

                        </form>

                    </div>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>