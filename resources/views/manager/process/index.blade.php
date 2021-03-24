<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donated Blood Unprocessed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Donor Card</x-table.th>
                            <x-table.th>Component</x-table.th>
                            <x-table.th>Group</x-table.th>
                            <x-table.th>Donated At</x-table.th>
                            <x-table.th>Status</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @if ($donations->count())
                            @foreach ($donations as $donation)
                            <form method="POST" 
                                action="{{ route('manager.process.update',  ['process' => $donation->id ]) }}">
                                @csrf
                                @method('put')
                                <tr>
                                    <x-table.td>{{ $loop->iteration }}</x-table.td>
                                    <x-table.td>{{ $donation->donor->donor_card_no }}</x-table.td>
                                    <x-table.td class="uppercase">{{ $donation->blood_component }}</x-table.td>
                                    <x-table.td class="uppercase">{{ $donation->donor->blood_group }}</x-table.td>
                                    <x-table.td>{{ $donation->donated_at }}</x-table.td>
                                    <x-table.td>
                                        <x-select class="uppercase" name="action">
                                            <option></option>
                                            <option value="stored">store</option>
                                            <option value="failed">Fail</option>
                                        </x-select>
                                    </x-table.td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="hidden" name="donor_id" value="{{$donation->id}}" />
                                        <input type="hidden" name="donated_at" value="{{$donation->donated_at}}" />
                                        <input type="hidden" name="donated_at" value="{{$donation->donated_at}}" />
                                        

                                        <x-button class="ml-4">
                                            {{ __('Update') }}
                                        </x-button>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            @endif

                    </x-table.table>
                    {{ $donations->links()}}
                    
                    
                   

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>