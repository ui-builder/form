<div>
    <form wire:submit.prevent="save">
        
        @foreach($fieldsets as $fieldset => $value)
        @php
            $fieldsetKey = "fieldsets.$fieldset";
        @endphp
        <div class="my-2">
            <x-form.label for="{{ $fieldsetKey }}" text="{{ $attributeNames[$fieldset] ?? null }}" />
    
            <div class="mt-1">
                @switch( $types[$fieldset] ?? null )
                    @case( 'code' )
                        <x-form.input type="text" name="{{ $fieldsetKey }}" value="{{ $value }}" autofocus disabled />
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
                    @default
                        <x-form.input type="text" name="{{ $fieldsetKey }}" value="{{ $value }}" />
                        @break
                @endswitch
            </div>
            <x-form.error key="{{ $fieldsetKey }}" />
        </div>
        @endforeach
        
        <div class="mt-6">
            <x-form.button type="submit" text="Save" />
        </div>
    </form>
</div>