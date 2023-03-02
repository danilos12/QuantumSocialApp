@extends('layouts.app')

@section('content')
<div class="page-outer profile-outer">
                <div class="page-inner profile-inner">

                  <div class="page-head-n-sort">
                    <span class="profile-heading">
                      Reschedule Your Own Posts</span>
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="filter-controls">
                    <div class="drop-button-wrap filter-wrap">
                      <span class="white-select-button profile-filter-select">
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-filter.svg" class="ui-icon" />
                        Filter by:
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-filter-dropdown frosted">
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          All Tweets</li>
                        <li><img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                          Retweets Only</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-quote.svg" class="ui-icon" />
                          Quoted Tweets Only</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
                          Comments Only</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-no-replies.svg" class="ui-icon" />
                          Exclude Retweets & Comments</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon" />
                          Tweets w/Media Only</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-links.svg" class="ui-icon" />
                          Tweets w/Links Only</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-no-links.svg" class="ui-icon" />
                          Tweets w/o Links</li>
                      </ul>
                    </div>  <!-- END .filter-wrap -->
                    <div class="drop-button-wrap sort-wrap">
                      <span class="white-select-button profile-sort-select">
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-sort.svg" class="ui-icon" />
                        Sort by:
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-sort-dropdown frosted">
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
                          Chronology</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon" />
                          Retweets</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Favorites</li>
                      </ul>
                    </div>  <!-- END .sort-wrap -->
                  </div>  <!-- END .filter-controls -->


                  <div class="profile-posts-outer">
                    <div class="profile-posts-inner">
                      
                      @if (isset($tweets))
                        @foreach($tweets as $tweet)      
                        <!-- BEGIN Single Post Instance -->
                        <div class="mosaic-posts-outer">
                          <div class="mosaic-watermark-wrap frosted">
                            <img src="{{ asset('public') }}/ui-images/icons/pg-twitter.svg" class="mosaic-watermark" />
                            <div class="mosaic-posts-inner">

                              <div class="mosaic-post-controls">
                                <span class="mosaic-control-icon">
                                  <img src="{{ asset('public') }}/ui-images/icons/pg-twitter.svg" class="ui-icon" /></span>
                                <span class="mosaic-control-icon">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-trash.svg" class="ui-icon" /></span>
                              </div>  <!-- END .mosaic-post-controls -->

                              <div class="global-twitter-profile-header">
                                <a href="#">
                                  <img src="{{ isset($twitter->twitter_photo) ? $twitter->twitter_photo : asset('public/temp-images/william-wallace.jpg') }}"
                                    class="global-profile-image" /></a>
                                <div class="global-profile-details">
                                  <div class="global-profile-name">
                                    <a href="#">{{ isset($twitter->twitter_name) ? $twitter->twitter_name : "Test"  }}</a>
                                  </div>  <!-- END .global-author-name -->
                                  <div class="global-profile-subdata">
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon" />
                                    <span class="global-post-date">
                                      
                                      <a href="">{{ date('M d, Y h:i A', strtotime($tweet->created_at)) }}</a></span>
                                  </div>  <!-- END .global-post-date-wrap -->
                                </div>  <!-- END .global-author-details -->
                              </div>  <!-- END .global-twitter-profile-header -->

                              <div class="mosaic-post-data">
                                <div class="mosaic-post-text">
                                  {{ $tweet->text }}
                                </div>  <!-- END .mosaic-post-text -->

                                @if(isset($tweet->image))
                                    <img src="{{ $tweet->image}}" alt="tweet image" data-twitter-image="imgId" height="500" width="auto">
                                @endif
                              </div>  <!-- END .mosaic-post-data -->

                              <div class="mosaic-post-scheduling">

                                <div class="mosaic-scheduling mosaic-scheduling-now">

                                  <span class="mosaic-label mosaic-now-label">
                                    <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon" />
                                    Now
                                  </span>
                                  <span class="mosaic-sched-buttons mosaic-now-buttons">
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-comment.svg" class="ui-icon comment-now-icon" />
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                  </span>

                                </div>  <!-- END .mosaic-scheduling-now -->


                                <div class="mosaic-scheduling mosaic-scheduling-future">

                                  <span class="mosaic-label mosaic-future-label">
                                    <img src="{{ asset('public/')}}/ui-images/icons/04-queue.svg" class="ui-icon" />
                                    Schedule
                                  </span>
                                  <span class="mosaic-sched-buttons mosaic-future-buttons">
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-comment.svg" class="ui-icon" />
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                    <img src="{{ asset('public') }}/ui-images/icons/16-evergreen.svg" class="ui-icon" />
                                  </span>

                                </div>  <!-- END .mosaic-scheduling-future -->


                                <div class="mosaic-scheduling mosaic-post-analytics">

                                  <span class="mosaic-label mosaic-analytics-label">
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-analytics.svg" class="ui-icon" />
                                    Analytics
                                  </span>
                                  <span class="mosaic-sched-buttons mosaic-analytics-buttons">
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                    <span class="mosaic-stat stat-retweets">2.20</span>
                                    <img src="{{ asset('public') }}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                    <span class="mosaic-stat stat-hearts">2010</span>
                                  </span>

                                </div>  <!-- END .mosaic-post-analytics -->

                              </div>  <!-- END .mosaic-post-scheduling -->

                            </div>  <!-- END .mosaic-posts-inner -->
                          </div>  <!-- END .mosaic-watermark-wrap -->


                          <div class="comment-now-modal">
                            <div class="comment-now-modal-inner frosted">

                              <form>
                                <textarea></textarea>
                                <input type="submit" class="comment-now-submit" value="Comment Now" />
                              </form>

                            </div>  <!-- END .comment-now-modal-inner -->
                          </div>  <!-- END .comment-now-modal -->

                        </div>  <!-- END .mosaic-posts-outer -->
                        <!-- END Single Post Instance -->

                        @endforeach
                      
                      @else   
                        <p> No tweets found </p>
                      @endif
                      

                    </div>  <!-- END .profile-posts-inner -->
                  </div>  <!-- END .profile-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->
@endsection
