$(document).ajaxStart(function () {
	Pace.restart()
});

const URL = 'http://localhost/latihan/';

// XMLHttpRequest
function getXMLHttp()
{
	var xmlHttp
	try
	{
		//Firefox, Opera 8.0+, Safari
		xmlHttp = new XMLHttpRequest();
	}
	catch(e){
		//Internet Explorer
		try
		{
			xmlHttp = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e){
			try
			{
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				alert("Your browser does not support AJAX!")
				return false;
			}
		}
	}
	return xmlHttp;
}

// NUMERIC and PROSENTASE
function formatKoma(x) {
    x = x.toString();
    var pattern = /(-?\d+)(\d{3})/;
    while (pattern.test(x))
        x = x.replace(pattern, "$1,$2");
    return x;
}
function formatAngka(value) {
	a = value;
	if(a == undefined) return false;
	x = a.toString().split(".");
	b = x[0].replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<>?|`?\]\[]/g,'');
	c = "";

	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
			c = b.substr(i-1,1) + "," + c;
		} else {
			c = b.substr(i-1,1) + c;
		}
	}
	if(x[1] == undefined){
		return c;
	}else{
		return c + "." + x[1].substr(0,2);
	}
}

function formatDecimal(value) {
	a = value;
	x = a.split(".");
	b = x[0].replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<>?|`?\]\[]/g,'');
	c = "";

	panjang = b.length;
	j = 0;
	for (i = panjang; i > 0; i--) {
		j = j + 1;
		if (((j % 3) == 1) && (j != 1)) {
			c = b.substr(i-1,1) + "," + c;
		} else {
			c = b.substr(i-1,1) + c;
		}
	}

	if(x.length == 1){
		return c;
	}else{
		return c + "." + x[1].substr(0,2);
	}

}

function formatNumber(num) {
	if(num < 1) return 0;
	num = num.toString().replace(/\$|\,/g,'');
	if(isNaN(num))
		num = "0";
	sign = (num == (num = Math.abs(num)));
	num = Math.round(num*100+0.50000000001);
	cents = num%100;
	num = Math.round(num/100).toString();
	if(cents<10)
		cents = "0" + cents;

	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));

	return (((sign)?'':'-') + num);
}

function formatCurrency(val) {

	x = val.split(".");
	num = x[0];
	num = num.toString().replace(/\$|\,/g,'');
	
	sign = (num == (num = Math.abs(num)));
	num = Math.floor(num*100+0.50000000001);
	cents = num%100;
	num = Math.floor(num/100).toString();
	if(cents<10)
		cents = "0" + cents;
	for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
		num = num.substring(0,num.length-(4*i+3))+','+
	num.substring(num.length-(4*i+3));

	if(x.length == 1)
		return (((sign)?'':'-') + num);
	else
		return (((sign)?'':'-') + num + "." + x[1].substr(0,16));
}

function replaceAll(Source,stringToFind,stringToReplace){
	var temp = Source;
	if(temp == undefined) return false;
	var index = temp.indexOf(stringToFind);
	while(index != -1){
		temp = temp.replace(stringToFind,stringToReplace);
		index = temp.indexOf(stringToFind);
	}
	return temp;
}

function convert(val){
	return nilai = replaceAll(val,",","");
}

function setAngka(elem){
	replace = formatCurrency(elem.value);
	if(replace.length == 0) replace = 0;
	elem.value = replace;
}

function cekAngka(elem){
	replace = formatAngka(elem.value.replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<>?|`?\]\[]/g,'')).replace(/^(0*)/,"");
	if(replace.length == 0) replace = 0;
	elem.value = replace;
}

function cekPersen(elem){
	replace = formatCurrency(elem.value.replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<>?|`?\]\[]/g,''));
	if(replace.length == 0) replace = 0;	
	elem.value = replace;
	
	if(convert(elem.value) * 1 > 100) elem.value = 100;
}

function cekNumber(elem){	
	replace = formatCurrency(elem.value.replace(/[\\A-Za-z!"?$%^&*+_={}; ()\-\:'/@#~,?\<>?|`?\]\[]/g,''));
	if(replace.length == 0) replace = 0;
	elem.value = replace;
}

function toDate(string){
	dData = string.split(" ");	
	tData = dData[0].split("-");	
	wData = dData[1].split(":");
	return new Date(tData[0], tData[1]-1, tData[2], wData[0], wData[1], wData[2]);	
}

// Y-m-d to d/m/Y
function to_date(string){
	tData = string.split("-");
	return tData[2]+"/"+tData[1]+"/"+tData[0];	
}

function difWaktu(startDate, endDate)
{
	var result="";
	var difMs = (endDate - startDate);
	var difDays = Math.floor(difMs / 86400000);
	var difHrs = Math.floor((difMs % 86400000) / 3600000);
	var difMins = Math.floor(((difMs % 86400000) % 3600000) / 60000);
	var difSecs = Math.floor(((difMs % 86400000) % 3600000 % 60000) / 1000);
	
	if(difSecs * 1 < 0){
		return result;
	}
	
	difHrs = difHrs < 10 ? "0" + difHrs : difHrs;
	difMins = difMins < 10 ? "0" + difMins : difMins;
	difSecs = difSecs < 10 ? "0" + difSecs : difSecs;
	
	if(difDays * 1 > 0){
		result = difDays + " Hari, " + difHrs + " Jam";
	}else if(difHrs * 1 > 0){
		result = difHrs + " Jam, " + difMins + " Menit";
	}else{
		result = difMins + " : " + difSecs;
	}
	
	return result;
}

function difWaktu2(statusData, startDate, endDate)
{
	var result = "";
	var difMs = (endDate - startDate);
	var difDays = Math.floor(difMs / 86400000);
	var difHrs = Math.floor((difMs % 86400000) / 3600000);
	var difMins = Math.floor(((difMs % 86400000) % 3600000) / 60000);
	var difSecs = Math.floor(((difMs % 86400000) % 3600000 % 60000) / 1000);
	
	
	if(statusData!="t" && statusData!="a" && statusData!="x" && difSecs * 1 < 0){
		return result;
	}
	
	
	difHrs = difHrs < 10 ? "0" + difHrs : difHrs;
	difMins = difMins < 10 ? "0" + difMins : difMins;
	difSecs = difSecs < 10 ? "0" + difSecs : difSecs;		
		
	if(difDays * 1 > 0){
		result = difDays + " Hari, " + difHrs + " Jam";
	}else if(difHrs * 1 > 0){
		result = difHrs + " Jam, " + difMins + " Menit";
	}else{
		result = difMins + " : " + difSecs;
	}
		
	return result;
}

function dateAdd(strDate,intNum){
	if(!intNum) intNum = 0;
	arr = strDate.split("/");
	dateStr = arr[1] + "/" + arr[0] + "/" + arr[2] ;
	sdate =  new Date(dateStr);
	sdate.setDate(sdate.getDate() + intNum * 1);
	rd = sdate.getDate() < 10 ? "0" + sdate.getDate() : sdate.getDate();
	rm = (sdate.getMonth()+1) < 10 ? "0" + (sdate.getMonth()+1) : (sdate.getMonth()+1);
	return rd+"/"+rm+"/"+sdate.getFullYear();
}

function monthAdd(strDate,intNum){
	if(!intNum) intNum = 0;
	arr = strDate.split("/");
	dateStr = arr[1] + "/" + arr[0] + "/" + arr[2] ;
	sdate =  new Date(dateStr);
	sdate.setMonth(sdate.getMonth() + intNum * 1);
	rd = sdate.getDate() < 10 ? "0" + sdate.getDate() : sdate.getDate();
	rm = (sdate.getMonth()+1) < 10 ? "0" + (sdate.getMonth()+1) : (sdate.getMonth()+1);
	return rd+"/"+rm+"/"+sdate.getFullYear();
}

function getFilesize(bytes, si=true, dp=1) {
	const thresh = si ? 1000 : 1024;

	if (Math.abs(bytes) < thresh) {
		return bytes + ' B';
	}

  const units = si 
    ? ['kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'] 
    : ['KiB', 'MiB', 'GiB', 'TiB', 'PiB', 'EiB', 'ZiB', 'YiB'];
	let u = -1;
	const r = 10**dp;

	do {
		bytes /= thresh;
		++u;
	} while (Math.round(Math.abs(bytes) * r) / r >= thresh && u < units.length - 1);


	return bytes.toFixed(dp) + ' ' + units[u];
}

// FUNC DELETE DATA
function Delete(func, data, id){
	var confm = confirm("Hapus data ini?");
	if(confm){
		$.ajax({
			url: $('#base_url').val()+""+func+"/"+id,
			type: "POST",
			cache: false,
			success: function(html){
				if($.trim(html) == 'OK'){
					if(data == 'REFRESH')
					{
						document.location.reload();
					}
					else if(data == 'LOAD')
					{
						$(".the_box").load($('#base_url').val()+"akomodasi/box");
					}
					else{
						$("#"+data).DataTable().ajax.reload(null, false);
					}
					alertPopup('<div class="alert alert-success" role="alert">' + isMsg + '</div>');
				}
				else{
					alertPopup('<div class="alert alert-danger" role="alert">' + $.trim(html) + '</div>', 'Warning');
				}
			},
			error:function(xhr, status, error){
				alert(error);
			}
		});
	}
}

function Delete2(func, data, id, qstn = null)
{
	var isQstn = (qstn) ? qstn : 'Hapus data ini?';
	var confm = confirm(isQstn);
	if(confm){
		$.ajax({
			url: $('#base_url').val() + func + "/" + id,
			type: "POST",
			cache: false,
			success: function(html){
				var json = JSON.parse(html);
				if(json.success == true){
					if(data == 'REFRESH')
					{
						document.location.reload();
					}
					else{
						$("#"+data).DataTable().ajax.reload(null, false);
					}
					toastr.success(json.message, 'Success');
				}
				else{
					toastr.error(json.message, 'Warning');
				}
			},
			error:function(xhr, status, error){
				toastr.error(json.message, 'Danger');
			}
		});
	}
}

// FUNC UPDATE DATA
function Update(func, data, id, qstn = null, msg = null)
{
	var isQstn = (qstn) ? qstn : 'Update data ini?';
	var confm = confirm(isQstn);
	if(confm){
		$.ajax({
			url: $('#base_url').val()+""+func+"/"+id,
			type: "POST",
			cache: false,
			success: function(html){
				if($.trim(html) == 'OK')
				{
					if(data == 'reloadDetail_approval')
					{
						$("#contentDetail").load($('#base_url').val()+"approval/detail/index/"+location.hash.replace('#',''));
					}
					else{
						$("#"+data).DataTable().ajax.reload(null, false);
						parent.$("#"+data).DataTable().ajax.reload(null, false);
					}
					var isMsg = (msg) ? msg : 'Data berhasil di update!!';
					alertPopup('<div class="alert alert-success" role="alert">' + isMsg + '</div>');
				}
				else{
					if(data == 'reloadDetail_approval')
					{
						window.location.replace($('#base_url').val()+"approval");
					}
					else{
						alertPopup('<div class="alert alert-danger" role="alert">' + $.trim(html) + '</div>', 'Warning');
					}
				}
			},
			error:function(xhr, status, error){
				alert(error);
			}
		});
	}
}

// POPUP iFrame
function iframePopup(title, url)
{
	var option = {
		size: eModal.size.lg,
		title: title,
		url: url
	};

	return eModal.iframe(option);
}

function iframePopup_xl(title, url)
{
	var option = {
		size: eModal.size.xl,
		title: title,
		url: url
	};

	return eModal.iframe(option);
}

function alertPopup(message, title = 'Info')
{
	var option = {
		message: message,
		title: title,
		size: 'sm',
		useBin: true
	};

	return eModal.alert(option);
}

// ENCODE BASE 64
/*
var decodedStringBtoA = 'Hello World!';
var encodedStringBtoA = btoa(decodedStringBtoA);
console.log(encodedStringBtoA);
Output	SGVsbG8gV29ybGQh

var encodedStringAtoB = 'SGVsbG8gV29ybGQh';
var decodedStringAtoB = atob(encodedStringAtoB);
console.log(decodedStringAtoB);
Output	Hello World!
*/
var keyStr = "ABCDEFGHIJKLMNOP" +
		"QRSTUVWXYZabcdef" +
		"ghijklmnopqrstuv" +
		"wxyz0123456789+/" +
		"=";
function encode(input)
{
	input = escape(input);
	var output = "";
	var chr1, chr2, chr3 = "";
	var enc1, enc2, enc3, enc4 = "";
	var i = 0;

	do {
		chr1 = input.charCodeAt(i++);
		chr2 = input.charCodeAt(i++);
		chr3 = input.charCodeAt(i++);

		enc1 = chr1 >> 2;
		enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
		enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
		enc4 = chr3 & 63;

		if (isNaN(chr2)) {
			enc3 = enc4 = 64;
		} else if (isNaN(chr3)) {
			enc4 = 64;
		}

        output = output +
           keyStr.charAt(enc1) +
           keyStr.charAt(enc2) +
           keyStr.charAt(enc3) +
           keyStr.charAt(enc4);
        chr1 = chr2 = chr3 = "";
        enc1 = enc2 = enc3 = enc4 = "";
	} while (i < input.length);

	return output;
}

function deCharset(input, charset)
{
	if (charset != 'UTF-8') {
		return input;
	}
	var output = [];
	for (var i = 0; i < input.length; i++) {
		var c = input.charCodeAt(i);
		if (c <= 0x7F) {
			output.push(input.substr(i, 1));
		} else if (0xC0 <= c && c <= 0xDF) {
			var c2 = input.charCodeAt(++i);
			if (0x80 <= c2 && c2 <= 0xBF) {
				var o = ((c & 0x1F) << 6) + (c2 & 0x3F);
				output.push(String.fromCharCode(o));
			} else {
				return 'invalid input';
			}
		} else if (0xE0 <= c && c <= 0xEF) {
			var c2 = input.charCodeAt(++i);
			var c3 = input.charCodeAt(++i);
			if (0x80 <= c2 && c2 <= 0xBF &&
				0x80 <= c3 && c3 <= 0xBF) {
				var o = ((c & 0xF) << 12) + ((c2 & 0x3F) << 6) + (c3 & 0x3F);
				output.push(String.fromCharCode(o));
			} else {
				return 'invalid input';
			}
		} else if (0xE0 <= c && c <= 0xEF) {
			var c2 = input.charCodeAt(++i);
			var c3 = input.charCodeAt(++i);
			var c4 = input.charCodeAt(++i);
			if (0x80 <= c2 && c2 <= 0xBF &&
				0x80 <= c3 && c3 <= 0xBF &&
				0x80 <= c4 && c4 <= 0xBF) {
				var o = ((c & 7) << 18) + ((c2 & 0x3F) << 12) + ((c2 & 0x3F) << 6) + (c4 & 0x3F);
				output.push(String.fromCharCode(o));
			} else {
				return 'invalid input';
			}
		} else {
			return 'invalid input';
		}
	}
	return output.join('');
}

// DECODE BASE 64
function decode(input)
{
	var equalCount = input.length - input.search(/={0,2}$/);
	input = input.replace(/(\s|={1,2}$)/g, '');
	var iterations = Math.floor(input.length * 3 / 4);
	var output = new Array(iterations);
	input += '\0';
	var j = 2, d = '', p = 0, k = 0, error = false;
	for (var i = 0; i < iterations; i++) {
		var b1 = keyStr.indexOf(input.charAt(p)) << j;
		var b2 = keyStr.indexOf(input.charAt(p + 1)) >> (6 - j);
		if (b1 == -1 || b2 == -1) {
		  error = 'invalid input at character ' + (b1 == -1 ? p : p + 1);
		}
		output[k++] = String.fromCharCode((b1 + b2) & 0xFF);
		j = j % 6 + 2;
		p += (j == 2 ? 2 : 1);
	}
	// Look for trailing non-zero bits.
	if (!error && p < input.length - 1 && (keyStr.indexOf(input.charAt(p)) << j) & 0xFF) {
	  error = 'invalid input (trailing non-zero bits)';
	}
	var expectedEqualCount = (3 - (iterations % 3)) % 3;
	if (!error & equalCount != expectedEqualCount) {
		error = 'invalid input (' + (expectedEqualCount == 0 ? 'no' : expectedEqualCount) + ' trailing "=" expected)';
	}
	if (error) {
	  output[k++] = '\n' + error;
	}
	return deCharset(output.join(''), 'UTF-8');
}

/*function decode(input)
{
	var output = "";
	var chr1, chr2, chr3 = "";
	var enc1, enc2, enc3, enc4 = "";
	var i = 0;

	// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
	var base64test = /[^A-Za-z0-9\+\/\=]/g;
	if (base64test.exec(input)) {
        alert("There were invalid base64 characters in the input text.\n" +
              "Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
              "Expect errors in decoding.");
	}
	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	do {
		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output = output + String.fromCharCode(chr1);

		if (enc3 != 64) {
			output = output + String.fromCharCode(chr2);
		}
		if (enc4 != 64) {
			output = output + String.fromCharCode(chr3);
		}

		chr1 = chr2 = chr3 = "";
		enc1 = enc2 = enc3 = enc4 = "";

	}
	while (i < input.length);

	return unescape(output);
}*/

// TERBILANG
function terbilang(bilangan)
{

	bilangan    = String(bilangan);
	var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
	var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
	var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

	var panjang_bilangan = bilangan.length;

	/* pengujian panjang bilangan */
	if (panjang_bilangan > 15)
	{
		kaLimat = "Diluar Batas";
		return kaLimat;
	}

	/* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
	for (i = 1; i <= panjang_bilangan; i++)
	{
		angka[i] = bilangan.substr(-(i),1);
	}

	i = 1;
	j = 0;
	kaLimat = "";

	/* mulai proses iterasi terhadap array angka */
	while (i <= panjang_bilangan)
	{
		subkaLimat = "";
		kata1 = "";
		kata2 = "";
		kata3 = "";

		/* untuk Ratusan */
		if (angka[i+2] != "0")
		{
			if (angka[i+2] == "1")
			{
				kata1 = "Seratus";
			}
			else {
				kata1 = kata[angka[i+2]] + " Ratus";
			}
		}

		/* untuk Puluhan atau Belasan */
		if (angka[i+1] != "0")
		{
			if (angka[i+1] == "1")
			{
				if (angka[i] == "0")
				{
					kata2 = "Sepuluh";
				}
				else if (angka[i] == "1"){
					kata2 = "Sebelas";
				}
				else {
					kata2 = kata[angka[i]] + " Belas";
				}
			}
			else {
				kata2 = kata[angka[i+1]] + " Puluh";
			}
		}

		/* untuk Satuan */
		if (angka[i] != "0")
		{
			if (angka[i+1] != "1")
			{
				kata3 = kata[angka[i]];
			}
		}

		/* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
		if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0"))
		{
			subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
		}
		/* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
		kaLimat = subkaLimat + kaLimat;
		i = i + 3;
		j = j + 1;
	}

	/* mengganti Satu Ribu jadi Seribu jika diperlukan */
	if ((angka[5] == "0") && (angka[6] == "0"))
	{
		kaLimat = kaLimat.replace("Satu Ribu","Seribu");
	}

	return kaLimat + "Rupiah";
}

// export
function doExport(selector, params)
{
	var options = {
		//ignoreRow: [1,11,12,-2],
		//ignoreColumn: [0,-1],
		//pdfmake: {enabled: true},
		tableName: 'Report'
	};

	$.extend(true, options, params);
	$(selector).tableExport(options);
}

function DoOnMsoNumberFormat(cell, row, col)
{
	var result = "";
	if (row > 0 && col == 0)
		result = "\\@";
	return result;
}

function ValidateEmail(inputText)
{
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(inputText.match(mailformat))
	{
		return true;
	}
	else
	{
		return false;
	}
}
	
$(function () {
    'use strict'

    /**
     * Get access to plugins
     */
	toastr.options = {
	  "closeButton": false,
	  "debug": false,
	  "newestOnTop": true,
	  "progressBar": true,
	  "positionClass": "toast-top-right",
	  "preventDuplicates": false,
	  "onclick": null,
	  "showDuration": "300",
	  "hideDuration": "300",
	  "timeOut": "3000",
	  "extendedTimeOut": "1000",
	  "showEasing": "swing",
	  "hideEasing": "linear",
	  "showMethod": "fadeIn",
	  "hideMethod": "fadeOut"
	}
	
	$('.select2').select2();
	
	$('.select2nosearch').select2({
		minimumResultsForSearch: -1
	});
	
	$('#datepicker').datepicker({
		autoHide: true,
		format: 'dd/mm/yyyy'
	});
	
	$('.datepicker').datepicker({
		autoHide: true,
		format: 'dd/mm/yyyy'
	});
	
	$('.yearpicker').datepicker({
		autoHide: true,
		startView: 2,
		format: 'yyyy'
	});
	
	$('[data-toggle="control-sidebar"]').controlSidebar()
    $('[data-toggle="push-menu"]').pushMenu()
    var $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
    var $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
    $(window).on('load', function() {
        // Reinitialize variables on load
        $pushMenu = $('[data-toggle="push-menu"]').data('lte.pushmenu')
        $controlSidebar = $('[data-toggle="control-sidebar"]').data('lte.controlsidebar')
    })
	
	
});
