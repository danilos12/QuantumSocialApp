@extends('layouts.app')

@section('content')

<div class="page-outer promos-outer">
                <div class="page-inner promos-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Promo Tweets</span>
                      <div class="toggle-wrapper">
                        <label class="toggleSwitch large" onclick="">
                          <input type="checkbox" checked />
                          <span>
                              <span>INACTIVE</span>
                              <span>ACTIVE</span>
                          </span>
                          <a></a>
                        </label>
                      </div>  <!-- END .toggle-wrapper -->
                    </div>  <!-- END .head-left-wrap -->
                    <div class="head-right-wrap">
                      <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon new-promo-tweet" />
                      <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
                    </div>  <!-- END .head-icon-wrap -->
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="filter-controls">
                    <div class="drop-button-wrap filter-wrap user-list-wrap">
                      <span class="white-select-button profile-filter-select">
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                        Campaigns:
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-filter-dropdown frosted">
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #1</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #2</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #3</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #4</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #5</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #6</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #7</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #8</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #9</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #10</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #11</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #12</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #13</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #14</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Campaign #15</li>
                      </ul>
                    </div>  <!-- END .filter-wrap -->



                    <div class=""><!--drop-button-wrap filter-wrap user-list-wrap-->
                      <span class="white-select-button-small"> <!--profile-filter-select -->
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-plus.svg" class="ui-icon" />
                      </span>
                    </div>  <!-- END .filter-wrap -->
                  </div>  <!-- END .filter-controls -->


                  <div class="profile-posts-outer">
                    <div class="profile-posts-inner">

                      <!-- BEGIN Single Post Instance -->
                      <div class="mosaic-posts-outer promo-mosaic" status="active">
                        <div class="mosaic-watermark-wrap frosted">
                          <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="mosaic-watermark promo-watermark" />
                          <div class="mosaic-posts-inner">

                            <div class="mosaic-post-controls">
                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-add.svg"
                                class="ui-icon"/></span>

                                    <!-- This one gets deleted after JS toggle & status is working. -->
                                    <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-remove.svg" class="ui-icon"/></span>
<!--
                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
-->
                                <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                            </div>  <!-- END .mosaic-post-controls -->

                            <div class="global-twitter-profile-header">
                              <a href="#">
                                <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png"
                                  class="global-profile-image" /></a>
                              <div class="global-profile-details">
                                <div class="global-profile-name">
                                  <a href="#">
                                    William Wallace</a>
                                </div>  <!-- END .global-author-name -->
                                <div class="global-profile-subdata">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
                                  <span class="global-post-date">
                                    <a href="">
                                      Dec. 16, 2022 @ 5:20 p.m.</a></span>
                                </div>  <!-- END .global-post-date-wrap -->
                              </div>  <!-- END .global-author-details -->
                            </div>  <!-- END .global-post-author -->

                            <div class="mosaic-post-data">
                              <div class="mosaic-post-text">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                              </div>  <!-- END .mosaic-post-text -->
                              <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                          </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                      </div>  <!-- END .mosaic-posts-outer -->
                      <!-- END Single Post Instance -->


                      <!-- Inactive Version SAMPLE -->
                            <!-- BEGIN Single Post Instance -->
                            <div class="mosaic-posts-outer promos-mosaic" status="inactive">
                              <div class="mosaic-watermark-wrap frosted">
                                <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="mosaic-watermark promo-watermark" />
                                <div class="mosaic-posts-inner">

                                  <div class="mosaic-post-controls">
                                    <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-add.svg"
                                      class="ui-icon"/></span>

                                          <!-- This one gets deleted after JS toggle & status is working. -->
                                          <span class="mosaic-control-icon">
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-remove.svg" class="ui-icon"/></span>
<!--
                                    <span class="mosaic-control-icon">
                               <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
    -->   
                                      <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                                  </div>  <!-- END .mosaic-post-controls -->

                                  <div class="global-twitter-profile-header">
                                    <a href="#">
                                      <img src="{{ asset('public/')}}/temp-images/imgpsh_fullsize_anim (1).png"
                                        class="global-profile-image" /></a>
                                    <div class="global-profile-details">
                                      <div class="global-profile-name">
                                        <a href="#">
                                          William Wallace</a>
                                      </div>  <!-- END .global-author-name -->
                                      <div class="global-profile-subdata">
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
                                        <span class="global-post-date">
                                          <a href="">
                                            Dec. 16, 2022 @ 5:20 p.m.</a></span>
                                      </div>  <!-- END .global-post-date-wrap -->
                                    </div>  <!-- END .global-author-details -->
                                  </div>  <!-- END .global-post-author -->

                                  <div class="mosaic-post-data">
                                    <div class="mosaic-post-text">
                                      Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                                    </div>  <!-- END .mosaic-post-text -->
                                    <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                      class="mosaic-post-image" />
                                  </div>  <!-- END .mosaic-post-data -->

                                </div>  <!-- END .mosaic-posts-inner -->
                              </div>  <!-- END .mosaic-watermark-wrap -->
                            </div>  <!-- END .mosaic-posts-outer -->
                            <!-- END Single Post Instance -->




                    </div>  <!-- END .profile-posts-inner -->
                  </div>  <!-- END .profile-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->


@endsection