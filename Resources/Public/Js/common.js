/* © MikelMade 2015 (http://www.mikelmade.de) */

var _actedit = '';
$(document).ready(function(){
	var _nd = window.parent.document.getElementById('typo3-navigationDummy');
	if(_nd) { _nd.style.display = 'none'; }
	$('#xmodalbg,#editmodalbg').css({'opacity':'0.7'});
	
	$('.selectall').on('click',function(){
		var _class = $(this).prop('id').replace('selectall_','');
		selectall(_class);
	});
	
	$('#tmstop').on('click',function(){
		$('#tm').hide();
	});
	$('#editmodalclose').on('click',function(){
		$('#editmodalwrap,#editmodalbg').hide();
		unsetedit();
	});
	$('.edittabover').css({ opacity:'0.7' });
	if($('.editcontainer').length > 0){ $('.editcontainer').niceScroll(); }
	
	setedittabs();
	$(document.body).append('<div id="mmgui" title="http://www.mikelmade.de"></div>');
	
	$('select').on('mousedown',function(e){
		if($(this).hasClass('select_inactive')){
			e.preventDefault();
			$(this).blur();
		}
	});
});
window.onresize = res;

//###################
// res
//###################
function res() {
	var _w = $(window).width();
	var _h = $(window).height();
	$('#xmodalbg').css({height:$(document).height()+'px',width:$(document).width()+'px'});
	$('#editmodalwrap').css({top:(_h/2)+'px'});
	$('#editmodalwrap').css({left:(_w/2)+'px'});
}

//###################
// setedit
//###################
function setedit(_area){
	_actedit = _area;
	$("#"+_actedit+'>.edit').appendTo("#editmodalouter");
}

//###################
// unsetedit
//###################
function unsetedit(){
	if(_actedit.length > 0){
		$('#editmodalouter>.edit').appendTo($('#'+_actedit));
		_actedit = '';
	}
}

//###################
// setedittabs
//###################
function setedittabs(){
	$('.edittab_inactive').off().on('click',function(){
		if($(this).hasClass('subtab') == false){
			$('#tm').hide();
			_idarr = $(this).prop('id').split('_');
			var _etab = $('.edittab');
			for(i=0;i<_etab.length;i++){
				$(_etab[i]).removeClass('edittab').addClass('edittab_inactive');
				$(_etab[i]).find('select').removeClass('select').addClass('select_inactive');
				$(_etab[i]).find('.icon').removeClass($(_etab[i]).find('.icon').data('icon')).addClass($(_etab[i]).find('.icon').data('icon')+'_inactive');
			}
			$(this).removeClass('edittab_inactive').addClass('edittab');
			$(this).find('select').removeClass('select_inactive').addClass('select');
			$(this).find('.icon').removeClass($(this).find('.icon').data('icon')+'_inactive').addClass($(this).find('.icon').data('icon'));
			$('.editcontent').hide();
			$('#'+_idarr[0]+'_content_'+_idarr[2]).show();
			if($(this).data('sub')) { showsub($('#'+$(this).data('sub'))); }
			setedittabs();
		}
		else{ showsub($(this)); }
	});	
}

//###################
// showsub
//###################
function showsub(_elm){
	$('#tm').hide();
	_idarr = _elm.prop('id').split('_');
	var _etab = $('.subtab');
	for(i=0;i<_etab.length;i++){
		$(_etab[i]).removeClass('edittab').addClass('edittab_inactive');
		$(_etab[i]).find('select').removeClass('select').addClass('select_inactive');
		$(_etab[i]).find('.icon').removeClass($(_etab[i]).find('.icon').data('icon')).addClass($(_etab[i]).find('.icon').data('icon')+'_inactive');
	}
	_elm.removeClass('edittab_inactive').addClass('edittab');
	_elm.find('select').removeClass('select_inactive').addClass('select');
	_elm.find('.icon').removeClass(_elm.find('.icon').data('icon')+'_inactive').addClass(_elm.find('.icon').data('icon'));
	$('.subeditcontent').hide();
	$('#'+_idarr[0]+'_content_'+_idarr[2]).show();
	setedittabs();
}

//###################
// correcttabs
//###################
function correcttabs(_item){
	_tabs = $('.edittab');
	for(i=0;i<_tabs.length;i++){
		$('#'+_item+'tabover'+i+',#'+_item+'tab'+i).css({
			width: ($(_tabs[i]).width()+18)+'px',
			height: ($(_tabs[i]).height()+13)+'px',
		});
		$('.tabover'+i).css({ opacity:'0.7' });
		if(i>0){
			$('#'+_item+'tab'+i).css({
				left: (parseInt($('#'+_item+'tab'+(i-1)).css('left'))+parseInt($('#'+_item+'tab'+(i-1)).css('width'))+8)+'px'
			});
		}
	}
}

//###################
// initializeedit
//###################
function initializeedit(){
	$('.cedit').off('focus').on('focus',function(){
		$(this).parent().parent().addClass('activerow').removeClass('evenrow').removeClass('oddrow');
	});
	
	$('.cedit').off('blur').on('blur',function(){
		if($(this).parent().parent().hasClass('even')){
			$(this).parent().parent().removeClass('activerow').addClass('evenrow');
		}
		else if($(this).parent().parent().hasClass('odd')){
			$(this).parent().parent().removeClass('activerow').addClass('oddrow');
		}
	});
	
	$('.cedit').off('keyup').on('keyup',function(){
		if($(this).data('check').length != 0){ $('#'+$(this).data('check')).prop('checked',true); }
	});
	
	$('.selectedit').off('change').on('change',function(){
		if($(this).data('check')){
			if($(this).data('check').length != 0){ $('#'+$(this).data('check')).prop('checked',true); }
		}
	});
}

//###################
// checkdoublenames
//###################
function checkdoublenames(_elm,_class){
	var _string = $(_elm).html();
	var _list = $('.'+_class);
	for(i=0;i<_list.length;i++) {
		if($(_list[i]).prop('id') != _elm) {
			if($(_list[i]).html() == _string) {  return true; }
		}
	}
	return false;	
}

//###################
// toggleselect
//###################
function toggleselect(_elm){
	var _class = _elm.prop('id').replace('selectall_','');
	if(_elm.prop('checked') == true){ $('.'+_class).prop('checked',true); }
	else { $('.'+_class).prop('checked',false); }
}

//###################
// focusblur
//###################
function focusblur(_elm,_word){
	$('#'+_elm).off().on('focus',function(){
		if($(this).html() == _word) { $(this).html(''); }
	});
	$('#'+_elm).on('blur',function(){
		if($(this).html() == '') { $(this).html(_word); }
	});
}

//###################
// realWidth
//###################
function realWidth(obj){
  var clone = obj.clone();
  clone.css("visibility","hidden");
  $('body').append(clone);
  var width = clone.outerWidth();
  clone.remove();
  return width;
}

//###################
// selectall
//###################
function selectall(_class) {
	var _checked = false;
	var _list = $('.'+_class);
	for(i=0;i<_list.length;i++) {
		if($(_list[i]).prop('checked') == true) {
			_checked = true;
			break;
		}
	}
	if(_checked == true) { $('.'+_class).prop('checked',false); }
	else { $('.'+_class).prop('checked',true); }
}

//###################
// getchecked
//###################
function getchecked(_class) {
	var _checked = new Array;
	var _list = $('.'+_class);
	for(i=0;i<_list.length;i++) {
		if($(_list[i]).prop('checked') == true) {
			_checked.push($(_list[i]).prop('id').replace(_class+'_',''));
		}
	}
	return _checked;
}

//###################
// rearrangerowcolors
//###################
function rearrangerowcolors(_class){
	var _rowlist = $('.'+_class);
	var _rowclass = 'oddrow';
	var _rowclass2 = 'odd';
	_c = 0;
	for(i=0;i<_rowlist.length;i++) {
		if($(_rowlist[i]).css('display') != 'none') {
			$(_rowlist[i]).removeClass('oddrow').removeClass('evenrow').removeClass('odd').removeClass('even');
			_rowclass = (_c % 2 == 0) ? 'oddrow' : 'evenrow';
			_rowclass2 = (_c % 2 == 0) ? 'odd' : 'even';
			$(_rowlist[i]).addClass(_rowclass);
			$(_rowlist[i]).addClass(_rowclass2);
			_c++;
		}
	}
}

//###################
// modalwindow
//###################
function modalwindow(_set){
	var _ow,_oh;
	$('#xmodalwrap').removeClass('closable');
	$('#preloader,#xmodalclose,#uploadwrap').hide();
	
	if(_set.attachTo != null){
		if($('#'+_set.attachTo).length != 0){
			$('#xmodalwrap,#xmodalbg').appendTo('#'+_set.attachTo);
			_ow = (_set.outerwidth == null) ? $('#'+_set.attachTo).width()+'px' : _set.outerwidth+'px';
			_oh = (_set.outerheight == null) ? $('#'+_set.attachTo).height()+'px' : _set.outerheight+'px';
		}
	}
	else{
		_ow = (_set.outerwidth == null) ? $(window).width()+'px' : _set.outerwidth+'px';
		_oh = (_set.outerheight == null) ? $(window).height()+'px' : _set.outerheight+'px';
	}

	_ol = (_set.outerleft == null) ? '0px' : _set.outerleft+'px';
	_ot = (_set.outertop == null) ? '0px' : _set.outertop+'px';	
	_iw = (_set.innerwidth == null) ? '200px' : _set.innerwidth+'px';
	_ih = (_set.innerheight == null) ? '50px' : _set.innerheight+'px';
	_text = _set.text;
	
	if(_set.loader == true) {$('#preloader').show()};
	if(_set.closable == true) {
		$('#xmodalwrap').addClass('closable');
		$('#xmodalclose').show();
		$('.closable,#xmodalclose').off().on('click',function(){ modalclose(); });
	}
	
	$('#xmodalwrap,#xmodalbg').css({ width : _ow, height : _oh, left : _ol, top : _ot });
	if(_set.attachTo != null){
		$('#xmodalwindow').css({
			width : _iw, height : _ih,
			left : ($(window).scrollLeft()+((parseInt(_ow)/2)-(parseInt(_iw)/2)))+'px', top : ($(window).scrollTop()+((parseInt(_oh)/2)-(parseInt(_ih)/2)))+'px'
		});
	}
	else{
	$('#xmodalwindow').css({
		width : _iw, height : _ih,
		left : ($(window).scrollLeft()+((parseInt(_ow)/2)-(parseInt(_iw)/2)))+'px', top : ($(window).scrollTop()+((parseInt(_oh)/2)-(parseInt(_ih)/2)))+'px'
	});
	}
	$('#xmodalcontent').css({ width:(parseInt(_iw)-73)+'px', height:(parseInt(_ih)-16)+'px' });
	$('#xmodalcontent').html(_text);
	if(_set.attachTo != null){
		
	}
	else{
		$('#xmodalbg').css({height:$(document).height()+'px',width:$(document).width()+'px'});
	}
	$('#xmodalwrap,#xmodalbg').show();
}

function setXmodalWindow(){
	
}

//###################
// modaleditwindow
//###################
function modaleditwindow(_set){
	var _oh = $(window).height();
	var _ow = $(window).width();
	$('#editmodalbg').css({height:$(document).height()+'px',width:$(document).width()+'px'});
	if(_set.innerwidth){
		var _iw = _set.innerwidth;
		$('#editmodalouter,#editmodalwrap').css({ width : _iw+'px' });
		$('#editmodalwrap').css({left:(_ow/2)+'px'});
	}
	if(_set.innerheight){
		_ih = _set.innerheight;
		$('#editmodalouter,#editmodalwrap').css({ height : _set.innerheight+'px', });
		$('#editmodalwrap').css({top:(_oh/2)+'px'});
	}
	$('#editmodalwrap,#editmodalbg').show();	
}

//###################
//modalclose
//###################
function modalclose(){
	$('#xmodalwrap,#xmodalbg').hide();
	$('#xmodalwrap,#xmodalbg').appendTo(document.body);
}

//###################
//sortrows
//###################
function sortrows(_by,_wrapper,_container,_dir) {
	var _list = $('.'+_by);
	var _names = new Array();
	var _names_ids = new Array();
	for(i=0;i<_list.length;i++) {
		var _id = $(_list[i]).prop('id').replace(_by+'_','');
		var _name = $(_list[i]).html().toLowerCase();
		_names.push(_name);
		_names_ids[_name] = _id;
	}
	if(_dir == 'desc') { _names.reverse(); }
	else { _names.sort(); }
	$(document.body).append('<div id="sortcontainer" style="display:none;"></div>');
	$('#sortcontainer').html($('#'+_container).html());
	$('#'+_container).html('');
	for(i=0;i<_names.length;i++) {
		$('#'+_wrapper+'_'+_names_ids[_names[i]]).appendTo('#'+_container);
	}
	$('#sortcontainer').remove();
	rearrangerowcolors(_wrapper);
}

//###################
// sortoptions
//###################
function sortoptions(_select,_dir){
	var _options = $('#'+_select+'>option');
	var _otexts = new Array();
	var _otexts_ids = new Array();
	for(i=0;i<_options.length;i++){
		var _oname = $(_options[i]).text();
		_otexts.push(_oname.toLowerCase());
		_otexts_ids[_oname.toLowerCase()] = new Array(_oname,$(_options[i]).val());
	}
	if(_dir == 'desc') { _otexts.reverse(); }
	else { _otexts.sort(); }
	$('#'+_select).html('');
	for(i=0;i<_otexts.length;i++){
		$('#'+_select).append('<option value="'+_otexts_ids[_otexts[i]][1]+'">'+_otexts_ids[_otexts[i]][0]+'</option>');
	}
}

//###################
// initpics
//###################
function initpics(_class){
	$('.'+_class).off().on('mouseover',function(){
		if($(this).html().indexOf('Images/thdummy.png') == -1){
			$('#picholder').html($(this).html());
			$('#picholder').css({marginTop:'-'+($('#picholder').height()/2)+'px'});
			$('#picholder').show();
		}
		else{ $('#picholder').hide(); }
	});
	$('.'+_class).on('mouseout',function(){ $('#picholder').hide(); });
}

//###################
// setColorpicker
//###################
function setColorpicker(picker,col) {
	var f = $.farbtastic('#'+picker,{ callback: setCol(), width: 150,height:150 });
	var p = $('#'+picker).css('opacity', 1);
	var selected;
	var xid = $('#'+col).prop('id').replace('box','');
	$('#'+xid).on('mousedown',function(){ $('#'+col).click(); });
	$('#'+col).on('click',function(){
		f.linkTo(this);
		f.linkTo(function(){
			$('#'+xid).prop('value',f.color);
			$('#'+col).css('background-color',f.color);
		});
		f.setColor($('#'+xid).prop('value'));
		$('#'+xid).on('focus',function(){ f.setColor($('#'+xid).prop('value')); });
		$('#'+xid).on('keyup',function() { f.setColor($('#'+xid).prop('value')); });
		$('#'+xid).on('mouseup',function() { f.setColor($('#'+xid).prop('value')); });
	});
}
function setCol(){; }

/*
 * JavaScript Debug - v0.4 - 6/22/2010
 * http://benalman.com/projects/javascript-debug-console-log/
 * 
 * Copyright (c) 2010 "Cowboy" Ben Alman
 * Dual licensed under the MIT and GPL licenses.
 * http://benalman.com/about/license/
 * 
 * With lots of help from Paul Irish!
 * http://paulirish.com/
 */
window.debug=(function(){var i=this,b=Array.prototype.slice,d=i.console,h={},f,g,m=9,c=["error","warn","info","debug","log"],l="assert clear count dir dirxml exception group groupCollapsed groupEnd profile profileEnd table time timeEnd trace".split(" "),j=l.length,a=[];while(--j>=0){(function(n){h[n]=function(){m!==0&&d&&d[n]&&d[n].apply(d,arguments)}})(l[j])}j=c.length;while(--j>=0){(function(n,o){h[o]=function(){var q=b.call(arguments),p=[o].concat(q);a.push(p);e(p);if(!d||!k(n)){return}d.firebug?d[o].apply(i,q):d[o]?d[o](q):d.log(q)}})(j,c[j])}function e(n){if(f&&(g||!d||!d.log)){f.apply(i,n)}}h.setLevel=function(n){m=typeof n==="number"?n:9};function k(n){return m>0?m>n:c.length+m<=n}h.setCallback=function(){var o=b.call(arguments),n=a.length,p=n;f=o.shift()||null;g=typeof o[0]==="boolean"?o.shift():false;p-=typeof o[0]==="number"?o.shift():n;while(p<n){e(a[p++])}};return h})();