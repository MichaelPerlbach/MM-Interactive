/* © MikelMade 2015 (http://www.mikelmade.de) */
$(document).ready(function() {
	initializepages();
	$('#struktseiten,#pageeditrowswrap,#dleditrowswrap').niceScroll();
	$('#addkunde').off().on('click', function() { addcustomer(); });
	$('#addvorlage').on('click', function() { newvorlage(); });
	$('#savevorlage').on('click', function() {
		if (!$(this).hasClass('new')) { savevorlage(); }
		else { addvorlage();}
	});
	$('#delvorlage').on('click', function() { delvorlage(); });
		$('#customers').off().on('change', function() { loadcustomer($(this).val()); });
		$('#layouts').off().on('change', function() {
			if ($(this).val() != 0) { loadlayout($(this).val()); }
		});
		$('#savekundename').on('click', function() { savekundename(); });
		$('#logonarrow').on('click', function() {
			var _c = 0;
			if ($(this).prop('checked') == true) { _c = 1; }
			savelogonarrow(_c);
		});
		//setNewloader();
		//setUploader();
		
		$('#seitenstrukturtab').on('click', function() {
			if ($(this).hasClass('edittab_inactive')) {alert("test");
				$(this).removeClass('edittab_inactive').addClass('edittab');
				$('#basisdatentab').removeClass('edittab').addClass('edittab_inactive');
				$('#basisdatenwrap').hide();
				$('#seitenstrukturwrap').show();
			}
		});
		$('#basisdatentab').on('click', function() {
			if ($(this).hasClass('edittab_inactive')) {
				$(this).removeClass('edittab_inactive').addClass('edittab');
				$('#seitenstrukturtab').removeClass('edittab').addClass('edittab_inactive');
				$('#basisdatenwrap').show();
				$('#seitenstrukturwrap').hide();
			}
		});
		
	$('#strukturbearbeiten').on('click',function(){ editstructure(); });
	initializepageedit();
	initializedledit();
});

//#####################
// initializepageedit
//#####################
function initializepageedit(){
	$('#pageeditrows').dragsort({dragEnd: savePageOrder,dragSelector:'.pagemove',placeHolderTemplate: "<div style=\"width:200px;height:20px;border:1px dashed red;\"></div>"});
	
	$('.pageedit').off().on('click',function(){
		var _id = $(this).prop('id').replace('editpage_','');
		opensinglepageedit(_id);
	});
	
	// Sorting of the page icons - not needed in this context
	//$('#struktseiten').dragsort({dragEnd: savePageOrder2,dragSelector:'.pagewrap',placeHolderTemplate: "<div style=\"width:163px;height:236px;float:left;border:1px dashed red;margin-right:15px;margin-bottom:15px;\"></div>"});
	
	$('.pagehead').on('click',function(){
		var _id = $(this).parent().parent().prop('id').replace('p','');
		openDownloads(_id);
	});
}

//#####################
// initializedledit
//#####################
function initializedledit(){
	$('#dleditrows').dragsort({dragEnd: saveDlOrder,dragSelector:'.dlmove',placeHolderTemplate: "<div style=\"width:200px;height:20px;border:1px dashed red;\"></div>"});
	
	$('.pageedit').off().on('click',function(){
		var _id = $(this).prop('id').replace('editpage_','');
		opensinglepageedit(_id);
	});
	//$('#struktseiten').dragsort({dragEnd: savePageOrder2,dragSelector:'.pagewrap',placeHolderTemplate: "<div style=\"width:163px;height:236px;float:left;border:1px dashed red;margin-right:15px;margin-bottom:15px;\"></div>"});
	$('.pagehead').on('click',function(){
		var _id = $(this).parent().parent().prop('id').replace('p','');
		openDownloads(_id);
	});
}

//#####################
// openDownloads
//#####################
function openDownloads(_id){
	setedit('pagedownloads');
	modaleditwindow({innerwidth:638,innerheight:506});
	modalwindow({ loader: true, text: 'Lade Daten...',attachTo:'editmodalouter' });
}

//#####################
// savePageOrder
//#####################
function savePageOrder(){
	var _items = $('.pageeditentry');
	var _itemarr = new Array();
	for(i=0;i<_items.length;i++){
		var _itemid = $(_items[i]).prop('id').replace('pageeditentry','');
		_itemarr.push(new Array((i+1),_itemid));
	}
}

//#####################
// saveDlOrder
//#####################
function saveDlOrder(){
	var _items = $('.dleditentry');
	var _itemarr = new Array();
	for(i=0;i<_items.length;i++){
		var _itemid = $(_items[i]).prop('id').replace('dleditentry','');
		_itemarr.push(new Array((i+1),_itemid));
	}
}

//#####################
// opensinglepageedit
//#####################
function opensinglepageedit(_id){
	$('#singlepageedit,#pageeditcover').show();
	$('.pageeditentry').removeClass('edited');
	$('#pageeditentry'+_id).addClass('edited');
}


//#####################
// closesinglepageedit
//#####################
function closesinglepageedit(){
	$('.pageeditentry').removeClass('edited');
	$('#singlepageedit,#pageeditcover').hide();
}

//#####################
// initializepages
//#####################
var _actpage = 0;
function initializepages(){
	$('.page').on('mouseover',function(){
		$('.page').removeClass('pagewrap_over');
		var _pos = $(this).position();
		var _id = $(this).prop('id').replace('p','');
		_actpage = _id
		$('#editpage').css({
			top:(_pos.top+158)+'px',
			left:(_pos.left+30)+'px'
		});
		$('#pagename').text($('#pp'+_id).text());
		$('#editpage').show();
	});

	$('#struktseiten').off().on('mouseover',function(e){
		if($(e.target).prop('id') == 'struktseiten'){ $('#editpage').hide(); }
	});
	$('#editpage').off().on('mouseover',function(){ $('#p'+_actpage).addClass('pagewrap_over'); });
	$('#editpagewrap').off().on('mouseout',function(){ $('.page').removeClass('pagewrap_over'); });
}

//###################
// editstructure
//###################
function editstructure() {
	setedit('pagestructure');
	modaleditwindow({innerwidth:838,innerheight:606});
}

//###################
// setUploader
//###################
var _uploader = {};

function setUploader() {
	var sizeBox = document.getElementById('sizeBox'), // container for file size info
	progress = document.getElementById('progressbar'); // the element we're using for a progress bar
	var _elm = 'savelogo';
	_uploader = new ss.SimpleUpload({
		button: _elm, // file upload button
		url: '../typo3conf/ext/quickhtml/Contrib/simpleAjaxUploader/uploadhandler.php', // server side handler
		name: 'uploadfile', // upload parameter name
		progressUrl: '../typo3conf/ext/quickhtml/Contrib/simpleAjaxUploader/uploadProgress.php', // enables cross-browser progress support (more info below)
		responseType: 'json',
		allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
		maxSize: 100024, // kilobytes
		hoverClass: '',
		focusClass: 'ui-state-focus',
		disabledClass: 'ui-state-disabled',
		onSubmit: function(filename, extension) {
			modalwindow({ closable: false, loader: false, innerwidth: 420, innerheight: 70, text: 'Bild wird hochgeladen...' });
			$('#uploadwrap,#sizebox,#progress').show();
			this.setFileSizeBox(sizeBox); // designate this element as file size container
			this.setProgressBar(progress); // designate as progress bar
		},
		onComplete: function(filename, response) {
			if (!response) {
				modalwindow({ closable: true, loader: false, innerwidth: 340, innerheight: 40, text: 'Upload ist schiefgelaufen.' });
				return false;
			}
			else {
				$('#logofile').prop('value', filename);
				modalclose();
				savecustomerlogo(filename);
			}
		}
	});
}