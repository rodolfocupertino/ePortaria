// $(document).on('pjax:send', function() {
//   // $('#pleaseWaitDialog').show();
//   $('#pleaseWaitDialog').modal('show');
//   console.log('Success show!');
// })

// $(document).on('pjax:complete', function() {
//   $('#pleaseWaitDialog').modal('hide');
//   console.log('Success hide!');
// })

// $(document).on('pjax:timeout', function(event) {
//   // Prevent default timeout redirection behavior
//   event.preventDefault()
// })

// if ($.support.pjax) {
//  		$(document).pjax('a', '#pjax-container');
//  		console.log('Success works!');
//  }

// when .modal-wide opened, set content-body height based on browser height; 200 is appx height of modal padding, modal title and button bar

// $(".modal-wide").on("show.bs.modal", function() {
//   var height = $(window).height() - 200;
//   $(this).find(".modal-body").css("max-height", height);
// });


// $('body').on('hidden.bs.modal', '.modal-wide', function () {
// 	   		document.location.reload();
// });

// $('body').on('hidden.bs.modal', '.modal', function () {
// 	   		document.location.reload();
// });
