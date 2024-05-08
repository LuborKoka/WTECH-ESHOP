@props(['delete' => false, 'lowPrio' => false, 'buy' => false, 'isButton' => false, 'styles' => null, 'id' => null, 'onclick' => null])

@php
    $classes = [];
    if ($delete) {
        $classes[] = 'delete';
    }
    if ($lowPrio) {
        $classes[] = 'low-prio';
    }
    if ($buy) {
        $classes[] = 'buy';
    }
    $classAttributes = implode(' ', $classes);

    // Determine the element tag based on the value of isButton prop
    $elementTag = $isButton ? 'button' : 'div';
@endphp

<{{ $elementTag }} class="clickable-button {{ $classAttributes }}" @if($id !== null) id="{{ $id }}" @endif @if($styles !== null) style="{{ $styles }}" @endif @if($onclick !== null) onclick="{{ $onclick }}" @endif>
     {{ $slot }}
</{{ $elementTag }}>
