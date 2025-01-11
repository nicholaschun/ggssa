<x-filament-panels::page>

  <x-filament::card>
  @if (!auth()->user()->profile_set)
  <div class="mb-4 bg-orange-100 border-l-4 border-orange-500 text-orange-700 p-4" role="alert">
  <p class="font-bold">Change Password!</p>
  <p>You are using a default password. Please change your password to complete your profile setup</p>

</div>
@endif
    <x-filament-panels::form wire:submit="updateSettings">
        {{ $this->editSettingsForm }}
        <!-- <x-filament-panels::form.actions 
            :actions="$this->getUpdateProfileFormActions()"
        /> -->
    </x-filament-panels::form>
    <br>
    <br>
    <div wire:loading.delay.longest wire:target="updatePassword" 
            class="absolute inset-0 bg-gray-50/50 dark:bg-gray-800/50 flex items-center justify-center">
            <div class="flex items-center gap-x-2">
                <div class="w-4 h-4 border-2 border-primary-500 border-t-transparent rounded-full animate-spin"></div>
                <span class="text-sm">Updating password...</span>
            </div>
        </div>
    <x-filament-panels::form wire:submit="updatePassword">
        {{ $this->editPasswordForm }}
        <x-filament-panels::form.actions 
            :actions="$this->getUpdatePasswordFormActions()"
        />
    </x-filament-panels::form>

</x-filament::card>
</x-filament-panels::page>

