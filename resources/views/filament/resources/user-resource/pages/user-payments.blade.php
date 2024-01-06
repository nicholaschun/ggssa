 <x-filament-panels::page>
     <x-filament::card>
         <h2>Payments</h2>
         {{ $this->table }}
     </x-filament::card>

     <x-filament::card>
         <div class="flex" style="margin-bottom: 20px">
            <div style="">
              <img style="position: relative;" width="400px" src="{{ asset('images/virtual_card.jpg') }}">
             
            </div>
            <div style="font-size: .7em; font-weight:bold; position:absolute; margin-top: 227px; margin-left: 298px;">{{ 'GGSSA-'. str_pad($record['id'], 6, '0', STR_PAD_LEFT) }}</div>
            <div style="font-size: .7em; font-weight:bold; position:absolute; margin-top: 206px; margin-left: 83px;">{{ $record['first_name'] }} {{ $record['middle_name'] }} {{ $record['last_name'] }} </div>
            <div style="font-size: .7em; font-weight:bold; position:absolute; margin-top: 208px; margin-left: 327px;">{{ $record['workstation'] }} </div>
            <div style="font-size: .7em; font-weight:bold; position:absolute; margin-top: 222px; margin-left: 103px;">{{ $record['department'] }} </div>
            <div style="font-size: .7em; font-weight:bold; position:absolute; margin-top: 71px; margin-left: 47px;">
              <img style="border-radius: 100%; width: 100px; height: 100px" src="{{ asset('images/image-placeholder.jpg') }}">
            </div>

         </div>
         <x-filament-panels::form>
             {{ $this->form }}
         </x-filament-panels::form>
     </x-filament::card>

 </x-filament-panels::page>
