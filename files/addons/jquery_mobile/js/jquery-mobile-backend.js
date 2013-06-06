jQuery(function($){
	
	var count = $('#sy_navi .sy_content').length;
	var del_button = '<div class="rex-button"><input type="button" value="'+name+' löschen" class="submit sy_del_block" /></div>';
	
	$('#REX_FORM').on('click', '.sy_label',function(e) {
		var _this = $(this);
		if(_this.attr('id')) return false;
		
		// var index = _this.index('.sy_label:not([id])');  
		//http://stackoverflow.com/questions/3685047/select-all-element-with-a-not-null-id-in-jquery
		var index = _this.index()-1; 
		
		_this.closest('.sy_block').children('.sy_label').addClass('inaktiv');
		_this.removeClass('inaktiv');
		_this.nextAll('.sy_content:visible').fadeOut(500, function() {
			_this.nextAll('.sy_content:eq('+index+')').fadeIn(300);
		});
	});
	
	if($('#sy_add').length > 0) {
		
		function add_block(_this, insert) {
			count++;
			var html = _this.nextAll('.sy_content:first').html();
			_this.closest('.sy_block').children('.sy_label').addClass('inaktiv');
			
			if(insert == 'before') {
				_this.after('<div class="sy_label">'+name+' #'+count+'</div>');	
			} else {
				_this.before('<div class="sy_label">'+name+' #'+count+'</div>');	
			}
			
			_this.nextAll('.sy_content:visible').fadeOut(500, function() {
				if(html.indexOf('rex-widget') != -1) {
					html = html.replace('Media(0', 'Media('+count);
					html = html.replace('MEDIA_0', 'MEDIA_'+count);
				}

				if(insert == 'before') {
					_this.nextAll('.sy_content:first').before('<div class="sy_content">'+html+del_button+'</div>');
					_this.nextAll('.sy_content:first').find('input[type=text],input[type=hidden], textarea').val('');
				} else {
					_this.nextAll('.sy_content:last').after('<div class="sy_content">'+html+del_button+'</div>');
					_this.nextAll('.sy_content:last').find('input[type=text],input[type=hidden], textarea').val('');
				}
			});			
		}
		
		$('#sy_add').click(function() {
			add_block($(this), 'after')	
		});
		
		$('#sy_add_before').click(function() {
			add_block($(this), 'before')	
		});
		
		$('#REX_FORM').on('blur','.navi_name', function() {
			var _this = $(this);
			var text = _this.val();
			var index = _this.index('.navi_name');
			if($.trim(text) == '') text = name+' #'+parseInt(index+1);
			_this.closest('.sy_block').children('.sy_label').not('*[id]').eq(index).text(text);
		});
		
		$('#REX_FORM').on('click','.sy_del_block', function() {
			var _this = $(this);
			var _block = _this.closest('.sy_block');
			_block.children('.sy_label').not('.inaktiv').remove();
			_this.closest('.sy_content').fadeOut(500, function(){ 
				$(this).remove();
				_block.children('.sy_label:last').prev().removeClass('inaktiv');
				_block.children('.sy_content:last').fadeIn(300);
			});
			count--;
		});
		
	}
	
	
});