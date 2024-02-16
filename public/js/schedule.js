$(function() {
	
	$('form.new-slot-form').on('submit', async function(event) {
		event.preventDefault();
		const form = $(this).serialize();

        var action = $('input[name="action"]').val() === "edit" ? "edit" : "add";
        
		$.ajax({			  
            url: APP_URL + "/schedule/save?action=" + action,
            method: "POST",
            data: form,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function(response) {
                console.log(response);
                $('.new-slot-anchor').attr('style', 'display: none');

                location.reload();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle errors here
                console.log(jqXHR, textStatus, errorThrown);
            },                                
		})
	});

    var slot = [];
    async function fetchScheduledSlots() {
        var url = APP_URL + "/schedule/slots?twitter_id=" + TWITTER_ID;
        try {
            const response = await fetch(url);
            const responseData = await response.json();
    
            if (responseData.data.length > 0) {                
                
                var sort = responseData.data.sort(function(a, b) {
                    return parseInt(a.minute_at) - parseInt(b.minute_at);
                });

                var item = [];

                // $emptySlot.detach();
                $.each(sort, function(index, item) {
                    var $template = scheduledSlot(item);
                    // console.log($('.slot-cards[data-day="' + item.slot_day + '"][data-time="' + item.hour + '"][data-ampm="' + item.ampm + '"] > div:first'))
                    $('.slot-cards[data-day="' + item.slot_day + '"][data-time="' + item.hour + '"][data-ampm="' + item.ampm + '"]').append($template);
                              
                    item['slot_day'] = item.slot_day;
                    item['hour'] = item.hour;
                    item['minute_at'] = item.minute_at

                    slot.push(item);
                })                    

            } else {
                $(".errorMessage").text('No tweets found');
            }
        } catch (error) {
            console.log("An error occurred while fetching the slots: " + error);
        }       
    }

    
    // Call the async function
    fetchScheduledSlots();
    
    $('div.slot-cards').on('click', 'img.ui-icon', async function(e) {
        var id = e.target.id;
        var btn = id.split('-');
        console.log(btn);
        try {
            switch (btn[0]) {
                case "edit" :
                    editSlotScheduler(btn[1])
                    break;
                case "clone" :
                    actionSchedule(btn[1], "clone");
                    break;
                case "delete" : 
                    actionSchedule(btn[1], "delete");
                    break;                        
            }            
            
        } catch (error) {
            console.log("An error occurred while fetching the slots: " + error);
        }      

    })

    function editSlotScheduler(id) {             
        $(".new-slot-anchor").addClass('_active');
        $(".new-slot-anchor").show();           
        if ( $('.new-slot-anchor').css('display') == 'block') {
            var day = $('#' + id).data('day');
            var hour = $('#' + id).data('hour');
            var min = $('#' + id).data('minute');
            var ampm = $('#' + id).data('ampm');
            var type = $('#' + id).data('type');
            // var day = $('.colday[data-col="day-' + colday + '"]').data('text');
        
            console.log(day, hour, min, ampm, type)
            $('.new-slot-form select').find('option[value="' + day + '"]').attr('selected', true);
            $('.new-slot-form .new-slot-time-wrapper select#hour-selector').find('option[value="' + hour + '"]').attr('selected', true);
            $('.new-slot-form .new-slot-time-wrapper select#minute-selector').find('option[value="' + min +'"]').attr('selected', true);
            $('.new-slot-form .new-slot-time-wrapper select#am-pm-selector').find('option[value="' + ampm + '"]').attr('selected', true);           
            $('#make-promo[value="' + type + '"]').prop('checked', true);

            // Create a new input element
            var actionElement = $('<input/>', {
                'name': 'action',
                'type': 'hidden',
                'value': 'edit', 
            });
  
            var idElement = $('<input/>', {
                'name': 'id',
                'type': 'hidden',
                'value': id, 
            });
  
            $('.new-slot-form').prepend(actionElement);
            $('.new-slot-form').prepend(idElement);
        }        
    }

    async function actionSchedule(id, action) {
        var url = APP_URL + "/schedule/action/" + action + "?slot_id=" + id;

        try {
            const response = await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr("content"),
                }
            });
            const responseData = await response.json();

            if (responseData.status === 200) {
                alert(responseData.message);
                location.reload();
            } else {
                $(".errorMessage").text(responseData.message);
            }
        } catch (error) {
            console.log("An error occurred while fetching the slots: " + error);
        }   
    }

    function scheduledSlot(item) {
        var template = `
        <div class="slot-cell-inner scheduled-slot slot-${item.post_type}" id="${item.id}" data-day="${item.slot_day}" data-hour="${item.hour}" data-minute="${item.minute_at}" data-ampm="${item.ampm}" data-type="${item.post_type}">
            <div class="scheduled-slot-item">
                <span class="slot-time" > ${item.hour + ":" + item.minute_at + " " + item.ampm}</span>
                <img src="${APP_URL}/public/ui-images/icons/05-drafts.svg" class="ui-icon edit-scheduled" id="edit-${item.id}" />
                <img src="${APP_URL}/public/ui-images/icons/pg-clone.svg" class="ui-icon clone-scheduled" id="clone-${item.id}" />
                <img src="${APP_URL}/public/ui-images/icons/pg-close.svg" class="ui-icon delete-scheduled" id="delete-${item.id}" />
            </div>
            
        </div>           
        `;

        return template;
    }	
});
