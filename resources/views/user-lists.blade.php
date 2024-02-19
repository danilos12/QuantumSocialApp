@extends('layouts.app')

@section('content')

<div class="page-outer user-lists-outer">
                <div class="page-inner user-lists-inner">

                  <div class="page-head-n-sort">
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
                    <img src="{{ asset('public/')}}/ui-images/icons/pg-controls.svg" class="ui-icon filter-controls-toggle" />
                  </div>  <!-- END .page-head-n-sort -->

                  <div class="filter-controls">
                    <div class="drop-button-wrap filter-wrap user-list-wrap">
                      <span class="white-select-button profile-filter-select">
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                        User's Lists:
                        <img src="{{ asset('public/')}}/ui-images/icons/pg-arrow.svg" class="ui-icon drop-arrow" />
                      </span>
                      <ul class="page-filters-dropdown profile-filter-dropdown frosted">
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #1</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #2</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #3</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #4</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #5</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #6</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #7</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #8</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #9</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #10</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #11</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #12</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #13</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #14</li>
                        <li><img src="{{ asset('public/')}}/ui-images/icons/pg-list.svg" class="ui-icon" />
                          Account List #15</li>
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
                    <div class="global-handle-search">
                      <input type="text" placeholder="i.e. @elonmusk" />
                    </div>
                  </div>  <!-- END .filter-controls -->


                  <div class="queued-posts-outer">
                    <div class="profile-posts-inner">

                      <!-- BEGIN Single Post Instance -->
                      <div class="mosaic-posts-outer">
                        <div class="mosaic-watermark-wrap frosted">
                          <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="mosaic-watermark" />
                          <div class="mosaic-posts-inner">

                            <div class="mosaic-post-controls">
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
                            </div>  <!-- END .global-twitter-profile-header -->

                            <div class="mosaic-post-data">
                              <div class="mosaic-post-text">
                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con
                              </div>  <!-- END .mosaic-post-text -->
                              <img src="https://pbs.twimg.com/media/FkCLbE9XwAQ0Vm1.jpg"
                                class="mosaic-post-image" />
                            </div>  <!-- END .mosaic-post-data -->

                            <div class="mosaic-post-scheduling">

                              <div class="mosaic-scheduling mosaic-scheduling-now">

                                <span class="mosaic-label mosaic-now-label">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-command.svg" class="ui-icon" />
                                  Now
                                </span>
                                <span class="mosaic-sched-buttons mosaic-now-buttons">
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" />
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-comment.svg" class="ui-icon comment-now-icon" />
                                  <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon" />
                                </span>

                              </div>  <!-- END .mosaic-scheduling-now -->

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

                                    <div class=mosaic-posts-outer><div class="frosted mosaic-watermark-wrap"><img class=mosaic-watermark src=ui-images/icons/pg-twitter.svg><div class=mosaic-posts-inner><div class=mosaic-post-controls><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-twitter.svg></span><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-trash.svg></span></div><div class=global-twitter-profile-header><a href=#><img class=global-profile-image src=temp-images/imgpsh_fullsize_anim (1).png></a><div class=global-profile-details><div class=global-profile-name><a href=#>William Wallace</a></div><div class=global-profile-subdata><img class=ui-icon src=ui-images/icons/pg-time.svg> <span class=global-post-date><a href="">Dec. 16, 2022 @ 5:20 p.m.</a></span></div></div></div><div class=mosaic-post-data><div class=mosaic-post-text>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con</div></div><div class=mosaic-post-scheduling><div class="mosaic-scheduling mosaic-scheduling-now"><span class="mosaic-label mosaic-now-label"><img class=ui-icon src=ui-images/icons/pg-command.svg> Now </span><span class="mosaic-sched-buttons mosaic-now-buttons"><img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" /><img class="ui-icon comment-now-icon" src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg></span></div><div class="mosaic-scheduling mosaic-scheduling-future"><span class="mosaic-label mosaic-future-label"><img class=ui-icon src=ui-images/icons/04-queue.svg> Schedule </span><span class="mosaic-sched-buttons mosaic-future-buttons"><img class=ui-icon src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg> <img class=ui-icon src=ui-images/icons/16-evergreen.svg></span></div><div class="mosaic-scheduling mosaic-post-analytics"><span class="mosaic-label mosaic-analytics-label"><img class=ui-icon src=ui-images/icons/pg-analytics.svg> Analytics </span><span class="mosaic-sched-buttons mosaic-analytics-buttons"><img class=ui-icon src=ui-images/icons/pg-retweet.svg> <span class="mosaic-stat stat-retweets">2.20</span> <img class=ui-icon src=ui-images/icons/pg-heart.svg> <span class="mosaic-stat stat-hearts">2010</span></span></div></div></div></div><div class="comment-now-modal"><div class="comment-now-modal-inner frosted"><form><textarea></textarea><input type="submit" class="comment-now-submit" value="Comment Now" /></form></div>  <!-- END .comment-now-modal-inner --></div><!-- END .comment-now-modal --></div>

                                    <div class=mosaic-posts-outer><div class="frosted mosaic-watermark-wrap"><img class=mosaic-watermark src=ui-images/icons/pg-twitter.svg><div class=mosaic-posts-inner><div class=mosaic-post-controls><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-twitter.svg></span><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-trash.svg></span></div><div class=global-twitter-profile-header><a href=#><img class=global-profile-image src=temp-images/imgpsh_fullsize_anim (1).png></a><div class=global-profile-details><div class=global-profile-name><a href=#>William Wallace</a></div><div class=global-profile-subdata><img class=ui-icon src=ui-images/icons/pg-time.svg> <span class=global-post-date><a href="">Dec. 16, 2022 @ 5:20 p.m.</a></span></div></div></div><div class=mosaic-post-data><div class=mosaic-post-text>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con</div><img class=mosaic-post-image src=https://pulpbits.net/wp-content/uploads/2014/01/Eclectus-parrot-male-1024x1365.jpg></div><div class=mosaic-post-scheduling><div class="mosaic-scheduling mosaic-scheduling-now"><span class="mosaic-label mosaic-now-label"><img class=ui-icon src=ui-images/icons/pg-command.svg> Now </span><span class="mosaic-sched-buttons mosaic-now-buttons"><img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" /><img class="ui-icon comment-now-icon" src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg></span></div><div class="mosaic-scheduling mosaic-scheduling-future"><span class="mosaic-label mosaic-future-label"><img class=ui-icon src=ui-images/icons/04-queue.svg> Schedule </span><span class="mosaic-sched-buttons mosaic-future-buttons"><img class=ui-icon src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg> <img class=ui-icon src=ui-images/icons/16-evergreen.svg></span></div><div class="mosaic-scheduling mosaic-post-analytics"><span class="mosaic-label mosaic-analytics-label"><img class=ui-icon src=ui-images/icons/pg-analytics.svg> Analytics </span><span class="mosaic-sched-buttons mosaic-analytics-buttons"><img class=ui-icon src=ui-images/icons/pg-retweet.svg> <span class="mosaic-stat stat-retweets">2.20</span> <img class=ui-icon src=ui-images/icons/pg-heart.svg> <span class="mosaic-stat stat-hearts">2010</span></span></div></div></div></div><div class="comment-now-modal"><div class="comment-now-modal-inner frosted"><form><textarea></textarea><input type="submit" class="comment-now-submit" value="Comment Now" /></form></div>  <!-- END .comment-now-modal-inner --></div><!-- END .comment-now-modal --></div>

                                    <div class=mosaic-posts-outer><div class="frosted mosaic-watermark-wrap"><img class=mosaic-watermark src=ui-images/icons/pg-twitter.svg><div class=mosaic-posts-inner><div class=mosaic-post-controls><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-twitter.svg></span><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-trash.svg></span></div><div class=global-twitter-profile-header><a href=#><img class=global-profile-image src=temp-images/imgpsh_fullsize_anim (1).png></a><div class=global-profile-details><div class=global-profile-name><a href=#>William Wallace</a></div><div class=global-profile-subdata><img class=ui-icon src=ui-images/icons/pg-time.svg> <span class=global-post-date><a href="">Dec. 16, 2022 @ 5:20 p.m.</a></span></div></div></div><div class=mosaic-post-data><div class=mosaic-post-text>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con</div></div><div class=mosaic-post-scheduling><div class="mosaic-scheduling mosaic-scheduling-now"><span class="mosaic-label mosaic-now-label"><img class=ui-icon src=ui-images/icons/pg-command.svg> Now </span><span class="mosaic-sched-buttons mosaic-now-buttons"><img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" /><img class="ui-icon comment-now-icon" src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg></span></div><div class="mosaic-scheduling mosaic-scheduling-future"><span class="mosaic-label mosaic-future-label"><img class=ui-icon src=ui-images/icons/04-queue.svg> Schedule </span><span class="mosaic-sched-buttons mosaic-future-buttons"><img class=ui-icon src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg> <img class=ui-icon src=ui-images/icons/16-evergreen.svg></span></div><div class="mosaic-scheduling mosaic-post-analytics"><span class="mosaic-label mosaic-analytics-label"><img class=ui-icon src=ui-images/icons/pg-analytics.svg> Analytics </span><span class="mosaic-sched-buttons mosaic-analytics-buttons"><img class=ui-icon src=ui-images/icons/pg-retweet.svg> <span class="mosaic-stat stat-retweets">2.20</span> <img class=ui-icon src=ui-images/icons/pg-heart.svg> <span class="mosaic-stat stat-hearts">2010</span></span></div></div></div></div><div class="comment-now-modal"><div class="comment-now-modal-inner frosted"><form><textarea></textarea><input type="submit" class="comment-now-submit" value="Comment Now" /></form></div>  <!-- END .comment-now-modal-inner --></div><!-- END .comment-now-modal --></div>

                                    <div class=mosaic-posts-outer><div class="frosted mosaic-watermark-wrap"><img class=mosaic-watermark src=ui-images/icons/pg-twitter.svg><div class=mosaic-posts-inner><div class=mosaic-post-controls><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-twitter.svg></span><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-trash.svg></span></div><div class=global-twitter-profile-header><a href=#><img class=global-profile-image src=temp-images/imgpsh_fullsize_anim (1).png></a><div class=global-profile-details><div class=global-profile-name><a href=#>William Wallace</a></div><div class=global-profile-subdata><img class=ui-icon src=ui-images/icons/pg-time.svg> <span class=global-post-date><a href="">Dec. 16, 2022 @ 5:20 p.m.</a></span></div></div></div><div class=mosaic-post-data><div class=mosaic-post-text>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con</div></div><div class=mosaic-post-scheduling><div class="mosaic-scheduling mosaic-scheduling-now"><span class="mosaic-label mosaic-now-label"><img class=ui-icon src=ui-images/icons/pg-command.svg> Now </span><span class="mosaic-sched-buttons mosaic-now-buttons"><img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" /><img class="ui-icon comment-now-icon" src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg></span></div><div class="mosaic-scheduling mosaic-scheduling-future"><span class="mosaic-label mosaic-future-label"><img class=ui-icon src=ui-images/icons/04-queue.svg> Schedule </span><span class="mosaic-sched-buttons mosaic-future-buttons"><img class=ui-icon src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg> <img class=ui-icon src=ui-images/icons/16-evergreen.svg></span></div><div class="mosaic-scheduling mosaic-post-analytics"><span class="mosaic-label mosaic-analytics-label"><img class=ui-icon src=ui-images/icons/pg-analytics.svg> Analytics </span><span class="mosaic-sched-buttons mosaic-analytics-buttons"><img class=ui-icon src=ui-images/icons/pg-retweet.svg> <span class="mosaic-stat stat-retweets">2.20</span> <img class=ui-icon src=ui-images/icons/pg-heart.svg> <span class="mosaic-stat stat-hearts">2010</span></span></div></div></div></div><div class="comment-now-modal"><div class="comment-now-modal-inner frosted"><form><textarea></textarea><input type="submit" class="comment-now-submit" value="Comment Now" /></form></div>  <!-- END .comment-now-modal-inner --></div><!-- END .comment-now-modal --></div>

                                    <div class=mosaic-posts-outer><div class="frosted mosaic-watermark-wrap"><img class=mosaic-watermark src=ui-images/icons/pg-twitter.svg><div class=mosaic-posts-inner><div class=mosaic-post-controls><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-twitter.svg></span><span class=mosaic-control-icon><img class=ui-icon src=ui-images/icons/pg-trash.svg></span></div><div class=global-twitter-profile-header><a href=#><img class=global-profile-image src=temp-images/imgpsh_fullsize_anim (1).png></a><div class=global-profile-details><div class=global-profile-name><a href=#>William Wallace</a></div><div class=global-profile-subdata><img class=ui-icon src=ui-images/icons/pg-time.svg> <span class=global-post-date><a href="">Dec. 16, 2022 @ 5:20 p.m.</a></span></div></div></div><div class=mosaic-post-data><div class=mosaic-post-text>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu. #pretium quis #sem #Nulla con</div></div><div class=mosaic-post-scheduling><div class="mosaic-scheduling mosaic-scheduling-now"><span class="mosaic-label mosaic-now-label"><img class=ui-icon src=ui-images/icons/pg-command.svg> Now </span><span class="mosaic-sched-buttons mosaic-now-buttons"><img src="{{ asset('public/')}}/ui-images/icons/pg-heart.svg" class="ui-icon" /><img class="ui-icon comment-now-icon" src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg></span></div><div class="mosaic-scheduling mosaic-scheduling-future"><span class="mosaic-label mosaic-future-label"><img class=ui-icon src=ui-images/icons/04-queue.svg> Schedule </span><span class="mosaic-sched-buttons mosaic-future-buttons"><img class=ui-icon src=ui-images/icons/pg-comment.svg> <img class=ui-icon src=ui-images/icons/pg-retweet.svg> <img class=ui-icon src=ui-images/icons/16-evergreen.svg></span></div><div class="mosaic-scheduling mosaic-post-analytics"><span class="mosaic-label mosaic-analytics-label"><img class=ui-icon src=ui-images/icons/pg-analytics.svg> Analytics </span><span class="mosaic-sched-buttons mosaic-analytics-buttons"><img class=ui-icon src=ui-images/icons/pg-retweet.svg> <span class="mosaic-stat stat-retweets">2.20</span> <img class=ui-icon src=ui-images/icons/pg-heart.svg> <span class="mosaic-stat stat-hearts">2010</span></span></div></div></div></div><div class="comment-now-modal"><div class="comment-now-modal-inner frosted"><form><textarea></textarea><input type="submit" class="comment-now-submit" value="Comment Now" /></form></div>  <!-- END .comment-now-modal-inner --></div><!-- END .comment-now-modal --></div>


                    </div>  <!-- END .profile-posts-inner -->
                  </div>  <!-- END .queued-posts-outer -->

                </div>  <!-- END .profile-inner -->
              </div>  <!-- END .profile-outer -->


@endsection



