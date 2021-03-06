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
                            <div class="mx-4 inline"><a href="{{route('manager.donation.search')}}">New Entry</a></div>
                            <div class="mx-4 inline">Create</div>
                        </div>
                    </div>

                    @if (count($donations))
                        @foreach ($donations as $donation)
                            <p>
                                {{$donation->user()->name}} 
                                {{$donation->donor_card_no}}
                                {{$donation->pivot->blood_component}}
                                {{$donation->pivot->status}} 
                                {{$donation->pivot->donated_at}} 
                            </p>
                        @endforeach
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>