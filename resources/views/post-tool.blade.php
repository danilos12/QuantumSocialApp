 <!-- BEGIN POSTING TOOL -->

                  <div class="modal-large-anchor posting-tool-anchor">
                    <div class="modal-large-backdrop posting-tool-background">

                      <div class="modal-large-outer posting-tool-outer">
                        <div class="modal-large-inner posting-tool-inner">

                         <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close" />

                          <div class="posting-tool-banner">
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
                                  <span class="global-profile-handle">
                                    <a href="">
                                      @WilliamWallace</a></span>
                                </div>  <!-- END .global-post-date-wrap -->
                              </div>  <!-- END .global-author-details -->
                            </div>  <!-- END .global-twitter-profile-header -->
                          </div>  <!-- END .posting-tool-banner -->

                          <form class="posting-tool-form">
                            <div class="posting-tool-columns">
                              <div class="posting-tool-col posting-tool-left-col">

                                <div class="new-post-wrap primary-post-wrap">

                                  <div class="post-area-left primary-post-left">
                                    <div class="post-area-wrap primary-post-area-wrap">
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active" />
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" />
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" />
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator" />
                                     <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" />
                                     <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" />
                                      <textarea class="post-textarea primary-post-area"></textarea>  <!-- END .primary-post-area -->
                                    </div>  <!-- END .primary-post-area-wrap -->
                                    <div class="post-bottom-buttons primary-post-bottom-buttons">
                                      <span class="post-type-buttons primary-post-type-buttons">
                                       <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon post-tool-icon evergreen-type-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-tool-icon promo-type-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-tool-icon tweet-storm-type-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon" />
                                      </span>  <!-- END .primary-post-type-buttons -->
                                      <span class="post-option-buttons primary-post-option-buttons">
                                       <img src="{{ asset('public/')}}/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon" />
                                       <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" class="ui-icon post-tool-icon retweet-timer-icon" />
                                        <span class="post-counter">1/2</span>
                                      </span>  <!-- END .primary-post-option-buttons -->


                                      <div class="post-tool-modal tag-group-modal-outer frosted">
                                        <div class="tag-group-modal-inner">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-modal-close tag-group-modal-close" />
                                          <select>
                                            <option disabled selected class="modal-select-tag-group">Select a Tag Group:</option>
                                              <option class="modal-select-tag-group">Group #1</option>
                                              <option class="modal-select-tag-group">Group #2</option>
                                              <option class="modal-select-tag-group">Group #3</option>
                                          </select>
                                          <div class="modal-tag-group-display">
                                            <span class="modal-tag-instance" status="active">
                                              #marketing
                                            </span>
                                            <span class="modal-tag-instance">
                                              #business
                                            </span>
                                            <span class="modal-tag-instance" status="active">
                                              #onlineBusiness
                                            </span>
                                            <span class="modal-tag-instance" status="active">
                                              #entrepreneurs
                                            </span>
                                            <span class="modal-tag-instance">
                                              #entrepreneurGrind
                                            </span>
                                            <span class="modal-tag-instance">
                                              #businessIntegrity
                                            </span>
                                            <span class="modal-tag-instance" status="active">
                                              #businessValues
                                            </span>
                                          </div>  <!-- END .modal-tag-group-display -->
                                          <div class="tags-submit">
                                            Add Tags
                                          </div>  <!-- END .tags-submit -->
                                        </div>  <!-- END .tag-group-modal-inner -->
                                      </div>  <!-- END .tag-group-modal-outer -->


                                      <div class="post-tool-modal schedule-retweet-modal-outer frosted">
                                        <div class="schedule-retweet-modal-inner">
                                         <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-modal-close retweet-modal-close" />
                                          Select A Post Time:
                                          <div class="schedule-time-selectors">
                                            <select class="post-time-hour">
                                              <option disabled selected>Hour</option>
                                              <option>0</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                              <option>6</option>
                                              <option>7</option>
                                              <option>8</option>
                                              <option>9</option>
                                              <option>10</option>
                                              <option>11</option>
                                              <option>12</option>
                                            </select>
                                            <select class="post-time-minute">
                                              <option disabled selected>Minute</option>
                                              <option>0</option>
                                              <option>1</option>
                                              <option>2</option>
                                              <option>3</option>
                                              <option>4</option>
                                              <option>5</option>
                                              <option>6</option>
                                              <option>7</option>
                                              <option>8</option>
                                              <option>9</option>
                                              <option>10</option>
                                              <option>11</option>
                                              <option>12</option>
                                              <option>13</option>
                                              <option>14</option>
                                              <option>15</option>
                                              <option>16</option>
                                              <option>17</option>
                                              <option>18</option>
                                              <option>19</option>
                                              <option>20</option>
                                              <option>21</option>
                                              <option>22</option>
                                              <option>23</option>
                                              <option>24</option>
                                              <option>25</option>
                                              <option>26</option>
                                              <option>27</option>
                                              <option>28</option>
                                              <option>29</option>
                                              <option>30</option>
                                              <option>31</option>
                                              <option>32</option>
                                              <option>33</option>
                                              <option>34</option>
                                              <option>35</option>
                                              <option>36</option>
                                              <option>37</option>
                                              <option>38</option>
                                              <option>39</option>
                                              <option>40</option>
                                              <option>41</option>
                                              <option>42</option>
                                              <option>43</option>
                                              <option>44</option>
                                              <option>45</option>
                                              <option>46</option>
                                              <option>47</option>
                                              <option>48</option>
                                              <option>49</option>
                                              <option>50</option>
                                              <option>51</option>
                                              <option>52</option>
                                              <option>53</option>
                                              <option>54</option>
                                              <option>55</option>
                                              <option>56</option>
                                              <option>57</option>
                                              <option>58</option>
                                              <option>59</option>
                                            </select>
                                            <select class="post-time-am-pm">
                                              <option disabled selected>AM / PM</option>
                                              <option>AM</option>
                                              <option>PM</option>
                                            </select>
                                          </div>  <!-- END .schedule-time-selectors -->
                                          <div class="date-picker-wrapper">
                                          		<input type="text" id="datepicker" autocomplete="off">
                                          </div>  <!-- END .date-picker-wrapper -->
                                        </div>  <!-- END .schedule-retweet-modal-inner -->
                                      </div>  <!-- END .schedule-retweet-modal-outer -->
                                    </div>  <!-- END .primary-post-bottom-buttons -->
                                  </div>  <!-- END .primary-post-left -->


                                  <div class="post-area-right primary-post-right">
                                    <div class="post-right-buttons primary-post-right-buttons">
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br />
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />
                                     <img src="{{ asset('public/')}}/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />
                                    </div>  <!-- END .primary-post-right-buttons -->
                                  </div>  <!-- END .primary-post-right -->

                                </div>  <!-- END .primary-post-wrap -->

                               <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-initial" />

                                <div class="more-tweets-roster">

                                  <!-- CARLO - All subsequent tweet additions go here. -->

                                  <!-- BEGIN NEW TWEET INSTANCE -->
                                  <div class="add-tweet-outer">
                                    <div class="add-tweet-inner">
                                      <div class="wait-to-tweet-col">
                                        <span class="wait-title">Wait</span>
                                        <select class="wait-number">
                                          <option>0</option>
                                          <option>1</option>
                                          <option>2</option>
                                          <option>3</option>
                                          <option>4</option>
                                          <option>5</option>
                                          <option>6</option>
                                          <option>7</option>
                                          <option>8</option>
                                          <option>9</option>
                                          <option>10</option>
                                          <option>11</option>
                                          <option>12</option>
                                          <option>13</option>
                                          <option>14</option>
                                          <option>15</option>
                                          <option>16</option>
                                          <option>17</option>
                                          <option>18</option>
                                          <option>19</option>
                                          <option>20</option>
                                          <option>21</option>
                                          <option>22</option>
                                          <option>23</option>
                                          <option>24</option>
                                          <option>25</option>
                                          <option>26</option>
                                          <option>27</option>
                                          <option>28</option>
                                          <option>29</option>
                                          <option>30</option>
                                          <option>31</option>
                                          <option>32</option>
                                          <option>33</option>
                                          <option>34</option>
                                          <option>35</option>
                                          <option>36</option>
                                          <option>37</option>
                                          <option>38</option>
                                          <option>39</option>
                                          <option>40</option>
                                          <option>41</option>
                                          <option>42</option>
                                          <option>43</option>
                                          <option>44</option>
                                          <option>45</option>
                                          <option>46</option>
                                          <option>47</option>
                                          <option>48</option>
                                          <option>49</option>
                                          <option>50</option>
                                          <option>51</option>
                                          <option>52</option>
                                          <option>53</option>
                                          <option>54</option>
                                          <option>55</option>
                                          <option>56</option>
                                          <option>57</option>
                                          <option>58</option>
                                          <option>59</option>
                                          <option>60</option>
                                          <option>61</option>
                                          <option>62</option>
                                          <option>63</option>
                                          <option>64</option>
                                          <option>65</option>
                                          <option>66</option>
                                          <option>67</option>
                                          <option>68</option>
                                          <option>69</option>
                                          <option>70</option>
                                          <option>71</option>
                                          <option>72</option>
                                          <option>73</option>
                                          <option>74</option>
                                          <option>75</option>
                                          <option>76</option>
                                          <option>77</option>
                                          <option>78</option>
                                          <option>79</option>
                                          <option>80</option>
                                          <option>81</option>
                                          <option>82</option>
                                          <option>83</option>
                                          <option>84</option>
                                          <option>85</option>
                                          <option>86</option>
                                          <option>87</option>
                                          <option>88</option>
                                          <option>89</option>
                                          <option>90</option>
                                        </select>
                                        <select class="wait-duration">
                                          <option>Seconds</option>
                                          <option>Minutes</option>
                                          <option>Hours</option>
                                          <option>Days</option>
                                        </select>
                                      </div>  <!-- END .wait-to-tweet-col -->
                                      <div class="new-post-wrap add-tweet-col">
                                        <div class="post-area-left new-post-left">
                                          <div class="post-area-wrap new-post-area-wrap">
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-twitter.svg" class="ui-icon post-type-indicator indicator-active" />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-type-indicator" />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-type-indicator" />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-evergreen.svg" class="ui-icon post-type-indicator" />
                                           <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-type-indicator" />
                                           <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-type-indicator" />
                                            <textarea class="post-textarea new-post-area"></textarea>  <!-- END .primary-post-area -->
                                          </div>  <!-- END .post-area-wrap -->
                                          <div class="post-bottom-buttons new-post-bottom-buttons">
                                            <span class="post-type-buttons new-post-type-buttons">
                                             <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon post-tool-icon evergreen-type-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon post-tool-icon promo-type-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon post-tool-icon tweet-storm-type-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon post-tool-icon retweet-type-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon post-tool-icon comment-type-icon" />
                                            </span>  <!-- END .post-type-buttons -->
                                            <span class="post-option-buttons new-post-option-buttons">
                                             <img src="{{ asset('public/')}}/ui-images/icons/14-hashtag-feeds.svg" class="ui-icon post-tool-icon hashtags-option-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/pg-envelope.svg" class="ui-icon post-tool-icon dm-option-icon" />
                                             <img src="{{ asset('public/')}}/ui-images/icons/pg-time.svg" class="ui-icon post-tool-icon send-timer-icon" />
                                              <span class="post-counter">2/2</span>
                                            </span>  <!-- END .post-option-buttons -->
                                          </div>  <!-- END .post-bottom-buttons -->
                                        </div>  <!-- END .post-area-left -->

                                        <div class="post-area-right new-post-right">
                                          <div class="post-right-buttons new-post-right-buttons">
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon post-tool-icon remove-new-tweet" /><br />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-image.svg" class="ui-icon post-tool-icon add-image-icon" /><br />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-gif.svg" class="ui-icon post-tool-icon add-gif-icon" /><br />
                                           <img src="{{ asset('public/')}}/ui-images/icons/pg-smile.svg" class="ui-icon post-tool-icon add-emoji-icon" /><br />
                                          </div>  <!-- END .post-right-buttons -->
                                        </div>  <!-- END .post-area-right -->
                                      </div>  <!-- END .new-post-wrap -->
                                    </div>  <!-- END .add-tweet-inner -->
                                   <img src="{{ asset('public/')}}/ui-images/icons/add-post.svg" class="ui-icon add-tweet-icon add-tweet-again-button" />
                                  </div>  <!-- END .add-tweet-outer -->
                                  <!-- END NEW TWEET INSTANCE -->


                                </div>  <!-- END .more-tweets-roster -->
                              </div>  <!-- END .posting-tool-left-col -->


                              <div class="posting-tool-col posting-tool-right-col">

                                <div class="post-alert evergreen-alert">
                                 <img src="{{ asset('public/')}}/ui-images/icons/16-evergreen.svg" class="ui-icon alert-icon" />
                                  <span>
                                    Adding to Evergreen Tweets
                                  </span>
                                </div>  <!-- END .evergreen-alert -->

                                <div class="post-alert promo-alert">
                                 <img src="{{ asset('public/')}}/ui-images/icons/17-promos.svg" class="ui-icon alert-icon" />
                                  <span>
                                    Adding to Promo Tweets
                                  </span>
                                  <select class="promo-campaign-select">
                                    <option disabled selected>Select a Promo Campaign...</option>
                                    <option>Promo Campaign #1</option>
                                    <option>Promo Campaign #2</option>
                                    <option>Promo Campaign #3</option>
                                  </select>
                                </div>  <!-- END .promo-alert -->

                                <div class="post-alert tweet-storm-alert">
                                 <img src="{{ asset('public/')}}/ui-images/icons/08-tweet-storm.svg" class="ui-icon alert-icon" />
                                  <span>
                                    Adding to Tweet Storms
                                  </span>
                                </div>  <!-- END .promo-alert -->

                                <div class="post-alert retweet-alert">
                                 <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet.svg" class="ui-icon alert-icon" />
                                  <span>
                                    Tweet to Retweet:
                                  </span>
                                  <input type="text" placeholder="...paste tweet link here..." class="retweet-link-input" />
                                    <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
                                </div>  <!-- END .comment-alert -->

                                <div class="post-alert comment-alert">
                                 <img src="{{ asset('public/')}}/ui-images/icons/pg-comments.svg" class="ui-icon alert-icon" />
                                  <span>
                                    Tweet to Comment On:
                                  </span>
                                  <input type="text" placeholder="...paste tweet link here..." class="comment-link-input" />
                                    <!-- CARLO - Just have this grab the tweet in the URL when it is pasted. -->
                                </div>  <!-- END .comment-alert -->


                                <div class="post-alert retweet-timer-alert">
                                  <div class="retweet-timer-alert-heading">
                                   <img src="{{ asset('public/')}}/ui-images/icons/pg-retweet-timer.svg" class="ui-icon alert-icon" />
                                    <span>
                                      Retweet every:
                                    </span>
                                  </div>
                                  <div class="retweet-timer-settings">
                                    <select class="retweet-timer-select">
                                      <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                      <option>11</option>
                                      <option>12</option>
                                      <option>13</option>
                                      <option>14</option>
                                      <option>15</option>
                                      <option>16</option>
                                      <option>17</option>
                                      <option>18</option>
                                      <option>19</option>
                                      <option>20</option>
                                      <option>21</option>
                                      <option>22</option>
                                      <option>23</option>
                                      <option>24</option>
                                      <option>25</option>
                                      <option>26</option>
                                      <option>27</option>
                                      <option>28</option>
                                      <option>29</option>
                                      <option>30</option>
                                      <option>31</option>
                                      <option>32</option>
                                      <option>33</option>
                                      <option>34</option>
                                      <option>35</option>
                                      <option>36</option>
                                      <option>37</option>
                                      <option>38</option>
                                      <option>39</option>
                                      <option>40</option>
                                      <option>41</option>
                                      <option>42</option>
                                      <option>43</option>
                                      <option>44</option>
                                      <option>45</option>
                                      <option>46</option>
                                      <option>47</option>
                                      <option>48</option>
                                      <option>49</option>
                                      <option>50</option>
                                      <option>51</option>
                                      <option>52</option>
                                      <option>53</option>
                                      <option>54</option>
                                      <option>55</option>
                                      <option>56</option>
                                      <option>57</option>
                                      <option>58</option>
                                      <option>59</option>
                                      <option>60</option>
                                      <option>61</option>
                                      <option>62</option>
                                      <option>63</option>
                                      <option>64</option>
                                      <option>65</option>
                                      <option>66</option>
                                      <option>67</option>
                                      <option>68</option>
                                      <option>69</option>
                                      <option>70</option>
                                      <option>71</option>
                                      <option>72</option>
                                      <option>73</option>
                                      <option>74</option>
                                      <option>75</option>
                                      <option>76</option>
                                      <option>77</option>
                                      <option>78</option>
                                      <option>79</option>
                                      <option>80</option>
                                      <option>81</option>
                                      <option>82</option>
                                      <option>83</option>
                                      <option>84</option>
                                      <option>85</option>
                                      <option>86</option>
                                      <option>87</option>
                                      <option>88</option>
                                      <option>89</option>
                                      <option>90</option>
                                    </select>
                                    <select class="retweet-timer-select">
                                      <option>minutes</option>
                                      <option>hours</option>
                                      <option>days</option>
                                    </select>
                                    for
                                    <select class="retweet-timer-select">
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                    </select>
                                    iterations.
                                  </div>  <!-- END .retweet-timer-settings -->
                                </div>  <!-- END .promo-alert -->

                                <div class="cross-tweet-profiles-outer">
                                  <div class="cross-tweet-header">
                                    Cross-Tweet On:</div>
                                  <div class="cross-tweet-profiles-inner">
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" />
                                   <img src="{{ asset('public/')}}/temp-images/william-wallace.jpg" class="cross-tweet-profile-image" status="active" />
                                  </div>  <!-- END .cross-tweet-profiles-inner -->
                                </div>  <!-- END .cross-tweet-profiles-outer -->

                              </div>  <!-- END .posting-tool-right-col -->
                            </div>  <!-- END .posting-tool-columns -->


                            <div class="posting-tool-submit-wrap">
                              <div class="post-tool-submit-left">
                                <select class="scheduling-options">
                                  <option disabled selected>Select a scheduling method...</option>
                                  <option>Add to Queue (default)</option>
                                  <option>Send Now</option>
                                  <option>Set Countdown</option>
                                  <option>Custom Time</option>
                                  <option>Custom Slot</option>
                                  <option>Save As Draft</option>
                                  <option>Rush In Queue</option>
                                </select>
                                <div class="scheduling-details">



  <!-- INGRID - Please finish these, based on the UI of the rest of the page -->

  <!-- CARLO - These options only show up if certain options are selected in the scheduling method options -->

                                  <div class="scheduling-details-countdown">
                                    <!-- CARLO - if Countdown -->
                                    <select class="scheduling-countdown-number">
                                      <option>0</option>
                                      <option>1</option>
                                      <option>2</option>
                                      <option>3</option>
                                      <option>4</option>
                                      <option>5</option>
                                      <option>6</option>
                                      <option>7</option>
                                      <option>8</option>
                                      <option>9</option>
                                      <option>10</option>
                                      <option>11</option>
                                      <option>12</option>
                                      <option>13</option>
                                      <option>14</option>
                                      <option>15</option>
                                      <option>16</option>
                                      <option>17</option>
                                      <option>18</option>
                                      <option>19</option>
                                      <option>20</option>
                                      <option>21</option>
                                      <option>22</option>
                                      <option>23</option>
                                      <option>24</option>
                                      <option>25</option>
                                      <option>26</option>
                                      <option>27</option>
                                      <option>28</option>
                                      <option>29</option>
                                      <option>30</option>
                                      <option>31</option>
                                      <option>32</option>
                                      <option>33</option>
                                      <option>34</option>
                                      <option>35</option>
                                      <option>36</option>
                                      <option>37</option>
                                      <option>38</option>
                                      <option>39</option>
                                      <option>40</option>
                                      <option>41</option>
                                      <option>42</option>
                                      <option>43</option>
                                      <option>44</option>
                                      <option>45</option>
                                      <option>46</option>
                                      <option>47</option>
                                      <option>48</option>
                                      <option>49</option>
                                      <option>50</option>
                                      <option>51</option>
                                      <option>52</option>
                                      <option>53</option>
                                      <option>54</option>
                                      <option>55</option>
                                      <option>56</option>
                                      <option>57</option>
                                      <option>58</option>
                                      <option>59</option>
                                      <option>60</option>
                                      <option>61</option>
                                      <option>62</option>
                                      <option>63</option>
                                      <option>64</option>
                                      <option>65</option>
                                      <option>66</option>
                                      <option>67</option>
                                      <option>68</option>
                                      <option>69</option>
                                      <option>70</option>
                                      <option>71</option>
                                      <option>72</option>
                                      <option>73</option>
                                      <option>74</option>
                                      <option>75</option>
                                      <option>76</option>
                                      <option>77</option>
                                      <option>78</option>
                                      <option>79</option>
                                      <option>80</option>
                                      <option>81</option>
                                      <option>82</option>
                                      <option>83</option>
                                      <option>84</option>
                                      <option>85</option>
                                      <option>86</option>
                                      <option>87</option>
                                      <option>88</option>
                                      <option>89</option>
                                      <option>90</option>
                                    </select>
                                    <select class="scheduling-countdown-minutes">
                                      <option>Minutes</option>
                                      <option>Hours</option>
                                      <option>Days</option>
                                    </select>
                                  </div>  <!-- END .scheduling-details-countdown -->
                                  <div class="scheduling-details-date-picker">
                                    <!-- CARLO - if Custom Time -->
                                    Ingrid, use RetweetTimer options
                                  </div>  <!-- END .scheduling-details-date-picker -->
                                  <div class="scheduling-details-custom-slot">
                                    <!-- CARLO - if Custom Slot, show available time slots -->
                                    <select>
                                      <option>Custom Time Slot List</option>
                                    </select>
                                  </div>  <!-- END .scheduling-details-custom-slot -->
                                </div>  <!-- END .scheduling-details -->
                              </div>  <!-- END .post-tool-submit-left -->
                              <input type="submit" class="posting-tool-submit" value="Beam Me Up Scotty!" />
                            </div>  <!-- END .posting-tool-submit-wrap -->
                          </form>  <!-- END .posting-tool-form -->



                        </div>  <!-- END .posting-tool-inner -->
                      </div>  <!-- END .posting-tool-outer -->

                    </div>  <!-- END .posting-tool-background -->
                  </div>  <!-- END .posting-tool-anchor -->

                  <!-- END POSTING TOOL -->