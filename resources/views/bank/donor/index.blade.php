<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Add New Donor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p><a href="{{ route('bank.donors.create') }}">Create</a></p>
                    <p><a href="{{ route('bank.donors.index') }}">Index</a></p>
                    <p><a href="{{ route('bank.donations.index') }}">Index</a></p>
                    <br>
                    <div class="mb-2"><span class="bg-pink-600">New</span></div>
                    <x-table.table>
                        <x-slot name="thead">
                            <tr>
                                <x-table.th>Index</x-table.th>
                                <x-table.th>Donor Name</x-table.th>
                                <x-table.th>Camp Name</x-table.th>
                                <x-table.th>Address</x-table.th>
                                <x-table.th>Action</x-table.th>
                            </tr>
                        </x-slot>
                        {{-- td --}}
                        @forelse ($donors as $donor)
                            <tr>
                                <x-table.td>{{ $loop->iteration }}</x-table.td>
                                <x-table.td>{{ $donor->name }}</x-table.td>
                                <x-table.td>{{ $donor->name }}</x-table.td>
                                <x-table.td>{{ $donor->address }}</x-table.td>
                                
                                <x-table.td>
                                    <a href="{{route('bank.camps.show',  ['camp' => $donor->id ])}}">
                                        Show
                                    </a>
                                </x-table.td>

                                
                                
                            </tr>
                        @empty
                            <x-table.td class="text-center" colspan="6">No Data Found</x-table.td>
                        @endforelse

                        

                    </x-table.table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>