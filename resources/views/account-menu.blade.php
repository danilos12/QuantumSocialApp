

<div class="modal-large-anchor">
  <div class="modal-large-backdrop">    

    <div class="add-team-member-modal">
      <div class="add-team-member-inner montserrat " style="color: white">
        <img src="{{ asset('public/')}}/ui-images/icon2/Edit.svg" class="editiconadd" id=""/>
        <div class="exit-button" >

          <svg id="closing" style="width: 10%;" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-2 h-2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
          </svg>

        </div>
          <!-- BEGIN input copied from engage.html -->
          <div class="global-input-email add-team-fonts ">
            <form class="global-input-email">
                <div class="">
                  <div class="w-full font-normal" ><label class="font-normal" for="newuser_fname" >YOU ARE CURRENLY <span id="actionLabel">ADDING</span>:</label></div>
                  <div  id="alertcontainer" style="display: flex;justify-content:center; width:100%;"></div>
                    <div class="w-full">
                      <div class="w-full " ><label class="font-normal" for="newuser_fname" >FULL NAME</label></div>

                    <input class="h-10 w-full" type="text" placeholder="Name" id="newuser_fname"/>
                    </div>
                    <div class="w-full">

                        <label class="font-normal" for="newuser_fname ">Email Address</label>
                        <div id="emailSpan" style="display: none;align-items: center;height: 50px;">
                          <div class="mr-3"><span id="emailSpansa" class="font-normal" ></span></div>

                          <div class="w-5 h-5 svgiconhover">
                            <svg  xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
                            </svg>
                            <div class="tooltip-text" id="tooltipText">Verified</div>
                          </div>
                        </div>

                    <input class="h-10 w-full" type="text" placeholder="Email" id="newuser_email"/>

                    </div>
              </div>
                <div class="conts">
                  <div class="flex w-full items-center">
                    <div class="flex justify-start items-center" >
                    <label for="toggle_api" class="font-size-base mr-3 font-normal ">GRANT API ACCESS (Allow users to...)</label>
                    <input type="checkbox" class="menu-twirl-toggle " name="grant-api" id="toggle_api" >
                  </div>

                  </div>


                  <div class="conts mb-4">
                    <div class="flex items-center w-full mb-11">
                        <div class="flex justify-center" style="height: 20px;width:30px;" >
                          <input style='scale:2.5' type="radio" id="member_role" name="fav_language" value="Member">
                        </div>
                    <label class="bits font-normal" for="javascript">Team Member (Allows user to schedule posts..)</label>
                  </div>
                  <div class="flex w-full items-center ">
                    <div class="flex justify-center" style="height: 20px;width:30px;" >
                        <input style="scale:2.5" type="radio" id="admin_role" name="fav_language" value="Admin">
                    </div>
                    <label class="bits font-normal" for="admin_role">Admin (Allows user to add other members)</label>
                  </div>

                  </div>
                </div>




            </form>
            <div class="center-block">
              <span  class="add-team-button"><span id="labeling">Add</span></span>
            </div>
          </div>
          <!-- END copied from engage.html -->

      </div>  <!-- END .add-team-member-inner -->
    </div>  <!-- END .add-team-member-modal -->

    <div class="change-pass-modal" style="display: none"> 
      <div class="change-pass-inner frosted">         
          <!-- BEGIN input copied from engage.html -->
          <img src="{{ asset('public/')}}/ui-images/icon2/Edit.svg" class="editiconadd" id=""/>
          <div class="exit-button" >
            <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon settings-close close-change-pass" id="close-change-pass"/>
          </div>

          <div class="menu-header font-white">Change Password</div>
          <div class="global-input-email"> 
            <form id="changePassForm">
              <div class="global-input-text input-text">  
                <input type="text" placeholder="Old Password" id="old_password" name="old_password"/>
              </div>
              
              <div class="global-input-text input-text">  
                <input type="text" placeholder="New Password" id="new_password" name="new_password"/>
              </div>

              <input type="submit" value="Change Password" class="font-white">
            </form>                  
          </div>
          <!-- END copied from engage.html -->

      </div>  <!-- END .add-team-member-inner -->
    </div>  <!-- END .add-team-member-modal -->   

    
    @include('modals.general-settings')

    @include('twittersettings')    


  </div>  <!-- END .main-settings-background -->
  <!-- BEGIN COMMAND MODULE -->

  @include('modals.commandmodule')
  {{-- @include('modals.edit-commandmodule') --}}

  <!-- END COMMAND MODULE -->
</div>  <!-- END .main-settings-anchor -->

<style>
/* .general-settings-outer, .twitter-settings-outer, .help-page-outer{display: none;} */

.mt-2 { margin-top: 0.5em;}
</style>
