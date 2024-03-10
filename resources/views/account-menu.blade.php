 <div class="modal-large-anchor">
      <div class="modal-large-backdrop">

        <!-- BEGIN SETTINS MENUS -->        
        @include('modals.general-settings')        
        @include('twittersettings')            
      </div>  <!-- END .main-settings-background -->
      <!-- BEGIN COMMAND MODULE -->

      @include('modals.commandmodule')     

      <!-- END COMMAND MODULE -->
  </div>  <!-- END .main-settings-anchor -->

<style>
/* .general-settings-outer, .twitter-settings-outer, .help-page-outer{display: none;} */

.mt-2 { margin-top: 0.5em;}
</style>
