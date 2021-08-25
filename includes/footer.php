<footer>
	<p style="text-align: center;">2021. All rights reserved.</p>
</footer>

<script src="/assets/js/jquery-3.3.1.min.js"></script>

<script>
	var mi = 0;
	$('label.hamburger').on('click', function(){
		mi++;
		if (mi % 2 == 1){
			$(this).attr('style', 'position:fixed');
		} else {
			$(this).attr('style', 'position:absolute');
		}
	});

	Date.prototype.customFormat = function(formatString){
		var YYYY,YY,MMMM,MMM,MM,M,DDDD,DDD,DD,D,hhhh,hhh,hh,h,mm,m,ss,s,ampm,AMPM,dMod,th;
		YY = ((YYYY=this.getFullYear())+"").slice(-2);
		MM = (M=this.getMonth()+1)<10?('0'+M):M;
		MMM = (MMMM=["January","February","March","April","May","June","July","August","September","October","November","December"][M-1]).substring(0,3);
		DD = (D=this.getDate())<10?('0'+D):D;
		DDD = (DDDD=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][this.getDay()]).substring(0,3);
		th=(D>=10&&D<=20)?'th':((dMod=D%10)==1)?'st':(dMod==2)?'nd':(dMod==3)?'rd':'th';
		formatString = formatString.replace("#YYYY#",YYYY).replace("#YY#",YY).replace("#MMMM#",MMMM).replace("#MMM#",MMM).replace("#MM#",MM).replace("#M#",M).replace("#DDDD#",DDDD).replace("#DDD#",DDD).replace("#DD#",DD).replace("#D#",D).replace("#th#",th);
		h=(hhh=this.getHours());
		if (h==0) h=24;
		if (h>12) h-=12;
		hh = h<10?('0'+h):h;
		hhhh = hhh<10?('0'+hhh):hhh;
		AMPM=(ampm=hhh<12?'am':'pm').toUpperCase();
		mm=(m=this.getMinutes())<10?('0'+m):m;
		ss=(s=this.getSeconds())<10?('0'+s):s;
		return formatString.replace("#hhhh#",hhhh).replace("#hhh#",hhh).replace("#hh#",hh).replace("#h#",h).replace("#mm#",mm).replace("#m#",m).replace("#ss#",ss).replace("#s#",s).replace("#ampm#",ampm).replace("#AMPM#",AMPM);
	};

	var scam_type, address, description, coin, json;

	$('#reportscam').on('submit', function(){
		coin = $(this).find('select[name="coin"]').val();
		scam_type = $(this).find('select#scam_type').val();
		address = $(this).find('input').val();
		description = $(this).find('textarea').val();

		if (scam_type == null){
			alert('Choose Scam Type');
		} else {
			$.ajax({
				type: 'POST',
				url: 'ajax.php',
				data: {
					action: 'reportscam',
					scam_type: scam_type,
					coin: coin,
					address: address,
					description: description
				},
				success: function(data){
					json = JSON.parse(data);
					if (json == true){
						$('#success').show(100);
						$('#reportscam form').hide(100);
					} else {
						$('#error').show (100);
					}
				}
			});
		}
	});

	function api_request(url, method){
		var xmlHttp = new XMLHttpRequest();
	    xmlHttp.open( method, url, false );
	    xmlHttp.send( null );
	    return xmlHttp.responseText;
	}

	var html;
	var newDate = new Date();
	var current_time = newDate.getTime() / 1000;
	var address_info, received_usd, active_since;

	if (page == 'main'){
		$(document).ready(function(){
			for (var i = 0; i < 10; i++){
				address_info = api_request('https://api.blockchair.com/bitcoin/dashboards/address/'+reports_list[i].address, 'GET');
				var date = Date.parse(reports_list[i].reported_at) / 1000, latest_m = parseInt((current_time - date) % 3600 / 60), latest_h = parseInt((current_time - date) % 86400 / 3600 + (current_time - date) / 3600);
				address_info = JSON.parse(address_info);
				received_usd = parseInt(address_info.data[reports_list[i].address].address.received_usd);
				html += '<tr class="tabletext"><td style="padding-bottom:12px;"><a href="/scam/?s='+reports_list[i].address+'">'+reports_list[i].address.substring(0, 10)+'...</a><br><span style="font-size:14px;">'+latest_h.toString()+' hours ago</span></td><td class="center">$'+received_usd.toString()+'</td><td class="latest-transaction-value">'+reports_list[i].count.toString()+'</td></tr>';
			}

			$('#latesttransactions tbody').html(html);
		});
	} else if (page == 'scam_page'){
		//a.recent[0].description
		address_info = JSON.parse(api_request('https://api.blockchair.com/bitcoin/dashboards/address/'+address, 'GET'));
		received_usd = parseInt(address_info.data[address].address.received_usd);
		$('#received_usd').text(received_usd.toString() + '$');

		var df_json = new Date(Date.parse(address_info.data[address].address.first_seen_receiving));
		active_since = df_json.customFormat('#YYYY#-#MMMM#-#DD# | #h#:#mm#:#ss# #AMPM#');
		$('#active_since').text(active_since.toString());
		$('#transaction_count').text(address_info.data[address].address.transaction_count.toString());

		//var btc_abuse = JSON.parse(api_request('https://www.bitcoinabuse.com/api/reports/check?address='+address+'&api_token=xvmxfnJtIWZXKPRUyP9jgZRxKjU4ewrvzm8JTWmpnmX08m2yMjpzRHatZ86u', 'GET'));

		if (report.recent['length'] > 0){
			var description = report.recent[0].description;
			$('#description').text(description);
		}
	}

	$(function() {
		var Accordion = function(el, multiple) {
				this.el = el || {};
				this.multiple = multiple || false;

				var links = this.el.find('.article-title');
				links.on('click', {
						el: this.el,
						multiple: this.multiple
				}, this.dropdown)
		}

		Accordion.prototype.dropdown = function(e) {
				var $el = e.data.el;
				$this = $(this),
						$next = $this.next();

				$next.slideToggle();
				$this.parent().toggleClass('open');

				if (!e.data.multiple) {
						$el.find('.accordion-content').not($next).slideUp().parent().removeClass('open');
				};
		}
		var accordion = new Accordion($('.accordion-container'), false);
	});
</script>