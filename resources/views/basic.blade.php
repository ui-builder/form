<div>
    <form wire:submit.prevent="">
        
        <x-form.fieldsets :fieldsets="$this->fieldsets" />
        
        <div class="mt-6">
            <x-form.button type="submit" text="{{ __('form::action.save') }}" />
        </div>
    </form>
</div>