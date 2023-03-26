@extends('layouts.app')

@section('content')
<div class="page-outer evergreen-outer">
                <div class="page-inner evergreen-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Evergreen Tweets</span>
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
                    <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon paste-evergreen-tweet" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="paste-evergreen-tweet-modal-wrap">
                    <div class="paste-evergreen-tweet-modal frosted">

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
                            <span class="global-profile-handle">
                              <a href="">
                                @WilliamWallace</a></span>
                          </div>  <!-- END .global-post-date-wrap -->
                        </div>  <!-- END .global-author-details -->
                      </div>  <!-- END .global-twitter-profile-header -->

                      <div class="paste-evergreen-link">
                        <input type="text" placeholder="Paste Tweet URL here...">
                      </div>

                    </div>  <!-- END .paste-evergreen-tweet-modal -->
                  </div>  <!-- END .paste-evergreen-tweet-modal-wrap -->


                  <div class="profile-posts-outer">
                    <div class="profile-posts-inner">

                      <!-- BEGIN Single Post Instance -->
                      <div class="mosaic-posts-outer evergreen-mosaic" status="active">
                        <div class="mosaic-watermark-wrap frosted">
                          <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="mosaic-watermark evergreen-watermark" />
                          <div class="mosaic-posts-inner">

                            <div class="mosaic-post-controls">
                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-add.svg"
                                class="ui-icon"/></span>

                                    <!-- This one gets deleted after JS toggle & status is working. -->
                                    <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-remove.svg" class="ui-icon"/></span>

                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
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

                            <div class="mosaic-post-scheduling">

                              <div class="mosaic-scheduling mosaic-scheduling-future">

                                <span class="mosaic-label mosaic-future-label">
                                  <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
                                  Schedule
                                </span>
                                <span class="mosaic-sched-buttons mosaic-future-buttons">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon" />
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                  <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon" />
                                </span>

                              </div>  <!-- END .mosaic-scheduling-future -->

                              <div class="mosaic-scheduling mosaic-post-analytics">

                                <span class="mosaic-label mosaic-analytics-label">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-analytics.svg" class="ui-icon" />
                                  Analytics
                                </span>
                                <span class="mosaic-sched-buttons mosaic-analytics-buttons">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-retweets">2.20</span>
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-hearts">2010</span>
                                </span>

                              </div>  <!-- END .mosaic-post-analytics -->

                            </div>  <!-- END .mosaic-post-scheduling -->

                          </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                      </div>  <!-- END .mosaic-posts-outer -->
                      <!-- END Single Post Instance -->


                      <!-- Inactive Version SAMPLE -->
                            <!-- BEGIN Single Post Instance -->
                            <div class="mosaic-posts-outer evergreen-mosaic" status="inactive">
                              <div class="mosaic-watermark-wrap frosted">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="mosaic-watermark evergreen-watermark" />
                                <div class="mosaic-posts-inner">

                                  <div class="mosaic-post-controls">
                                    <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-add.svg"
                                      class="ui-icon"/></span>

                                          <!-- This one gets deleted after JS toggle & status is working. -->
                                          <span class="mosaic-control-icon">
                                            <img src="{{ asset('public/')}}/ui-images/icons/pg-remove.svg" class="ui-icon"/></span>

                                    <span class="mosaic-control-icon">
                                      <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
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

                                  <div class="mosaic-post-scheduling">

                                    <div class="mosaic-scheduling mosaic-scheduling-future">

                                      <span class="mosaic-label mosaic-future-label">
                                        <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
                                        Schedule
                                      </span>
                                      <span class="mosaic-sched-buttons mosaic-future-buttons">
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon" />
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                        <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon" />
                                      </span>

                                    </div>  <!-- END .mosaic-scheduling-future -->

                                    <div class="mosaic-scheduling mosaic-post-analytics">

                                      <span class="mosaic-label mosaic-analytics-label">
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-analytics.svg" class="ui-icon" />
                                        Analytics
                                      </span>
                                      <span class="mosaic-sched-buttons mosaic-analytics-buttons">
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                        <span class="mosaic-stat stat-retweets">2.20</span>
                                        <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                        <span class="mosaic-stat stat-hearts">2010</span>
                                      </span>

                                    </div>  <!-- END .mosaic-post-analytics -->

                                  </div>  <!-- END .mosaic-post-scheduling -->

                                </div>  <!-- END .mosaic-posts-inner -->
                              </div>  <!-- END .mosaic-watermark-wrap -->
                            </div>  <!-- END .mosaic-posts-outer -->
                            <!-- END Single Post Instance -->




                    </div>  <!-- END .profile-posts-inner -->
                  </div>  <!-- END .profile-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->


@endsection
