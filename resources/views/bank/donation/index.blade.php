<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="my-4">
                        <div class="inline-block">
                            <div class="mx-4 inline"><a href="{{route('bank.donations.search')}}">New Entry</a></div>
                            <div class="mx-4 inline">
                                <a href="{{route('bank.donations.create')}}">Create</a>
                            </div>
                        </div>
                    </div>


                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Donor Name</x-table.th>
                            <x-table.th>Donor Card</x-table.th>
                            <x-table.th>Blood Component</x-table.th>
                            <x-table.th>Status</x-table.th>
                            <x-table.th>Donated At</x-table.th>
                            <x-table.th></x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @forelse ($donations as $donation)
                        <tr>
                            <x-table.td>{{ $loop->iteration }}</x-table.td>
                            <x-table.td>{{ $donation->donor->name }}</x-table.td>
                            <x-table.td>{{ $donation->donor->donor_card_no }}</x-table.td>
                            <x-table.td class="uppercase">{{ $donation->blood_component }}</x-table.td>
                            <x-table.td class="uppercase">{{ $donation->status }}</x-table.td>
                            <x-table.td>{{ $donation->donated_at }}</x-table.td>
                            
                            <x-table.td>
                                <a href="{{route('bank.donations.edit',  ['donation' => $donation->id ])}}">
                                    Edit
                                </a>
                            </x-table.td>
                        </tr>
                        @empty
                        <tr>
                            <x-table.td colspan="7" class="text-center">No Data Found</x-table.td>
                        </tr>
                        @endforelse
                        
                    </x-table.table>
                    
                        
                </div>
            </div>
        </div>
    </div>
</x-app-layout>