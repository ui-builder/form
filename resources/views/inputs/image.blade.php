@include( 'form::inputs.input',[
    'type' => 'file',
    'name' => $name,
    'attributes' => $attributes
])
<div wire:loading wire:target="{{ $name }}">Tải lên...</div>
@if ( null !== $attributes['src'])
    <img src="{{ $attributes['src'] }}">
@endif