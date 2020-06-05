<div>
    <form wire:submit.prevent="save">
        
        @foreach($fieldsets as $fieldset => $value)
        <div class="my-2">
            <x-form.label for="{{ $fieldset }}" text="{{ $attributeNames[$fieldset] ?? null }}" />
    
            <div class="mt-1">
                @switch( $casts[$fieldset] ?? null )
                    @case( 'code' )
                        <x-form.input type="text" name="{{ $fieldset }}" value="{{ $value }}" autofocus disabled />
                        @break
                    @case( 'email' )
                        <x-form.input type="email" name="{{ $fieldset }}"value="{{ $value }}" />
                        @break
                    @case( 'textarea' )
                        <x-form.textarea name="{{ $fieldset }}" value="{{ $value }}" />
                        @break
                    @default
                        <x-form.input type="text" name="{{ $fieldset }}" value="{{ $value }}" />
                        @break
                @endswitch
            </div>
    
            <x-form.error key="{{ $fieldset }}" />
        </div>
        @endforeach
        
        <div class="mt-6">
            <x-form.button type="submit" text="Save" />
        </div>
    </form>
</div>