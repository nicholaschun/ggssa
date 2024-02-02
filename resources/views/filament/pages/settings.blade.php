<x-filament-panels::page>

  <x-filament::card>
    <x-filament-panels::form wire:submit="updateSettings">
        {{ $this->editSettingsForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getUpdateProfileFormActions()"
        />
    </x-filament-panels::form>
    <br>
    <br>
    <x-filament-panels::form wire:submit="updatePassword">
        {{ $this->editPasswordForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getUpdatePasswordFormActions()"
        />
    </x-filament-panels::form>

</x-filament::card>
</x-filament-panels::page>

