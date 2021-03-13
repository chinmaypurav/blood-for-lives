<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manager List') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <div class="mt-5 flex lg:mt-0 lg:ml-4">
                        <span class="hidden sm:block">
                        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            <a href="{{route('manager.manager.create')}}">Create</a>
                        </button>
                        </span>
                    </div>


                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.th>Index</x-table.th>
                            <x-table.th>Name</x-table.th>
                            <x-table.th>Email</x-table.th>
                            <x-table.th>Created At</x-table.th>
                        </x-slot>
                        {{-- td --}}
                        @if ($managers->count())
                            @foreach ($managers as $manager)
                            <tr>
                                <x-table.td>{{ $loop->iteration }}</x-table.td>
                                <x-table.td>{{ $manager->name }}</x-table.td>
                                <x-table.td>
                                    {{ $manager->email === auth()->user()->email ? $manager->email . ' (Admin)' : $manager->email }}
                                </x-table.td>
                                <x-table.td>{{ $manager->created_at }}</x-table.td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <x-table.td class="text-center" colspan="6">No Data Found</x-table.td>
                            </tr>
                        @endif
        
                    </x-table.table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>