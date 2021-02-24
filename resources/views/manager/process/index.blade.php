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

                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Index</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donor Card No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Component</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Group</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Donated At</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($donations as $donation)
                            
                            
                            <form method="POST" 
                                action="{{ route('manager.process.update',  ['process' => $donation->id ]) }}">
                                @csrf
                                <input type="hidden" name="_method" value="PUT">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">{{ ($donations->currentPage() - 1) * 10 + $loop->index + 1}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$donation->donor_card_no}}</td>
                                    <td class="px-6 py-4 uppercase whitespace-nowrap">{{$donation->blood_component}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$donation->blood_group}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">{{$donation->donated_at}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <x-select class="uppercase" name="action">
                                            <option></option>
                                            <option value="stored">store</option>
                                            <option value="failed">Fail</option>
                                        </x-select>
                                    </td>
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
                        </tbody>
                    </table>
                    {{ $donations->links()}}
                    
                    
                   

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>