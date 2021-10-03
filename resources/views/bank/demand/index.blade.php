<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Process Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-5 flex lg:mt-0 lg:ml-4">
                        <span class="hidden sm:block">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{route('bank.demands.create')}}">Create</a>
                        </button>
                        </span>
                    </div>


                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Recipient Name <br> (Guardian Name)</x-table.th>
                            <x-table.th>Recipient Group</x-table.th>
                            <x-table.th>Recipient Component</x-table.th>
                            <x-table.th>Compatible Group</x-table.th>
                            <x-table.th>Required Between</x-table.th>
                            <x-table.th>Ada Request</x-table.th>
                            <x-table.th>Action</x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @forelse ($demands as $demand)
                        <tr>
                            <x-table.td>{{ $loop->iteration }}</x-table.td>
                            <x-table.td>
                                {{ $demand->recipient_name }}
                                @isset($demand->guardian_name)
                                <br>
                                <span>({{ $demand->guardian_name }})</span>
                                @endisset
                            </x-table.td>
                            <x-table.td>{{ $demand->blood_group }}</x-table.td>
                            <x-table.td class="uppercase">{{ $demand->blood_component }}</x-table.td>
                            <x-table.td>
                                @foreach ($demand->compatible_groups as $item)
                                    {{ $loop->last ? $item : $item . ', ' }}
                                @endforeach    
                            </x-table.td>
                            <x-table.td>{{ 
                                $demand->required_at->subDays($demand->buffer_days)->format('d M') . " - " .
                                $demand->required_at->format('d M')
                            }}</x-table.td>
                            <x-table.td>{{ $demand->ada_range }}</x-table.td>
                            <x-table.td>
                                <a href="{{route('bank.demands.edit',  ['demand' => $demand->id ])}}">
                                    Allocate Supply
                                </a>
                            </x-table.td>

                            
                            
                        </tr>
                        @empty
                        <tr>
                            <x-table.td class="text-center" colspan="8">No Data Found</x-table.td>
                        </tr>
                        @endforelse
                    

                        

                    </x-table.table>

                    
                    
                   

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>