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

                    
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Component</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Blood Group</th>
                            <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Units Available</th>
                            
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($inventories as $inventory)
                            
                                <tr>
                                    <td class="px-6 py-4 uppercase whitespace-nowrap text-center">{{$inventory->blood_component}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{$inventory->blood_group}}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-center">{{$inventory->unit_count}}</td>

                                </tr>
                            
                            @endforeach
                        </tbody>
                    </table>
                    
                    
                   

                    

                </div>
            </div>
        </div>
    </div>
</x-app-layout>