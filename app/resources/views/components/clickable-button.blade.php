@props(['delete' => false, 'lowPrio' => false, 'styles' => '', 'id' => null, 'onclick' => null])

@php
    $classes = [];
    if ($delete) {
        $classes[] = 'delete';
    }
    if ($lowPrio) {
        $classes[] = 'low-prio';
    }
    $classAttributes = implode(' ', $classes);
@endphp

<div class="clickable-button {{ $classAttributes }}" id="{{ $id }}" style="{{ $styles }}" onclick="{{ $onclick }}">
     {{ $slot }}
</div>
