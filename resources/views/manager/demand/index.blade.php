<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blood Process Entry') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Index</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient Blood Group</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Recipient Component</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Required At</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Buffer Time</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Compatible Groups</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($demands->count())
                                 
                            
                            @foreach ($demands as $demand)
                            
                            
                            <form method="POST" 
                                action="{{ route('manager.process.update',  ['process' => $demand->id ]) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$loop->index + 1}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$demand->recipient_name}}</td>
                                    <td class="px-6 py-4 uppercase whitespace-nowrap">{{$demand->recipientGroup}}</td>
                                    <td class="px-6 py-4 uppercase whitespace-nowrap">{{$demand->recipientComponent}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$demand->required_at}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{$demand->buffer_time}}</div>
                                        <div class="text-sm text-gray-500">Human Diff</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @foreach ($demand->compatible_blood_group as $item)
                                            {{ $loop->last ? $item : $item . ', ' }}

                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <input type="hidden" name="donor_id" value="{{$demand->id}}" />
                                        <input type="hidden" name="donated_at" value="{{$demand->id}}" />

                                        <x-button class="ml-4">
                                            {{ __('Save') }}
                                        </x-button>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            @endif

                        </tbody>
                    </table>
                    
                    
                   

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>