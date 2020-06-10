<div>
    <form wire:submit.prevent="{{ $saveAction }}">
        
        @foreach($fieldsets as $fieldset => $value)
            @if( 'id' === $fieldset)
                @continue
            @endif
        @php
            $fieldsetKey = "fieldsets.$fieldset";
        @endphp
        <div class="my-2">
            <x-form.label for="{{ $fieldsetKey }}" text="{{ $attributeNames[$fieldset] ?? null }}" />
    
            <div class="mt-1">
                @switch( $attributes[$fieldset] ?? null )
                    @case( 'code' )
                        <x-form.input type="text" name="{{ $fieldsetKey }}" value="{{ $value }}" autofocus disabled />
                        @break
                    @case( 'product_code' )
                        <x-form.input type="text" name="{{ $fieldsetKey }}" value="{{ $value }}" autofocus />
                        @break
                    @case( 'email' )
                        <x-form.input type="email" name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                    @case( 'textarea' )
                        <x-form.textarea name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                    @case( 'address' )
                        <x-form.textarea name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                    @case( 'description' )
                        <x-form.textarea name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                    @case( 'price' )
                        <x-form.input type="number" name="{{ $fieldsetKey }}" value="{{ $value }}" min="0" />
                        @break
                    @default
                        <x-form.input type="text" name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                @endswitch
            </div>
            <x-form.error key="{{ $fieldsetKey }}" />
        </div>
        @endforeach
        
        <div class="mt-6">
            <x-form.button type="submit" text="{{ $saveText }}" />
        </div>
    </form>
</div>