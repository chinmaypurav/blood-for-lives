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
                    <p><a href="{{ route('admin.bank.create') }}">New Bank Page</a></p>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <x-table.th>Sr No</x-table.th>
                            <x-table.th>Bank Code</x-table.th>
                            <x-table.th>Bank Name</x-table.th>
                            <x-table.th>Bank Address</x-table.th>
                            <x-table.th>Bank Postal</x-table.th>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if ($banks->count())
                                @foreach ($banks as $bank)
                                    <tr>
                                        <x-table.td>{{ $loop->index + 1 }}</x-table.td>
                                        <x-table.td class="uppercase">{{ $bank->bank_code }}</x-table.td>
                                        <x-table.td>{{ $bank->name }}</x-table.td>
                                        <x-table.td>{{ $bank->address }}</x-table.td>
                                        <x-table.td>{{ $bank->postal }}</x-table.td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    
                    {{ $banks->links() }}
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>