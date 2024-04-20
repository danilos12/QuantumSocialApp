<?php
  $layout = Auth::guard('web')->check() ? 'layouts.app' :
          (Auth::guard('member')->check() ? 'layouts.membersdashboard' : null);
?>

@if($layout)
    @extends($layout)
@endif

@section('content')

<div class="page-outer bulk-outer">
                <div class="page-inner bulk-inner">

                  <div class="page-head-n-sort">
                    <div class="head-left-wrap">
                      <span class="profile-heading">
                        Bulk Uploader</span>
                    </div>  <!-- END .head-left-wrap -->
                  </div>  <!-- END .page-head-n-sort -->

                  <div id="errorContainer"></div>

                  <div class="bulk-flex-column">
                  {{-- <div class="bulk-upload-section">
                    <span class="bulk-upload-title">Advance Uploader:
                      <form id="uploadCsvForm">
                        <input type="file" accept=".csv" class="bulk-upload-file-selector" id="csvFileInput" />
                        <input value="Schedule Your Posts" class="bulk-upload-submit" id="uploadCsv"/>
                    </form>
                  </div>   --}}

                  <div class="bulk-upload-section">
                    <span class="bulk-upload-title">Basic Upload: <span class="font-italic">(Please upload .csv file)</span>
                      <form id="uploadCsvForm" >
                        {{-- @csrf --}}
                        <input type="file" accept=".csv" class="bulk-upload-file-selector" id="csvFileInput" />
                        {{-- <span class="bulk-upload-promo-title">
                            Upload entire file as Promo posts <i>(optional)</i>:
                        </span>
                        <select class="promo-select">
                            <option value="null">Select a Promo Campaign...</option>
                            <option>All Promo Titles Here</option>
                        </select> --}}
                        <input type="button" value="Schedule Your Posts" class="bulk-upload-submit" id="uploadCsv1"/>
                        {{-- <button type="submit" class="bulk-upload-submit">Schedule your posts</button> --}}
                    </form>

                    {{-- to be back --}}
                  </div>  <!-- END .bulk-upload-section -->
                 
                </div>               

                  <div class="uploader-tips">

                    <span class="uploader-tips-title">
                      How to format your CSV file:
                    </span>
                    <ul>
                      <li>The first row is the title for the columns </li>
                      <li>Only the first 10 row is uploaded.</li>
                      <li>Maximum tweet length is 280 characters <i>( <a href="https://developer.twitter.com/en/docs/counting-characters" target="new">see more</a> )</i>.</li>
                      <li>Use \b\b\b to make TweetStorm breakpoints <i>(threading)</i>.</li>
                      <li>To retweet, include only the full URL <i>(with https)</i> of the tweet.</li>
                      <li>To quote a tweet, just add the full URL <i>(with https)</i> at the end of your comment.</li>
                      <li>Only links from Facebook is allowed, Instagram is still inprogress</li>
                      <li>To include an image, place the full image URL <i>(with https)</i> between sets of double asterisks, like: **https://domain.com/image.png**</li>
                    </ul>
                    <a href="{{ asset('public/')}}/files/quantum-upload-template.csv" target="new" class="download-bulk-template">Download Our CSV Template</a>

                  </div>  <!-- END .uploader-tips -->

                </div>  <!-- END .bulk-inner -->
              </div>  <!-- END .bulk-outer -->


@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/bulk.js')}}"></script>
@endsection


