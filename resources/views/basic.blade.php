<div>
    <form wire:submit.prevent="{{ $saveAction }}">
        
        @foreach($this->fieldsets as $fieldset)

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
        
        <div class="mt-6">
            <x-form.button type="submit" text="{{ $saveText }}" />
        </div>
    </form>
</div>