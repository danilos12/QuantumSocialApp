// Script for Quantum Star Effects

// LightMode Settings
var n_stars = 120
var colors = [
  '#741A67',
  '#43EBF1',
  '#F400C4',
  '#72FF8F']
for ( let i = 0; i < 98; i++) {
  colors.push( '#8F74BC', '#DD69CC')
}

var canvas = document.querySelector('canvas')
canvas.width = innerWidth
canvas.height = innerHeight

addEventListener( 'resize', () => {
  canvas.width = innerWidth
  canvas.height = innerHeight
  stars = []
  init()
})

canvas.style.background = 'rgba(255, 255, 255, 0.0)'
var c = canvas.getContext('2d')

const randomInt = ( max, min) => Math.floor( Math.random() * (max - min) + min)

var bg = c.createRadialGradient( canvas.width/ 2, canvas.height * 3, canvas.height ,canvas.width/ 2,canvas.height , canvas.height * 4);
bg.addColorStop(0, "rgba(255, 255, 255, 0.0)");
bg.addColorStop(0, "rgba(255, 255, 255, 0.0)");

class Star {
  constructor( x, y, radius, color) {
    this.x = x || randomInt( 0, canvas.width)
    this.y = y || randomInt( 0, canvas.height)
    this.radius = radius || Math.random() * 1.3
    this.color = color || colors[randomInt(0, colors.length)]
    this.dy = -Math.random() * .3
  }
  draw () {
    c.beginPath()
    c.arc( this.x, this.y, this.radius, 0, Math.PI *2 )
    c.shadowBlur = randomInt( 7, 15)
    c.shadowColor = this.color
    c.strokeStyle = this.color
    c.fillStyle = 'rgba( 255, 255, 255, .5)'
    c.fill()
    c.stroke()
    c.closePath()
  }
  update( arrayStars = [] ) {
    if ( this.y - this.radius < 0 ) this.createNewStar( arrayStars )

    this.y += this.dy
    this.draw()
  }
  createNewStar( arrayStars = [] ) {
    let i = arrayStars.indexOf( this )
    arrayStars.splice( i, 1)
    arrayStars.push( new Star( false, canvas.height + 5))
  }
}
var stars = []
function init() {
  for( let i = 0; i < n_stars; i++ ) {
    stars.push( new Star( ) )
  }
}
init()

function animate() {
  requestAnimationFrame( animate)
  c.clearRect( 0, 0, canvas.width, canvas.height)
  c.fillStyle = bg
  c.fillRect(0, 0, canvas.width, canvas.height)
  stars.forEach( s => s.update( stars ))
}
animate()

/*
// DarkMode Settings
var n_stars = 75
var colors = [
  '#741A67',
  '#43EBF1',
  '#F400C4',
  '#72FF8F']
for ( let i = 0; i < 98; i++) {
  colors.push( '#fff')
}

var canvas = document.querySelector('canvas')
canvas.width = innerWidth
canvas.height = innerHeight

addEventListener( 'resize', () => {
  canvas.width = innerWidth
  canvas.height = innerHeight
  stars = []
  init()
})

canvas.style.background = 'rgba(255, 255, 255, 0.0)'
var c = canvas.getContext('2d')

const randomInt = ( max, min) => Math.floor( Math.random() * (max - min) + min)

var bg = c.createRadialGradient( canvas.width/ 2, canvas.height * 3, canvas.height ,canvas.width/ 2,canvas.height , canvas.height * 4);
bg.addColorStop(0, "rgba(255, 255, 255, 0.0)");
bg.addColorStop(0, "rgba(255, 255, 255, 0.0)");

class Star {
  constructor( x, y, radius, color) {
    this.x = x || randomInt( 0, canvas.width)
    this.y = y || randomInt( 0, canvas.height)
    this.radius = radius || Math.random() * 1.1
    this.color = color || colors[randomInt(0, colors.length)]
    this.dy = -Math.random() * .3
  }
  draw () {
    c.beginPath()
    c.arc( this.x, this.y, this.radius, 0, Math.PI *2 )
    c.shadowBlur = randomInt( 7, 15)
    c.shadowColor = this.color
    c.strokeStyle = this.color
    c.fillStyle = 'rgba( 255, 255, 255, .5)'
    c.fill()
    c.stroke()
    c.closePath()
  }
  update( arrayStars = [] ) {
    if ( this.y - this.radius < 0 ) this.createNewStar( arrayStars )

    this.y += this.dy
    this.draw()
  }
  createNewStar( arrayStars = [] ) {
    let i = arrayStars.indexOf( this )
    arrayStars.splice( i, 1)
    arrayStars.push( new Star( false, canvas.height + 5))
  }
}
var stars = []
function init() {
  for( let i = 0; i < n_stars; i++ ) {
    stars.push( new Star( ) )
  }
}
init()

function animate() {
  requestAnimationFrame( animate)
  c.clearRect( 0, 0, canvas.width, canvas.height)
  c.fillStyle = bg
  c.fillRect(0, 0, canvas.width, canvas.height)
  stars.forEach( s => s.update( stars ))
}
animate()

*/


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////



// Script for DarkMode Toggle

// check for saved 'darkMode' in localStorage
let darkMode = localStorage.getItem('darkMode');

const darkModeToggle = document.querySelector('#dark-mode-toggle');

const enableDarkMode = () => {
  // 1. Add the class to the body
  document.body.classList.add('darkmode');
  // 2. Update darkMode in localStorage
  localStorage.setItem('darkMode', 'enabled');
}

const disableDarkMode = () => {
  // 1. Remove the class from the body
  document.body.classList.remove('darkmode');
  // 2. Update darkMode in localStorage
  localStorage.setItem('darkMode', null);
}

// If the user already visited and enabled darkMode
// start things off with it on
if (darkMode === 'enabled') {
  enableDarkMode();
}

// When someone clicks the button
darkModeToggle.addEventListener('click', () => {
  // get their darkMode setting
  darkMode = localStorage.getItem('darkMode');

  // if it not current enabled, enable it
  if (darkMode !== 'enabled') {
    enableDarkMode();
  // if it has been enabled, turn it off
  } else {
    disableDarkMode();
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

// Hamburger Settings
$hamburger = $(".hamburger");
$twitterMenu = $(".twitter-dropdown-menu-outer");

$hamburger.click(function () {
  $twitterMenu.addClass('-active')
  if ( $twitterMenu.first().is( ":hidden" ) ) {
    twitterMenuOpen();
  } else {
    twitterMenuClose();
  }
});


// Close modal when the user clicks outside the modal or presses the escape key
$('canvas').on('click', function(event) {
  console.log(event)
  if ( $twitterMenu.hasClass('-active')) {
    console.log(1);
    twitterMenuClose();
  } 
});

// when escape is clicked
$(document).on("keydown", function(event) {
  if (event.which === 27) {
    if ( $twitterMenu.first().is( ":not(:hidden)" ) ) {
      twitterMenuClose();
    } 
  }
});

function twitterMenuOpen() {
  $twitterMenu.toggle( "slide", { direction: "up"  }, 800 );
}
function twitterMenuClose() {
  $twitterMenu.toggle( "slide", { direction: "right"  }, 400 );
  $twitterMenu.removeClass('-active')
}

///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// filter control toggle (top of many pages)
$filterToggle = $(".filter-controls-toggle");
$filterControls = $(".filter-controls");

$filterToggle.click( function() {
  $filterControls.toggle();
});


// filter dropdown config

//button vars
$filterButton = $(".filter-wrap");
$sortButton = $(".sort-wrap");

//dropdown vars
$filterDrop = $(".profile-filter-dropdown");
$sortDrop = $(".profile-sort-dropdown");
$pageDrops = $(".page-filters-dropdown");

$pageDrops.hide();

$filterButton.click( function () {
  if ( $filterDrop.is(":visible") ) {
    // hide filterDrop
    $filterDrop.toggle( "slide", { direction: "up"  }, 400 );
  } else {
    // hide sortDrop & show filterDrop
    $sortDrop.hide();
    $filterDrop.toggle( "slide", { direction: "up"  }, 800 );
  }
});

$sortButton.click( function () {
  if ( $sortDrop.is(":visible") ) {
    // hide sortDrop
    $sortDrop.toggle( "slide", { direction: "up"  }, 300 );
  } else {
    // hide filterDrop & show sortDrop
    $filterDrop.hide();
    $sortDrop.toggle( "slide", { direction: "up"  }, 500 );
  }
});



///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// comment now modal

$commentNowIcon = $(".comment-now-icon");
$commentNowModal = $(".comment-now-modal-inner");

$commentNowIcon.click(function () {
  if ( $commentNowModal.first().is( ":hidden" ) ) {
      $commentNowModal.toggle( "slide", { direction: "up"  }, 800 );
  } else {
      $commentNowModal.toggle( "slide", { direction: "up"  }, 400 );
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Evergreen Page Scripts

$evergreenLinkIcon = $(".paste-evergreen-tweet");
$evergreenLinkModal =$(".paste-evergreen-tweet-modal");

$evergreenLinkIcon.click( function() {
  if ( $evergreenLinkModal.first().is( ":hidden" ) ) {
      $evergreenLinkModal.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $evergreenLinkModal.toggle( "slide", { direction: "right"  }, 300 );
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Queued Preview Modal

$queuedPreview = $(".queued-preview-wrapper");
$queuedViewIcon = $(".queued-view-icon");

$queuedViewIcon.click( function() {
  if ( $queuedPreview.first().is( ":hidden" ) ) {
      $queuedPreview.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $queuedPreview.toggle( "slide", { direction: "right"  }, 300 );
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Queued Options Modal

$queuedOptIcon = $(".queued-options-icon");
$queuedOptions = $(".queued-options-wrapper");

$queuedOptIcon.click( function() {
  if ( $queuedOptions.first().is( ":hidden" ) ) {
      $queuedOptions.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $queuedOptions.toggle( "slide", { direction: "right"  }, 300 );
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Schedule Slots

$newSlot = $(".empty-slot");
$newSlotOverlay = $(".new-slot-anchor");
$closeSlotOverlay = $(".slot-popup-close");
$saveNewSlot = $(".save-new-slot");
$editSlot = $(".edit-scheduled");

$newSlot.click( function (e) {  
  $newSlotOverlay.addClass('_active')
  $newSlotOverlay.show();
  if ($newSlotOverlay.css('display') == 'block') {
    console.log($(this))
    var colday = $(this).data('col');
    var time = $(this).data('time');
    var row = $(this).data('row');
    var ampm = $(this).data('ampm');
    var day = $('.colday[data-col="day-' + colday + '"]').data('text');

    console.log(colday, time, row)
    $('.new-slot-form select').find('option[value="' + day + '"]').attr('selected', true);
    $('.new-slot-form .new-slot-time-wrapper select#hour-selector').find('option[value="' + row + '"]').attr('selected', true);
    $('.new-slot-form .new-slot-time-wrapper select#minute-selector').find('option[value="00"]').attr('selected', true);
    $('.new-slot-form .new-slot-time-wrapper select#am-pm-selector').find('option[value="' + ampm + '"]').attr('selected', true);
  }
});

$closeSlotOverlay.click( function() {
  $newSlotOverlay.hide();
});


// // // Close modal when the user clicks outside the modal or presses the escape key
// $newSlotOverlay.on('click', function(event) {
//   $newSlotOverlay.hide();
// });

// // when escape is clicked
$(document).on("keydown", function(event) {
  if (event.which === 27) {
    if ( $newSlotOverlay.first().is( ":not(:hidden)" ) ) {
      $newSlotOverlay.hide();
    } 
  }
});

$editSlot.click( function () {
  $newSlotOverlay.show();
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Tag Groups Page Scripts

$newTagGroupIcon = $(".new-tag-group-icon");
$newTagGroupModal = $(".new-tag-group-modal");

$newTagGroupIcon.click( function() {
  if ( $newTagGroupModal.first().is( ":hidden" ) ) {
      $newTagGroupModal.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $newTagGroupModal.toggle( "slide", { direction: "right"  }, 300 );
  }
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Display/Hide TagGroup Modal

$TagGroupModalClose = $(".tag-group-modal-close");

$tagGroupModal = $(".tag-group-modal-outer");
$tagOptionIcon = $(".hashtags-option-icon");

$tagOptionIcon.click( function() {
  if ( $tagGroupModal.first().is( ":hidden" ) ) {
      $tagGroupModal.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $tagGroupModal.toggle( "slide", { direction: "up"  }, 300 );
  }
});

$TagGroupModalClose.click( function (){
  $tagGroupModal.toggle( "slide", { direction: "up"  }, 300 );
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////

// Date Picker Settings

// $( function() {
// 	$( "#datepicker" ).datepicker({
// 		dateFormat: "dd-mm-yy" 
// 		,	duration: "fast"
// 	});
// } );


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// // Command Module & Settings - Launch & Hide

$modalLargeAnchor = $(".modal-large-anchor");
$modalLargeBackdrop = $(".modal-large-backdrop");

$launchCommandModule = $(".launch-command-module");
$postingToolOuter = $(".posting-tool-outer");
$closePostingTool = $(".posting-tool-close");

$launchGeneralSettings = $(".launch-general-settings");
$generalSettingsOuter = $(".general-settings-outer");
$closeGeneralSettings = $(".close-general-settings");

$launchTwitterSettings = $(".launch-twitter-settings");
$twitterSettingsOuter = $(".twitter-settings-outer");
$closeTwitterSettings = $(".close-twitter-settings");

// // Close Command Module
// $closePostingTool.click( function() {
//   $postingToolOuter.toggle( "slide", { direction: "up"  }, 350 );
//   setTimeout(function() {
//     $modalLargeAnchor.fadeOut("slow");
//     $modalLargeBackdrop.fadeOut("slow");
//   }, 175);
// });


// // Launch Command Module
// $launchCommandModule.click( function() {
//   $modalLargeAnchor.show();
//   setTimeout(function() {
//      $modalLargeBackdrop.fadeIn("slow");
//      console.log('show')
//    }, 20);
//    setTimeout(function() {
//       $postingToolOuter.toggle( "slide", { direction: "up"  }, 700 );
//     }, 225);
// });


// // Close General Settings
// $closeGeneralSettings.click( function() {
//   $generalSettingsOuter.toggle( "slide", { direction: "up"  }, 350 );
//   setTimeout(function() {
//     $modalLargeAnchor.fadeOut("slow");
//     $modalLargeBackdrop.fadeOut("slow");
//   }, 175);
// });


// // Launch General Settings
// $launchGeneralSettings.click( function() {
//   $modalLargeAnchor.addClass('modal-active')
//   $modalLargeAnchor.show();
//   setTimeout(function() {
//      $modalLargeBackdrop.fadeIn("slow");
//    }, 20);
//    setTimeout(function() {
//       $generalSettingsOuter.toggle( "slide", { direction: "up"  }, 700 );
//     }, 225);
// });


// // Close Twitter Settings
// $closeTwitterSettings.click( function() {
//   $twitterSettingsOuter.toggle( "slide", { direction: "up"  }, 350 );
//   setTimeout(function() {
//     $modalLargeAnchor.fadeOut("slow");
//     $modalLargeBackdrop.fadeOut("slow");
//   }, 175);
// });


// // Launch Twitter Settings
// $launchTwitterSettings.click( function() {
//   $modalLargeAnchor.show();
//   setTimeout(function() {
//      $modalLargeBackdrop.fadeIn("slow");
//    }, 20);
//    setTimeout(function() {
//       $twitterSettingsOuter.toggle( "slide", { direction: "up"  }, 700 );
//     }, 225);
// });

let currentModal = null;

$('[data-id="modal"]').click(function(event) {
  $target = event.target.id;  
  // console.log($target)
  openModal($target);
})

$('.modal-large-close').click(function(event) {
  $target = event.target.id;  
  closeModal($target)
})

$(document).ready(function() {
  $('img.ui-icon[data-icon="twitter-settings"]').on('click', function(event) {
    $target = event.target.id;  
    openTwitterModal($target);
  });
  
  $('img.twitter-bar-settings-icon').on('click', function(event) {
    $target = event.target.id;  
    openTwitterModal($target);
  });

  // $('.queue-day-wrapper').on("click", 'img.queued-icon-imp', function(event) {
  //   $target = event.target.id;  
  //   console.log($target)
  //   openTwitterModal($target);
  // });
});

// Open modal
function openModal(modalId) {
  // Close any open modal
  if (currentModal !== null) {
    closeModal(currentModal);
  }

  $modalLargeAnchor.show();
  // Open the requested modal
  // const modal = document.getElementById(modalId);
  // modal.style.display = 'block';

  setTimeout(function() {
    $modalLargeBackdrop.fadeIn("slow");
  }, 20);
  setTimeout(function() {
    $(`.${modalId}-outer`).toggle( "slide", { direction: "up"  }, 700 );
  }, 225);
  
  // Keep track of the current modal
  currentModal = modalId;
}

// Close modal
function closeModal(modalId) {
  // console.log(modalId);

  // const modal = document.getElementById(modalId);
  // modal.style.display = 'none';  
  $(`.${modalId}-outer`).toggle( "slide", { direction: "up"  }, 350 );
  setTimeout(function() {
    $modalLargeAnchor.fadeOut("slow");
    $modalLargeBackdrop.fadeOut("slow");
  }, 175);

  $('span.post-type-buttons img.post-tool-icon').removeClass('icon-active');    //remove active icons
  $('span.post-type-buttons img').removeClass('disabled');  // remove disabled 
  $("div[data-post]").filter(`.post-alert`).addClass("tweets-hide"); // hide tweet panels

  currentModal = null;
  console.log(currentModal);

  if (currentModal === null) {
    // Get the current pathname
    var currentPath = window.location.pathname;
  
    // Example: if you're on the page "https://example.com/about"
    if (currentPath === "/queue" || currentPath === "/evergreen" || currentPath === "/promos") {
      location.reload();
    } 
  }

}

// Open modal
function openTwitterModal(modalId) {  
  $(`.${currentModal}-outer`).toggle( "slide", { direction: "up"  }, 350 );

  $modalLargeAnchor.show();
  // Open the requested modal
  const modal = document.getElementById(modalId);
  modal.style.display = 'block';

  setTimeout(function() {
    $modalLargeBackdrop.fadeIn("slow");
  }, 20);
  setTimeout(function() {
    $(`.${modalId}-outer`).toggle( "slide", { direction: "up"  }, 700 );
  }, 225);
  
  // Keep track of the current modal
  currentModal = modalId;
}

// Close modal when the user clicks outside the modal or presses the escape key
window.onclick = function(event) {
  if (event.target.classList.contains('modal-large-backdrop')) {
    closeModal(currentModal);
  }
} 

window.onkeyup = function(event) {
  if (event.key === 'Escape') {
    console.log(currentModal);
    closeModal(currentModal);
  }
}

///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////


// Retweet Timer Settings

$retweetTimerModalClose = $(".retweet-modal-close");

$retweetTimerModal = $(".schedule-retweet-modal-outer");
$retweetTimerIcon = $(".retweet-timer-icon");

$retweetTimerIcon.click( function() {
  if ( $retweetTimerModal.first().is( ":hidden" ) ) {
      $retweetTimerModal.toggle( "slide", { direction: "up"  }, 400 );
  } else {
      $retweetTimerModal.toggle( "slide", { direction: "up"  }, 300 );
  }
});

$retweetTimerModalClose.click( function (){
  $retweetTimerModal.toggle( "slide", { direction: "up"  }, 300 );
});


///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////



///////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////
