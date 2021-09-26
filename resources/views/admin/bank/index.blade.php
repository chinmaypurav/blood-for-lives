<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bank') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <a href="{{ route('admin.banks.create') }}">
                            <button class=" bg-green-500 py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                  </svg>
                            </button>
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <x-table.th>Sr No</x-table.th>
                            <x-table.th>Bank Code</x-table.th>
                            <x-table.th>Bank Name</x-table.th>
                            <x-table.th>Bank Address</x-table.th>
                            <x-table.th>Bank Postal</x-table.th>
                            <x-table.th></x-table.th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($banks as $bank)
                            <tr>
                                <x-table.td>{{ $loop->index + 1 }}</x-table.td>
                                <x-table.td class="uppercase">{{ $bank->bank_code }}</x-table.td>
                                <x-table.td>{{ $bank->name }}</x-table.td>
                                <x-table.td>{{ $bank->address }}</x-table.td>
                                <x-table.td>{{ $bank->postal }}</x-table.td>
                                <x-table.td>
                                    <a href="{{route('admin.banks.show', ['bank' => $bank->id])}}">View</a>
                                    <form action="{{route('admin.banks.destroy', ['bank' => $bank->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </x-table.td>
                            </tr>
                            @empty
                            <tr>
                                <x-table.td colspan="5" class="text-center">No Data Found</x-table.td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    {{ $banks->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>