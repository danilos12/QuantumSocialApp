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
                    <p>Each row is a post and each column has different values. </p>
                    <ul>
                      <li>Column A – Your post text*</li>
                      <li>Column B – Year</li>
                      <li>Column C – Month (January, Jan or 1)</li>
                      <li>Column D – Day</li>
                      <li>Column E – Hour</li>
                      <li>Column F – Minute</li>
                      <li>Column G – Image URL</li>
                      <li>Column H – Link URL</li>
                    </ul>                                                                                          
                    
                    <p>*For Column A, you can add your entire post, including your hashtags.</p>
                    <p>**For Columns G & H, you can only add one or the other to a post.  If you want to add an image and a link, add the link in the post text on Column A</p>
                    
                    <a href="{{ asset('public/')}}/files/quantum-upload-template.csv" target="new" class="download-bulk-template">Download Our CSV Template</a>

                  </div>  <!-- END .uploader-tips -->

                </div>  <!-- END .bulk-inner -->
              </div>  <!-- END .bulk-outer -->


@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('public/js/bulk.js')}}"></script>
@endsection


