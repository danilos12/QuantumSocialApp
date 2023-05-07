<div class="new-slot-anchor">
    <div class="new-slot-overlay">
        <div class="new-slot-outer">

        <img src="{{ asset('public') }}/ui-images/icons/pg-close.svg" class="slot-popup-close" />

        <div class="new-slot-inner frosted">

            <span class="new-slot-title">
            Schedule A Slot</span>

            <form class="new-slot-form" enctype="multipart/form-data" method="post">
                    @csrf
                <select id="days-selector" name="days-selector" class="days-selector">
                    <option value="">Choose days</option>
                    <option value="sunday">Sunday</option>
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="weekdays">Weekdays</option>
                    <option value="weekend">Weekend Days</option>
                    <option value="everyday">Every Day</option>
                </select>  <!-- END .days-selector -->

                <div class="new-slot-time-wrapper">

                    <select id="hour-selector" name="hour-selector" class="hour-selector">
                    <option value="">Hour</option>
                    @for ($i = 0; $i <= 12; $i++)                        
                        <option value="{{  $i }}"> {{  $i }}</option>                        
                    @endfor
                    
                    </select>  <!-- END .hour-selector -->

                    <select id="minute-selector" name="minute-selector" class="minute-selector">
                        <option value="">Minute</option>
                        @for ($i = 0; $i <= 59; $i++)
                        @if( $i < 10 ) 
                            <option value="0{{ $i }}"> 0{{  $i }}</option>
                        @else
                            <option value="{{  $i }}"> {{  $i }}</option>
                        @endif
                        
                    @endfor
                    </select>  <!-- END .minute-selector -->

                    <select id="am-pm-selector" name="am-pm-selector" class="am-pm-selector">
                    <option value="AM">AM</option>
                    <option value="PM">PM</option>
                    </select>  <!-- END .am-pm-selector -->

                </div>  <!-- END .new-slot-time-wrapper -->

                <div class="checkbox-wraps">
                    <input type="checkbox" id="make-promo" name="make-promo" value="promos-tweets" class="slot-type-checkbox">
                    <label for="make-promo">Reserve Slot for Promos</label>
                </div>  <!-- END .checkbox-wraps -->

                <div class="checkbox-wraps">
                    <input type="checkbox" id="make-promo" name="make-promo" value="evergreen-tweets" class="slot-type-check-label">
                    <label for="make-evergreen">Reserve Slot for Evergreen</label>
                </div>  <!-- END .checkbox-wraps -->
                    <div class="checkbox-wraps">
                    <input type="checkbox" id="make-promo" name="make-promo" value="tweet-storm-tweets" class="slot-type-check-label">
                    <label for="make-tweetstorm">Reserve Slot for Tweet Storms</label>
                </div>  <!-- END .checkbox-wraps -->

                <input type="submit" class="save-new-slot" value="Save Time Slot" />
                <div class="some-messages"></div>
                <div class="redirectLink" style="display: none">
                    <span >You will be refreshed in </span><span id="saved-countdown"> </span><span>seconds</span>
                </div>
            </form>  <!-- END .new-slot-form -->

        </div>  <!-- END .new-slot-inner -->
</div>  <!-- END .new-slot-outer -->

 
   