
@foreach($fieldsets as $fieldset)
    @if( null === $fieldset->component)
        @continue
    @endif
    
    <div class="my-2">
        <x-form.label for="{{ $fieldset->key }}" text="{{ $fieldset->label ?? null }}" />

        <div class="mt-1">
            @render( $fieldset->component, $fieldset->data )
        </div>

        <x-form.error key="{{ $fieldset->key }}" />
    </div>
@endforeach