@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4">
        <div class="flex flex-col items-center justify-center h-screen">
            <div>
                <lord-icon
                    src="https://cdn.lordicon.com/lupuorrc.json"
                    trigger="hover"
                    colors="primary:#121331,secondary:#CCF381"
                    style="width:250px;height:250px">
                </lord-icon>
            </div>
            <h2 class="text-3xl font-bold mb-4">Bedankt voor je bestelling, {{ $order->name }}!</h2>
            <p class="text-lg mb-8">Uw bestelling is succesvol geplaatst. Wij nemen spoedig contact met u op met verdere details.</p>

        </div>
    </div>
@endsection
