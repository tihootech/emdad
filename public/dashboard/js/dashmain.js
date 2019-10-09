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


	// drag and drop
	$( ".draggable" ).draggable();
    $( ".droppable" ).droppable({
      drop: function( event, ui ) {
        var id = ui.draggable.attr('data-signup-id');
		var target = $(this).parents('form#perform-form').find('#signup-ids-hidden-inputs');
		target.append('<input type="hidden" name="signup_ids[]" value="'+id+'">');
      }
    });


	// mark sessions modal
	$('#sessionsModal').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var sessionId = button.data('session');
		var teacherId = button.data('teacher');
		var modal = $(this);
		modal.find('.modal-body input[type=hidden]').val(sessionId);
		modal.find('.modal-body select').val(teacherId);
	});

})();

$(document).on('change','input[name=reserve_type]',function () {
    var type = $(this).attr('data-type');
    $('[data-room-reserve-type]').hide();
    $('[data-room-reserve-type='+type+']').show();
});

$(document).on('change','#room-select-in-create-booking',function () {
    var roomId = $(this).val();
    var formData = {room_id:roomId};
    var method = 'periods_for_room';
    var target = $('#period-select-in-create-booking');
    sendAjax(method,formData,target);
});

$(document).on('click','#jq-print',function () {
    var element = $('<div dir="rtl"></div>');
    $('.jqprint').each(function () {
        element.append($(this).clone());
    });
    element.print();
});

$('#editImageModal').on('show.bs.modal', function(event) {
	var link = $(event.relatedTarget);
	var id = link.data('image-id');
	var title = link.data('image-title');
	var description = link.data('image-description');
	var modal = $(this);
	modal.find('.modal-body form').attr('action',documentRoot+'/images/'+id);
	modal.find('.modal-body #image-title').val(title);
	modal.find('.modal-body #image-description').val(description);
});

function SmsCount(element) {
    var body = element.val();
    var characters = body.length;

    var smsCount = 0;
    if (characters == 0) {
        smsCount = 0;
    }else if ( characters <= 70) {
        smsCount = 1;
    }else if ( characters <= 134 ) {
        smsCount = 2;
    }else {
        var dif = characters - 134;
        var smsCount = 2 + Math.ceil(dif/67);
    }

    element.siblings('#sms-info').find('#char-count').html(characters);
    element.siblings('#sms-info').find('#sms-count').html(smsCount);
}

function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

$(document).on('change','input[type=color]', function () {
	var color = $(this).val();
	$(this).siblings('input[type=text]').val(color);
	$(this).css('background-color',color);
});

$(document).on('click','#add-clone-row', function () {
	var count = $('.to-be-cloned').length;
	var source = $('.to-be-cloned').first().clone();
	source.find('input#id').val(null);
	source.find('.null').val(null);
	source.find('.zero').text(0);
	source.find('input#position').first().val(count+1);
	source.find('.direct-x').remove();

	// if links
	source.find('input#links-id').attr('name', 'links['+count+'][id][]');
	source.find('input#links-position').attr('name', 'links['+count+'][position][]');
	source.find('input#links-link').attr('name', 'links['+count+'][link][]');
	source.find('input#links-icon').attr('name', 'links['+count+'][icon][]');

	// select2
	source.find('span.select2').remove();
	source.find('select.select2').select2({width: '100%'});

	source.appendTo('#clone-box');

	$('.remove-clone-row').show();
});

$(document).on('click','#add-copy-row', function () {
	var box = $(this).parents('.copy-box');
	var count = box.find('.to-be-copied').length;
	var source = $(this).parents('.to-be-copied').clone();
	source.find('input#links-id').val(null);
	source.find('input#position').val(count+1);
	source.appendTo(box);
	$('.remove-copy-row').show();
});

$(document).on('click', '.remove-copy-row', function () {
	var box = $(this).parents('.copy-box');
	$(this).parents('.to-be-copied').remove();
	if(box.find('.remove-copy-row').length < 2) {
		box.find('.remove-copy-row').hide()
	}
})

$(document).on('click', '#add-to-sections', function () {
	$('.sections-fixed-bottom').show();
	var type = $(this).attr('data-section-type');
	var name = $(this).attr('data-section-name');
	var element = "<div class='inputs-at-bottom'> <i class='fa fa-times fa-2x text-danger'></i> <input name='title[]' placeholder='عنوان تب' class='form-control' /> <input type='hidden' name='type[]' value="+type+"> <span class='btn btn-dark btn-block'> نوع : "+name+" </span> </div>";
	$('#sections-fixed-bottom').append(element);
})

$(document).on('click', '.sections-at-bottom i.fa-times', function () {
	$(this).parents('.sections-at-bottom').remove();
})

$(document).on('submit', 'form', function () {
	$(this).find('button[type=submit]').attr('disabled','disabled');
})

$(document).on('click', 'button.confirm', function () {
	$(this).attr('disabled','disabled');
})

$(document).on('input', '#check-reserve input', function () {
	var value = $(this).val();
	if (value.length == 3) {
		$(this).parent().next().find('input').focus();
	}
})

$(document).on('change','#default-service-id',function () {
	var parent = $(this).parents('.to-be-cloned');
	var option = $(this).find('option:selected');

	var price = option.attr('data-price');
	var title = option.attr('data-title');

	parent.find('input.first-amount').val(price);
	parent.find('input.product-name').val(title);

	itemBoxResult(parent);

});

$(document).on('input', 'form.transaction input[type=number]', function () {

	var parent = $(this).parents('.to-be-cloned');
	itemBoxResult(parent);

})

$(document).on('click', '#check-all-select2', function () {

	if($(this).is(':checked') ){
        $(".select2 > option").attr("selected","selected");
        $(".select2").trigger("change");
    }else{
        $(".select2 > option").removeAttr("selected");
         $(".select2").trigger("change");
     }

})

function itemBoxResult(parent) {

	var option = parent.find('select#default-service-id option:selected');

	var clubDiscount = calculateClubDiscount(option);
	var amount = parent.find('input.first-amount').val();
	var finalAmount = amount - clubDiscount;
	var count = parent.find('input.count').val();
	var cashDiscount = parent.find('input.cash-discount').val();

	parent.find('span.first-amount').text(number_format(amount));
	parent.find('span.club-discount').text(number_format(clubDiscount));
	parent.find('span.final-amount').text(number_format(finalAmount));
	parent.find('span.count').text(number_format(count));
	parent.find('span.total').text(number_format(count*finalAmount));
	parent.find('span.cash-discount').text(number_format(cashDiscount));
	parent.find('span.payable').text(number_format( (count*finalAmount) - cashDiscount));

	parent.find('input.club-discount').val(clubDiscount);
	parent.find('input.final-amount').val(finalAmount);
	parent.find('input.total').val(count*finalAmount);
	parent.find('input.payable').val((count*finalAmount) - cashDiscount);

	var clubGift = calculateClubGift(option);
	parent.find('span.club-gift').text(number_format(clubGift));
	parent.find('input.club-gift').val(clubGift);

	calculateTransaction();
}

function calculateClubDiscount(option) {
	var discount = 0;
	var optionDiscountAmount = option.attr('data-discount-amount');
	var optionDiscountPercent = option.attr('data-discount-percent');

	if (optionDiscountAmount) {
		discount += parseInt(optionDiscountAmount);
	}
	if (optionDiscountPercent) {
		var parent = option.parents('.to-be-cloned');
		var amount = parent.find('input.first-amount').val();
		amount = (amount * optionDiscountPercent) / 100;
		discount += parseInt(amount);
	}

	return discount;
}

function calculateClubGift(option) {
	var gift = 0;
	var optionGiftAmount = option.attr('data-gift-amount');
	var optionGiftPercent = option.attr('data-gift-percent');

	if (optionGiftAmount) {
		gift += parseInt(optionGiftAmount);
	}
	if (optionGiftPercent) {
		var parent = option.parents('.to-be-cloned');
		var amount = parent.find('input.payable').val();
		amount = (amount * optionGiftPercent) / 100;
		gift += parseInt(amount);
	}

	return gift;
}

function calculateTransaction() {

	var customerCredit = $('#clone-box').attr('data-customer-credit');
	var totalAmount = 0;
	var totalDiscount = 0;
	var payableAmount = 0;
	var finalPayableAmount = 0;
	var giftAmount = 0;

	$('input.first-amount').each(function () {
		totalAmount += parseInt($(this).val() ? $(this).val() : 0 );
	});
	$('input.club-discount').each(function () {
		totalDiscount += parseInt($(this).val() ? $(this).val() : 0 );
	});
	$('input.cash-discount').each(function () {
		totalDiscount += parseInt($(this).val() ? $(this).val() : 0 );
	});
	$('input.payable').each(function () {
		payableAmount += parseInt($(this).val() ? $(this).val() : 0 );
	});
	$('input.club-gift').each(function () {
		giftAmount += parseInt($(this).val() ? $(this).val() : 0 );
	});

	payableAmount = totalAmount - totalDiscount;
	if (payableAmount > customerCredit) {
		finalPayableAmount = payableAmount - customerCredit;
	}

	$('span#total-sum').text(number_format(totalAmount));
	$('span#total-discount').text(number_format(totalDiscount));
	$('span#payable-amount').text(number_format(payableAmount));
	$('span#final_payable-amount').text(number_format(finalPayableAmount));
	$('span#gained-credit').text(number_format(giftAmount));

	$('input[type=hidden].total-sum').val(totalAmount);
	$('input[type=hidden].total-discount').val(totalDiscount);
	$('input[type=hidden].payable-amount').val(payableAmount);
	$('input[type=hidden].final_payable-amount').val(finalPayableAmount);
	$('input[type=hidden].gained-credit').val(giftAmount);
}
