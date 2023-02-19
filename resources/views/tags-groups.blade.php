@extends('layouts.app')

@section('content')
<div class="page-outer tag-groups-outer">
                <div class="page-inner tag-groups-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Tag Groups</span>
                    </div>  <!-- END .head-left-wrap -->
                    <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-tag-group-icon" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="new-tag-group-modal-wrap">
                    <div class="new-tag-group-modal frosted">
                      <div class="new-title-wrap">
                        <img src="{{ asset('public/')}}/ui-images/icons/18-tag-groups.svg" class="ui-icon" />
                        <span>New Tag Group Name:</span>
                      </div>  <!-- END .new-title-wrap -->
                      <form>
                        <input type="text" class="group-title-input" placeholder="New Tag Group title here..." />
                        <input type="submit" class="group-title-submit" value="Add New Tag Group" />
                      </form>
                    </div>  <!-- END .new-tag-group -->
                  </div>  <!-- END .new-tag-group-modal-wrap -->


                  <div class="tag-groups-tool-outer">
                    <div class="tag-groups-tool-inner">

                        <div class="tag-groups-column-wrap">

                          <div class="tag-groups-column tag-groups-left-column">
                            <div class="tag-groups-left-column-inside">


                            <!-- BEGIN Tag Option Instance -->
                            <div class="tag-group-controller">
                              <div class"tag-group-option">
                                <span class="tag-option-title-wrap">
                                  <img src="{{ asset('public/')}}/" class="ui-icon tag-option-icon" />
                                  <span class="tag-option-title">
                                    Group #1</span>
                                </span>  <!-- END .tag-option-title-wrap -->
                              </div>  <!-- END .tag-group-option -->
                            </div>  <!-- END .tag-group-controller -->
                            <!-- END Tag Option Instance -->

                                          <!-- BEGIN Tag Option Instance -->
                                          <div class="tag-group-controller active-tag-group">
                                            <div class"tag-group-option">
                                              <span class="tag-option-title-wrap">
                                                <img src="{{ asset('public/')}}/" class="ui-icon tag-option-icon" />
                                                <span class="tag-option-title">
                                                  Group #2</span>
                                              </span>  <!-- END .tag-option-title-wrap -->
                                            </div>  <!-- END .tag-group-option -->
                                          </div>  <!-- END .tag-group-controller -->
                                          <!-- END Tag Option Instance -->

                                          <!-- BEGIN Tag Option Instance -->
                                          <div class="tag-group-controller">
                                            <div class"tag-group-option">
                                              <span class="tag-option-title-wrap">
                                                <img src="{{ asset('public/')}}/" class="ui-icon tag-option-icon" />
                                                <span class="tag-option-title">
                                                  Group #3</span>
                                              </span>  <!-- END .tag-option-title-wrap -->
                                            </div>  <!-- END .tag-group-option -->
                                          </div>  <!-- END .tag-group-controller -->
                                          <!-- END Tag Option Instance -->

                            </div>  <!-- END .tag-groups-left-column-inside -->
                          </div>  <!-- END .tag-groups-left-column -->


                          <div class="tag-groups-column tag-groups-right-column">
                            <div class="tag-group-display">

                                <div class="tagset-wrap">

                                  <div class="add-tag-to-tagset">
                                    <form>
                                      <input type="text" placeholder="Add a new tag here and press enter..." />
                                    </form>
                                  </div>  <!-- END .add-tag-to-tagset -->

                                  <span class="existing-tag">
                                    #marketing</span>

                                                <span class="existing-tag">
                                                #business</span>
                                                <span class="existing-tag">
                                                #entrepreneurs</span>
                                                <span class="existing-tag">
                                                #onlineBusiness</span>
                                                <span class="existing-tag">
                                                #entrepreneurGrind</span>

                                </div>  <!-- END .tagset-wrap -->

                            </div>  <!-- END .tag-group-display -->
                          </div>  <!-- END .tag-groups-right-column -->

                        </div>  <!-- END .tag-groups-column-wrap -->

                    </div>  <!-- END .tag-groups-tool-inner -->
                  </div>  <!-- END .tag-groups-tool-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->
@endsection
