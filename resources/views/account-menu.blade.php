 <div class="modal-large-anchor">
      <div class="modal-large-backdrop">

        <!-- BEGIN SETTINS MENUS -->        
        @include('modals.general-settings')        
        @include('twittersettings')            
      </div>  <!-- END .main-settings-background -->
      <!-- BEGIN COMMAND MODULE -->

      @include('modals.commandmodule')
      {{-- @include('modals.edit-commandmodule') --}}

      <!-- END COMMAND MODULE -->
  </div>  <!-- END .main-settings-anchor -->

<style>
.general-settings-outer, .twitter-settings-outer, .help-page-outer, .command-module-outer{display: none;}

.mt-2 { margin-top: 0.5em;}
</style>

@section('scripts')
{{-- <script type='text/javascript' src="{{asset('public/js/generalSettings.js')}}"></script> --}}
@endsection