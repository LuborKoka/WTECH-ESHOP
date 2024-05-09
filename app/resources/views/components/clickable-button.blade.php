@props(['delete' => false, 'lowPrio' => false, 'buy' => false, 'type' => 'button', 'disabled' => false, 'styles' => '', 'id' => null, 'onclick' => null])

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
@endphp

<button class="clickable-button {{ $classAttributes }}" style="{{ $styles }}" type="{{ $type }}"
    @if($id !== null) id="{{ $id }}" @endif
    @if($onclick !== null) onclick="{{ $onclick }}" @endif
    @if($disabled === true) disabled @endif
    >
     {{ $slot }}
</button>
