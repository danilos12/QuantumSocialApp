@extends('layouts.app')

@section('content')
<div class="page-outer queue-outer">
                <div class="page-inner queue-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Drafted</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->


                  <div class="drafted-posts-outer">
                    <div class="drafted-posts-inner">

<!--
Queue Types:

- empty
- custom
- comment
- retweet
- evergreen
- promo
- storm

-->


                      <div class="queue-day-wrapper">
                        <span class="queue-date-heading">Today</span>

                        <!-- BEGIN Custom Queued Post Instance (CUSTOM) -->
                        <div class="queued-single-post-wrapper queue-type-custom" status="active" queue-type="custom">
                          <div class="queued-single-post">

                            <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="queued-watermark" />

                            <div class="queued-single-start">
                              <span class="queued-post-time">
                                10:30am</span>
                              <span class="queued-post-data">
                                Sample of truncated post text #test https://...
                              </span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-dots.svg"
                                class="ui-icon queued-icon queued-options-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-view.svg"
                                class="ui-icon queued-icon queued-view-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg"
                                class="ui-icon queued-icon queued-edit-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg"
                                class="ui-icon queued-icon queued-trash-icon" />
                            </div>  <!-- END .queued-single-end -->

                          </div>  <!-- END .queued-single-post -->

                          <div class="queued-preview-wrapper">
                            <!-- BEGIN Queued Preview Instance -->
                            <div class="mosaic-posts-outer">
                              <div class="mosaic-watermark-wrap frosted">
                                <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="mosaic-watermark" />
                                <div class="mosaic-posts-inner">

                                  <div class="global-twitter-profile-header">
                                    <a href="#">
                                      <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg"
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
                                    <img src="{{ asset('public/')}}/https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                      class="mosaic-post-image" />
                                  </div>  <!-- END .mosaic-post-data -->

                                </div>  <!-- END .mosaic-posts-inner -->
                              </div>  <!-- END .mosaic-watermark-wrap -->
                            </div>  <!-- END .mosaic-posts-outer -->
                            <!-- END Queued Preview Instance -->

                          </div>  <!-- END .queued-preview-wrapper -->

                          <div class="queued-options-wrapper frosted">
                            <div class="queued-options-inner">
                              <span class="queued-option-item">
                                Schedule Post</span>
                              <span class="queued-option-item">
                                Duplicate Post</span>
                              <span class="queued-option-item">
                                Post Now</span>
                            </div>  <!-- END .queued-options-inner -->
                          </div>  <!-- END .queued-options-wrapper -->

                        </div>  <!-- END .queued-single-post-wrapper -->
                        <!-- END Custom Queued Post Instance -->



                        <!-- BEGIN Comment Queued Post Instance -->
                        <div class="queued-single-post-wrapper queue-type-comment" status="active" queue-type="comment">
                          <div class="queued-single-post">

                            <img src="{{ asset('public/')}}/ui-images/icons/12-mentions.svg" class="queued-watermark" />

                            <div class="queued-single-start">
                              <span class="queued-post-time">
                                10:03am</span>
                              <span class="queued-post-data">
                                Sample of truncated post text #test https://...
                              </span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-dots.svg"
                                class="ui-icon queued-icon queued-options-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-view.svg"
                                class="ui-icon queued-icon queued-view-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg"
                                class="ui-icon queued-icon queued-edit-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg"
                                class="ui-icon queued-icon queued-twitter-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg"
                                class="ui-icon queued-icon queued-trash-icon" />
                            </div>  <!-- END .queued-single-end -->

                          </div>  <!-- END .queued-single-post -->
                        </div>  <!-- END .queued-single-post-wrapper -->
                        <!-- END Comment Queued Post Instance -->



                        <!-- BEGIN Retweet Queued Post Instance -->
                        <div class="queued-single-post-wrapper queue-type-retweet" status="active" queue-type="retweet">
                          <div class="queued-single-post">

                            <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="queued-watermark" />

                            <div class="queued-single-start">
                              <span class="queued-post-time">
                                10:03am</span>
                              <span class="queued-post-data">
                                Retweet
                              </span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-dots.svg"
                                class="ui-icon queued-icon queued-options-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-view.svg"
                                class="ui-icon queued-icon queued-view-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg"
                                class="ui-icon queued-icon queued-edit-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg"
                                class="ui-icon queued-icon queued-twitter-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg"
                                class="ui-icon queued-icon queued-trash-icon" />
                            </div>  <!-- END .queued-single-end -->

                          </div>  <!-- END .queued-single-post -->
                        </div>  <!-- END .queued-single-post-wrapper -->
                        <!-- END Retweet Queued Post Instance -->



                        <!-- BEGIN TweetStorm Queued Post Instance -->
                        <div class="queued-single-post-wrapper queue-type-storm" status="active" queue-type="storm">
                          <div class="queued-single-post">

                            <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="queued-watermark" />

                            <div class="queued-single-start">
                              <span class="queued-post-time">
                                10:03am</span>
                              <span class="queued-post-data">
                                Sample of truncated post text #test https://...
                              </span>
                            </div>  <!-- END .queue-single-start -->

                            <div class="queued-single-end">
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-dots.svg"
                                class="ui-icon queued-icon queued-options-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-view.svg"
                                class="ui-icon queued-icon queued-view-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/05-drafts.svg"
                                class="ui-icon queued-icon queued-edit-icon" />
                              <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg"
                                class="ui-icon queued-icon queued-trash-icon" />
                            </div>  <!-- END .queued-single-end -->

                          </div>  <!-- END .queued-single-post -->
                        </div>  <!-- END .queued-single-post-wrapper -->
                        <!-- END Custom Queued Post Instance -->

                      </div>  <!-- END .queue-day-wrapper" -->
                      <!-- END TweetStorm Queued Post Instance -->

                    </div>  <!-- END .queue-posts-inner -->
                  </div>  <!-- END .queue-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->

@endsection
