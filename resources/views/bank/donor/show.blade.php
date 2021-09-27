<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Donor Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p>Donor Name: {{$donor->user->name}}</p>
                    <p>Donor Group: {{$donor->blood_group}}</p>
                    <br><br>


                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Component</x-table.th>
                            <x-table.th>Donated At</x-table.th>
                            <x-table.th>Remarks</x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @if ($donor->donations->count())
                            @foreach ($donor->donations as $donation)
                            <tr>
                                <x-table.td>{{ $loop->iteration }}</x-table.td>
                                <x-table.td>{{ $donation->pivot->blood_component }}</x-table.td>
                                <x-table.td>{{ $donation->pivot->donated_at }}</x-table.td>
                                <x-table.td>{{ '--' }}</x-table.td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <x-table.td class="text-center" colspan="4">No History Found</x-table.td>
                            </tr>
                        @endif
        
                    </x-table.table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>