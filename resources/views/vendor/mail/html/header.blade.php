@props(['url'])
<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'Laravel')
            <img src="http://82.25.91.145/images/Logo2.png" alt="HomeHive" width="120">
            @else
            {!! $slot !!}
            @endif
        </a>
    </td>
</tr>