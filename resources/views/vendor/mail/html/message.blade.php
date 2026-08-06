<x-mail::layout>
{{-- Header --}}
<x-slot:header>
<x-mail::header :url="config('app.url')">

    <img src="{{ url('image.png') }}" 
         alt="SLSU Logo"
         style="height: 60px; display:block; margin:auto;">

    <div style="text-align:center; font-size:14px; color:#555; margin-top:5px;">
        SLSU Facility Reservation System
    </div>

</x-mail::header>
</x-slot:header>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
@isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
© {{ date('Y') }} SLSU Facility Reservation System. All rights reserved.
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
