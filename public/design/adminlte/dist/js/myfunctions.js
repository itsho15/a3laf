function check_all(){
	//item_checkbox
	$('input[class="item_checkbox"]:checkbox').each(function(){
		if ($('input[class="check_all"]:checkbox:checked').length == 0) {
			$(this).prop('checked',false);
		}else{
			$(this).prop('checked',true);
		}
	});
}


function delete_all(){
	$(document).on('click','.del_all',function(){
		var url = $(this).data('attr');
		
		$('#form_data').attr('action',url);
		$('#form_data').submit();

	});
	$(document).on('click','.delBtn',function(){
		var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;
		if (item_checked > 0) {
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#mutlipleDelete').modal('show');
	});
}

function convert_all(){
	$(document).on('click','.convert_all',function(){

		var url = $(this).data('attr');
		
		$('#form_data').attr('action',url);
		$('#form_data').submit();

	});
	$(document).on('click','.convertBtn',function(){
		var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;

		if (item_checked > 0) {
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#mutlipleConvert').modal('show');
	});
}

function convert_allSelected(){
	$(document).on('click','.convert_allSelected',function(){

		var url = $(this).data('attr');
		
		$('#form_data').attr('action',url);
		$('#form_data').submit();

	});
	$(document).on('click','.convertBtn',function(){
		var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;

		if (item_checked > 0) {
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#mutlipleConvert').modal('show');
	});
}

function sendAll(){
	$(document).on('click','.sendemailselect',function(){

		var url = $(this).data('attr');
		
		$('#form_data').attr('action',url);
		$('#form_data').submit();

	});
	$(document).on('click','.sendemail',function(){
		var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;

		if (item_checked > 0) {
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#mutlipleSend').modal('show');
	});
}

function archive_all(){
	$(document).on('click','.archiveAll',function(){
		var url = $(this).data('attr');
		
		$('#form_data').attr('action',url);
		$('#form_data').submit();

	});

	$(document).on('click','.archivedBtn',function(){
		var item_checked = $('input[class="item_checkbox"]:checked').filter(":checked").length;
		if (item_checked > 0) {
			$('.record_count').text(item_checked);
			$('.not_empty_record').removeClass('hidden');
			$('.empty_record').addClass('hidden');
		}else{
			$('.record_count').text('');
			$('.not_empty_record').addClass('hidden');
			$('.empty_record').removeClass('hidden');
		}
		$('#mutlipleArchive').modal('show');
	});
}

$(document).on('ready',function(){
	$('#dataTableBuilder_wrapper a').removeClass('dt-button');
});


