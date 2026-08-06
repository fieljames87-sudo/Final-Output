@props(['url'])

<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block; text-align: center;">

    <!-- YOUR LOGO -->
    <img src="{{ url('image.png') }}" 
         class="logo" 
         alt="SLSU Logo"
         style="height: 60px; display: block; margin: auto;">

    <!-- OPTIONAL TEXT BELOW LOGO -->
    <div style="font-size: 14px; color: #555; margin-top: 5px;">
        SLSU Facility Reservation System
    </div>

</a>
</td>
</tr>
