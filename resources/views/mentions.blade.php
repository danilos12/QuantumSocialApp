@extends('layouts.app')

@section('content')

<div class="page-outer engage-outer">
                <div class="page-inner engage-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">

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

                      </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="profile-posts-outer">
                    <div class="profile-posts-inner">

                      <!-- BEGIN Single Post Instance -->
                      <div class="mosaic-posts-outer">
                        <div class="mosaic-watermark-wrap frosted">
                          <img src="{{ asset('public/')}}/ui-images/icons/12-mentions.svg" class="mosaic-watermark engage-watermark" />
                          <div class="mosaic-posts-inner">

                            <div class="mosaic-post-controls">
                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
                              <span class="mosaic-control-icon">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-hide.svg" class="ui-icon" /></span>
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
                            </div>  <!-- END .global-twitter-profile-header -->

                            <div class="mosaic-post-data">
                              <div class="mosaic-post-text">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                              </div>  <!-- END .mosaic-post-text -->
                              <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                            <div class="mosaic-post-scheduling">

                              <div class="mosaic-scheduling mosaic-post-analytics engage-scheduling">

                                <span class="mosaic-label mosaic-analytics-label">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon" />
                                  Engage
                                </span>
                                <span class="mosaic-sched-buttons">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-retweets">2.20</span>
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                  <span class="mosaic-stat stat-hearts">2010</span>
                                </span>

                              </div>  <!-- END .mosaic-post-analytics -->

                              <div class="glogal-engage-comment-area">
                                <form>
                                  <textarea placeholder="Add a comment..."></textarea>
                                </form>
                                <span class="engage-comment-button">
                                  Send Comment<span>
                              </div>

                            </div>  <!-- END .mosaic-post-scheduling -->

                          </div>  <!-- END .mosaic-posts-inner -->
                        </div>  <!-- END .mosaic-watermark-wrap -->
                      </div>  <!-- END .mosaic-posts-outer -->
                      <!-- END Single Post Instance -->


                                    <!-- BEGIN Single Post Instance -->
                                    <div class="mosaic-posts-outer">
                                      <div class="mosaic-watermark-wrap frosted">
                                        <img src="{{ asset('public/')}}/ui-images/icons/12-mentions.svg" class="mosaic-watermark engage-watermark" />
                                        <div class="mosaic-posts-inner">

                                          <div class="mosaic-post-controls">
                                            <span class="mosaic-control-icon">
                                              <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
                                            <span class="mosaic-control-icon">
                                              <img src="{{ asset('public/')}}/ui-images/icons/pg-hide.svg" class="ui-icon" /></span>
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
                                          </div>  <!-- END .global-twitter-profile-header -->

                                          <div class="mosaic-post-data">
                                            <div class="mosaic-post-text">
                                              Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                                            </div>  <!-- END .mosaic-post-text -->
                                    <!--    <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                              class="mosaic-post-image" /> -->
                                          </div>  <!-- END .mosaic-post-data -->

                                          <div class="mosaic-post-scheduling">

                                            <div class="mosaic-scheduling mosaic-post-analytics engage-scheduling">

                                              <span class="mosaic-label mosaic-analytics-label">
                                                <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon" />
                                                Engage
                                              </span>
                                              <span class="mosaic-sched-buttons">
                                                <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                                <span class="mosaic-stat stat-retweets">2.20</span>
                                                <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                                <span class="mosaic-stat stat-hearts">2010</span>
                                              </span>

                                            </div>  <!-- END .mosaic-post-analytics -->

                                            <div class="glogal-engage-comment-area">
                                              <form>
                                                <textarea placeholder="Add a comment..."></textarea>
                                              </form>
                                              <span class="engage-comment-button">
                                                Send Comment<span>
                                            </div>

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



