<style>
    .tweets-hide {
      display: none;
    }
    div[data-schedule="none"] {
      display: none;
    }
    .modal-large-outer.edit-bulk-outer {
        display: flex;
        flex-direction: column;
        background: var(--frost-background);
        color: var(--body-text);
        width: 513px;
        height: 550px;
        padding: 2.5em 3em 2.5em;
        border-radius: 10px;
        box-sizing: border-box;
    }

    .edit-bulk-outer label {
        text-transform: uppercase
    }

    .modal-large-outer .queued-watermark {
        position: relative;
        top: -35px;
        left: -42px;
        width: 115px;
        rotate: -2deg;
        filter: var(--watermark-color);
        opacity: .1;
        z-index: 51;
    }
    #datepicker-div, .scheduling-options-dd {
        width: 100%;
    }

    #ui-datepicker-div {
        background-color: purple
    }

    .input-group-text {
    cursor: pointer;
    }

    .edit-bulkpost {
        background: var(--frost-background);
        color: var(--body-text);
        padding: 0.5em 1em;
        margin: 0;
        border: none;
        border-radius: 5px;
        width: 100%
    }

    .editbulk-cta {
        width: 100%;
        background: #43EBF180;
        border-radius: 5px;
        border: none;
        padding: 0.5em;
    }

    #bulkpost_description {
        width: 100%
    }

    input::placeholder,
    textarea::placeholder { /* Chrome/Opera/Safari */
    color: white;
    }

    .input-group-append {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    z-index: 10;
    padding: 8px 15px;
    background-color: #fff;
    border-left: 1px solid #ced4da;

    background: transparent;
        color: var(--body-text);
        padding: 0.5em 1em;
        margin: 0;
        border: none;
        /* border-radius: 0 5px 5px 0; */
    }

    .input-group-append span {
    display: inline-block;
    vertical-align: middle;
    }

    .modal-large-close {
        top: -20px;
        right: -20px
    }

    .editBulk-header {
        font-family: Montserrat;
        font-size: 14px;
        font-weight: 400;
        line-height: 17px;
        letter-spacing: 0em;
        text-align: left;
        margin-bottom: 1.5em;
    }

    .bulk-form div.col {
        margin-bottom: 1em
    }

    .ll { 
        position: absolute;
        width: 100%;
        font-family: Montserrat
    }

    .scheduling-options-dd {
        width: 100%
    }
    </style>
    <div class="modal-large-outer edit-bulk-outer">
        <div class="modal-large-inner posting-tool-inner">
            <img src="{{ asset('public/')}}/ui-images/icons/leaf.png" class="queued-watermark">
        
            <img src="{{ asset('public/')}}/ui-images/icons/pg-close.svg" class="ui-icon modal-large-close posting-tool-close" id="edit-bulk"/>
                      
            
            <div class="ll">
                <div class="editBulk-header">YOU ARE CURRENTLY EDITING:</div>
                
                <form action="" class="row bulk-form">
                    <div class="form-group">
                        <div class="col-md-12 col">
                            <label for="post description">Post Description</label>
                            <textarea name="bulkpost_description" id="bulkpost_description" class="edit-bulkpost" cols="30" rows="5" placeholder="Message"></textarea>
                        </div>
                    </div>

                    {{-- <div class="col-md-12 col"> --}}
                    <div class="form-group">                                                                   
                        <div class="col-md-12 col">
                            <div class="input-group date" id="datepicker-div">
                                <input type="text" id="datepicker" class="edit-bulkpost" placeholder="Select Date" aria-describedby="basic-addon1" name="bulkpost_date">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon1"><i class="fa fa-calendar"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-4 col">
                            <select id="post-time-hour" name="ct-hour" class="post-time-hour scheduling-options-dd">
                                <option disabled selected>Hour</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{  $i }}"> {{  $i }}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="col-md-4 col">
                            <select class="post-time-minute scheduling-options-dd" name="ct-min">
                                <option disabled selected>Min</option>
                                @for ($i = 0; $i <= 59; $i++)
                                <option value="{{  $i }}"> {{  $i }}</option>
                                @endfor
                            </select>
                        </div>
                        
                        <div class="col-md-4 col">
                            <select id="post-time-format" name="ct-format" class="post-time-hour scheduling-options-dd">
                                <option disabled selected>AM/PM</option>                                
                                <option value="AM"> AM</option>
                                <option value="PM"> PM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">                
                        <div class="col-md-12 col">
                            <label for="post description">Image URL</label>
                            <input type="text" name="bulkimage_url" id="bulkimage_url" class="edit-bulkpost" placeholder="Image URL">
                        </div>
                    </div>
                    
                    <div class="form-group">                                
                        <div class="col-md-12 col">
                            <label for="post description">Link URL</label>
                            <input type="text" name="bulklink_url" id="bulklink_url" class="edit-bulkpost" placeholder="Link URL">
                        </div>
                    </div>
                        
                    <div class="form-group">                
                        <div class="col-md-12 col">
                            <input type="submit" value="Submit" class="editbulk-cta">
                        </div>
                    </div>

                    {{-- </div> --}}
    

                    
                </form>
                
            </div>
        </div>  <!-- END .posting-tool-inner -->
    </div>  <!-- END .posting-tool-outer -->
  
    
<script>
    $("#datepicker").on('click', function(e) {
    
    var datepicker = $("#datepicker")
   
    // Initialize the datepicker with the specified options
    datepicker.datepicker({
        dateFormat: "yy M. d",       
        duration: "fast"
    })

    // Show the datepicker
    datepicker.datepicker("show");
});    
</script>  