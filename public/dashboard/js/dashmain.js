(function () {
	"use strict";

	// show password
	$('.show-password').click(function () {
		$(this).siblings('span').toggleClass('hidden');
		$(this).siblings('small').toggleClass('hidden');
		$(this).children('i').toggleClass('fa-eye fa-eye-slash text-warning text-success');
	});

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		console.log('ss');
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

	//inits
    $('[title]').tooltip();
    $('[data-toggle="popover"]').popover();
	$('.pdp').persianDatepicker();
	$('.select2').select2({
       width: '100%',
    });

	//are-you-sures
	$('.delete').click(function(){
		var htmlID = $(this).attr('data-target');
		var target = $('form#'+htmlID);
		swal({
			title: "آیا مطمئن هستید؟",
			text: "شما دیگر قادر به باز گردانی آن نخواهید بود!",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "بله. پاک شود.",
			cancelButtonText: "لغو",
			closeOnConfirm: false,
			closeOnCancel: false
		}, function(isConfirm) {
			if (isConfirm) {
				target.submit();
			} else {
				swal("عملیات لغو شد.", "اطلاعاتی پاک نشد", "error");
			}
		});
	});

})();

$(document).on('click','[data-check]',function () {
	var content = $(this).data('check');
	var target = $('#checked-ids');
	var checked = $(this).attr('data-checked');
	var reversed = checked == 1 ? 0 : 1;
	$('#checked-form > input.checked-input').remove();

	if (content == 'all') {
		$('[data-check]').toggleClass('fa-square-o fa-check-square-o').attr('data-checked', reversed);
	}else {
		$('[data-check=all]').removeClass('fa-check-square-o').addClass('fa-square-o').attr('data-checked', 0);
		$(this).toggleClass('fa-square-o fa-check-square-o').attr('data-checked', reversed);
	}

	$('[data-check]').each(function () {
		var id = $(this).attr('data-check');
		var val = $(this).attr('data-checked');
		if (id != 'all' && val==1) {
			$('#checked-form').append('<input type="hidden" class="checked-input" name="checked_ids[]" value="'+id+'">');
		}
	});

});

$(document).on('change', '#status', function () {
	var value = $(this).val();
	if (value == 3) {
		$(this).parents('form').find('#information').slideDown().prop('required',true);
	}else {
		$(this).parents('form').find('#information').slideUp().prop('required',false);
	}
});

$(document).on('change', '#education-grade', function () {
	var value = $(this).val();
	var target = $('#education-field');
	var div = target.parents('.form-group')
	if (value == 'سیکل' || value=='بی سواد') {
		div.hide();
		target.prop('required',false);
	}else {
		div.show();
		target.prop('required',true);
	}
});
