<?php
	require 'config.php';
	require 'includes/simple_html_dom.php';

	$url = 'https://www.bitcoinabuse.com/api/reports/distinct?api_token=xvmxfnJtIWZXKPRUyP9jgZRxKjU4ewrvzm8JTWmpnmX08m2yMjpzRHatZ86u';

	$context = stream_context_create();
	stream_context_set_params($context, array('User-Agent' => 'google'));

	$reports = json_decode(file_get_html($url, 0, $context));
	$asd = json_encode($reports->data);
/*
	$html = '';
	$count = 0;

	foreach ($asd as $latest) {
		$count++;

		$rawaddr_json = file_get_html('https://api.blockchair.com/bitcoin/dashboards/address/' . $latest->address);
		$rawaddr = json_decode($rawaddr_json, true);
    
    $total = $rawaddr['data']['1NquWJMUr4KxfcWxMpPmwcqMQfT3aPX7Ep']['address']['received_usd'];

		$a = date_parse(date('y-m-d h:m:s'));
    $b = date_parse($latest->reported_at);
    $s1 = $a['minute'] * 60 + $a['hour'] * 3600 + $a['second'];
    $s2 = $b['minute'] * 60 + $b['hour'] * 3600 + $b['second'];
    $s3 = $s1 - $s2;
    $hago = intval($s3 / 3600);
    if ($hago < 0){
    	$hago = 24 + $hago;
    }

    $address_sm = substr($latest->address, 0, 12) . '...' . substr($latest->address, 22, strlen($latest->address));
    $address_xs = substr($latest->address, 0, 5) . '...' . substr($latest->address, 29, strlen($latest->address));

		$html .= '<tr class="tabletext"><td><span class="d-none d-md-block">'.$latest->address.'</span><span class="d-none d-sm-block d-md-none">'.$address_sm.'</span><span class="d-sm-none">'.$address_xs.'</span><br>'.$hago.' hours ago</td><td>'.$total.'</td><td class="latest-transaction-value">'.$latest->count.'<br></td></tr>';
		if ($count == 10)break;
	}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php include 'includes/head.php'; ?>
	<style>
		@media (min-width: 720px){
			h1 {
				font-size: 3em !important;
			} h2 {
				font-size: 2.5em;
			} h3 {
				font-size: 1.5em;
			} .search-address-form {
				width: 50%;
				display: inline-block;
				text-align: center;
			}
		}

		#success {
			display: none;
			color: #1dd79b;
		}
	</style>
	<script>
		var reports_list = <?php echo $asd; ?>;
		var page = 'main';
	</script>
</head>
<body>
	<?php include 'includes/header.php'; ?>

	<main>
		<section>
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h1 style="font-size: 2em;">This is SCAM<span style="color:#1dd79b;">ALERT</span></h1>
						<h3 class="justify">First line of defense in fighting cryptocurrency crime with live tracking of 84,115 scams</h3>
						<p class="justify">Our mission is to make blockchain safer to use for everyone by exposing scammers and other criminals who abuse it. Report scams, thefts and fraudulent websites involving any blockchain or cryptocurrency and help us fight crypto crime! Use our free address check to help protect yourself and others against scams.</p>
						<p style="color: #1dd79b;font-style: italic;font-size: 14px;">#BTC #ETH #LTC #ADA #DOGE #XRP #BCH #ZEC #XMR #EOS </p>
						<div style="text-align:center" class="mt-4 mb-4">
							<a href="#check" class="btn-f1">CHECK</a>
							<a href="#" class="btn-f2">TWITTER</a>
						</div>
					</div>
					<div class="col-md-6">
						<div class="box" id="reportscam">
							<h2 class="m-0" style="font-size: 2em;">Report Scam</h2>
							<p id="success">Thanks! We will publish your request after check.</p>
							<form onsubmit="return false;">
								<select name="scam-type" id="scam_type" title="Select a Scam" tabindex="-98" required="">
									<option value="" selected="" disabled="">Select a Scam</option>
									<optgroup label="Blackmail">
										<option value="sextortion">Sextortion</option>
										<option value="ransomware">Ransomware</option>
									</optgroup>
									<optgroup label="Fraud">
										<option value="giveaway">Fake Giveaway (Doubler)</option>
										<option value="ponzi">Ponzi Scheme</option>
										<option value="investment">Fake Investment / Fake Miner</option>
										<option value="ico">Fake ICO (Token Sale)</option>
										<option value="charity">Fake Charity</option>
										<option value="exchange">Fake Exchange</option>
									</optgroup>
									<optgroup label="Tech">
										<option value="wallet">Fake Wallet Generator</option>
										<option value="malware">Malware (Virus)</option>
									</optgroup>
									<optgroup label="Other">
										<option value="shop">Illegal Shop (Dark Web / Fake)</option>
										<option value="tumbler">Tumbler / Mixer</option>
										<option value="theft">Stolen Crypto</option>
										<option value="other">Other</option>
									</optgroup>
								</select>
								<select name="coin" id="">
									<option value="BTC">BTC</option>
									<option value="ETH">ETH</option>
									<option value="LTC">LTC</option>
									<option value="ADA">ADA</option>
									<option value="DOGE">DOGE</option>
									<option value="XRP">XRP</option>
									<option value="BCH">BCH</option>
									<option value="ZEC">ZEC</option>
									<option value="XMR">XMR</option>
									<option value="EOS">EOS</option>
								</select>
								<input type="text" name="address" placeholder="1PRugWeVRR7aAuSJJVit2mp2gb4HqCCbMn" required="">
								<textarea name="description" id="" cols="30" rows="13" placeholder="IMPORTANT

provide as many details as possible for example:

SCAM DESCRIPTION
WEBSITE URL
COMPANY NAME
STOLEN AMOUNT
TRANSACTION HASH
SCAMMER CONTACT DETAILS

If you were scammed, please also provide information on where you bought or transferred the cryptocurrency from."></textarea>
								<div class="row">
									<div class="col-md-6">
										<button type="submit">Send Report</button>
									</div>
									<div class="col-md-6" style="text-align:center;">
										<a href="#" style="line-height: 40px;">Privacy Policy</a>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>

		<section class="pt-5 mt-5">
			<div class="container" style="text-align:center">
				<div class="box" id="check">
					<h2>Check Address</h2>
					<p>Not sure if the address you are about to send money to is safe or if the website you visited is real or a scam? <br>Use our free check to see if the <span style="color: #1dd79b;">PAYMENT ADDRESS</span> or <span style="color: #1dd79b;">WEBSITE</span> has been reported.</p>
					<form action="/scam/" method="GET">
						<input type="text" name="s" placeholder="Paste Address Here" class="search-address-form" required="">
					</form>
				</div>
			</div>
		</section>

		<section id="latestreports">
			<div class="container pt-5">
				<h2 style="text-align: center;">Latest Reports</h2>
				<p style="text-align:center;">The latest Scam Reports made by victims to known and suspected scams.</p>
				<div class="row">
					<div class="col-md-8 offset-md-2">
						<table id="latesttransactions" width="100%">
							<thead>
								<tr>
									<td>Address</td>
									<td class="center">Earnings</td>
									<td class="latest-transaction-value">Reports</td>
								</tr>
							</thead>
							<tbody><?php echo $html; ?></tbody>
							</table>
					</div>
				</div>
			</div>
		</section>
		<section id="how">
			<div class="container">
				<div class="page-header text-center">
					<h2>Common Scams</h2>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1 offset-sm-0">
						<img class="img-responsive center-block" src="images/sextortion.png" alt="Sextortion">
						<div class="blog-content text-justify" style="padding-top:20px;">
							<h3 class="text-center">Sextortion</h3>
							<p class="crime-type">FELONY</p>
							<p>A popular blackmail scam in which victims receive an e-mail stating
							that their webcam was hacked and used to record them watching
							porn. They are told to make a payment or risk the
							video being released. Scammers risk a maximum prison sentence of <strong>15 years</strong> and a
							<strong>$10,000</strong> fine per sextortion e-mail in the US.</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1  offset-sm-0">
						<img class="img-responsive center-block" src="images/ransomware.png" alt="Ransomware">
						<div class="blog-content text-justify" style="padding-top:20px;">
							<h3 class="text-center">Ransomware</h3>
							<p class="crime-type">FELONY</p>
							<p>Through the use of malware, hackers have managed to lock and encrypt the victim's computer and demand
							a hefty ransom.
							People, companies and even universities have fallen victim to this dangerous scam. In the US,
							ransomware scams carry a penalty of up to <strong>10
							years</strong> in prison and a <strong>$10,000</strong> fine per attack.
							</p>
						</div>
					</div>
					<div class="clear-sides-sm"></div>
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1 offset-sm-0">
						<img class="img-responsive center-block" src="images/ponzi.png" alt="Ponzi Scheme">
						<div class="blog-content text-justify" style="padding-top:20px;">
							<h3 class="text-center">Ponzi Schemes</h3>
							<p class="crime-type">FELONY</p>
							<p>Scammers promise extremely high profits, but are secretive about their
							strategies. Victims are encouraged to find new investors to keep the illusion alive as long as
							possible. Operators can be charged with securities and commodities fraud in the US which carries a
							penalty of <strong>20 years to life</strong> in prison and a fine of up to <strong>$5 million</strong>.</p>
						</div>
					</div>
					<div class="clear-sides-md"></div>
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1 offset-sm-0">
						<img class="img-responsive center-block" src="images/fraud.png" alt="Fraud">
						<div class="blog-content  text-justify" style="padding-top:20px;">
							<h3 class="text-center">Giveaway</h3>
							<p class="crime-type">FELONY</p>
							<p>Scammers often pretend to be famous people and promise their victims free money if they send them
							some first, but of course nothing is ever sent back. Online fraud carries a maximum sentence of
							<strong>5 years</strong> in prison in the US for
							first time offenders.</p>
						</div>
					</div>
					<div class="clear-sides-sm"></div>
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1  offset-sm-0">
						<img class="img-responsive center-block" src="images/web.png" alt="Dark Web">
						<div class="blog-content text-justify" style="padding-top:20px;">
							<h3 class="text-center">Dark Web</h3>
							<p class="crime-type">FELONY</p>
							<p>A hidden part of the internet only accessible with special software where anything can be bought and
							where criminals launder their stolen cryptocurrencies. For his role in the popular Silk Road market,
							Ross Ulbricht was sentenced in the US to <strong>life
							in prison</strong> without possibility of parole.
							</p>
						</div>
					</div>
					<div class="col-md-4 col-sm-6 col-xs-10 margin_bottom30 offset-xs-1 offset-sm-0">
						<img class="img-responsive center-block" src="images/theft.png" alt="Theft">
						<div class="blog-content text-justify" style="padding-top:20px;">
							<h3 class="text-center">Theft</h3>
							<p class="crime-type">FELONY</p>
							<p>Hackers and scammers have stolen billions of dollars in cryptocurrency over the years. Not even the
							largest exchanges are safe from these skilled and sometimes familiar criminals. In 2019, hacker Joel
							Ortiz received a <strong>10 year</strong> prison sentence for stealing more
							than $7,5 million in cryptocurrencies using a SIM swap technique.</p>
						</div>
					</div>
					</div>
			</div>
		</section>
		<section id="faq">
			<div class="container primary-background">
			<div class="page-header text-center" style="margin-bottom:0 !important;">
				<h2>Scam Prevention</h2>
				<p style="padding-top:10px; padding-bottom: 20px; margin-bottom:0;">
				The amount of scams is increasing every day and scammers are getting smarter as well. <br>Here are a few
				tips to help protect yourself against them.
				</p>
			</div>
			<!--<div id="accordion">
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingOne">
						<h5 class="mb-0 text-center">
						<button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Don't Trust Anyone
						</button>
						</h5>
					</div>
					<div id="collapseOne" class="collapse in" aria-labelledby="headingOne" data-parent="#accordion">
						<div class="faq-text">
							Always make sure you know who or what you are dealing with. If someone is offering you an
							investment opportunity, check if they have a professional website and working Twitter account
							and use our address check to see if it is a known scam.
							Be especially careful with anyone asking you for money Telegram, Twitter or Facebook. If a
							  stranger is
							asking you for money, they are probably trying to scam you, but if you are not sure try to
							verify their claims and ask for proof of their identity. If you are still not sure if you are
							dealing
							with a scammer, you can send us an <a href="mailto:scamcheck@whale-alert.io">e-mail</a> and we
							will take a look as well.
						</div>
					</div>
				</div>
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingTwo">
						<h5 class="mb-0 text-center">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						Verify
						</button>
						</h5>
					</div>
					<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
						<div class="faq-text">
							Always be vigilant. If it sounds too good to be true, it is probably a scam and even when it
							sounds reasonable, it could be a scam. If someone claims
							to have a recording or something else belonging to you, ask for proof. Before sending money to
							an exchange or shop, make sure you are on the correct website. If someone tells you they will
							make you rich, ask them how. Scammers don't like to waste time, so they will probably move on
							once they notice you are not easily fooled.
						</div>
					</div>
				</div>
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingThree">
						<h5 class="mb-0 text-center">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						Protect Yourself
						</button>
						</h5>
					</div>
					<div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
						<div class="faq-text">
							Install a virus scanner and make sure it and your operating system are always up to date. Never
							click on any links or open any files sent to you by a stranger and even be careful with anything
							sent to you by a friend: their computer may be infected. Never give your private keys to anyone
							and don't leave them where others might find them: write down your keys and put them somewhere
							safe. If you use an exchange, use as many of their security measures as possible (like an
							authenticator, phone verification or others) and make sure your passwords are complex. These
							measures will not make it impossible to be hacked or scammed, but they will make it a lot
							harder!
						</div>
					</div>
				</div>
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingFour">
						<h5 class="mb-0 text-center">
						<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
						Don't Panic Don't Pay
						</button>
						</h5>
					</div>
					<div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordion">
			 			<div class="faq-text">
							Scammers are criminals with no intention of helping you and as soon as you pay them your money
							is gone, but don't worry, because that embarrassing video of you never existed and if your
							computer was locked or your files encrypted you can probably fix it yourself by following the
							instructions on
							<a href="https://www.tomsguide.com/us/ransomware-what-to-do-next,news-25107.html" target="_blank">this website</a>. If someone claims
							to know your passwords, phone number or other personal information, you are the victim of one of
							the many data breaches. You can check if and where your personal data was leaked <a href="https://haveibeenpwned.com" target="_blank">here</a>.
						</div>
					</div>
				</div>
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingFive">
						<h5 class="mb-0 text-center">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
							Detecting a Scam
							</button>
						</h5>
					</div>
					<div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordion">
						<div class="faq-text">
							There are some simple checks you can perform to check if something is a scam:
							Make sure the website lists a Twitter channel and read the replies to their tweets.
							Check for spelling errors; scammers often do not speak English as their first language.
							Legitimate websites do not have reviews on their website, nor do they post certificates as proof
							of their legitimacy.
							Google the name of the website and read the top results carefully.
							If the website has a privacy policy or any other text that looks professional, try googling some
							parts;
							they have probably copied it from somewhere else.
							<b>Rich people do not give away free money to strangers.</b>
						</div>
					</div>
				</div>
				<div class="panel" style="-webkit-box-shadow:none">
					<div class="card-header" id="headingSix">
						<h5 class="mb-0 text-center">
							<button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
							Don't Be Greedy
							</button>
						</h5>
					</div>
						<div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordion">
							<div class="faq-text">
								There is no such thing as free money and no reputable company will give you guaranteed returns.
								Anyone promising to double your money or offering a guaranteed daily percentage is a scammer. Be
								especially wary of fake rich celebrities or companies; they did not get rich by giving away free
								money to strangers.
								There is still a lot of opportunity for making money in crypto, but it requires effort and, most
								importantly, research.
							</div>
						</div>
					</div>
					<div class="panel" style="-webkit-box-shadow:none">
						<div class="card-header" id="headingSeven">
							<h5 class="mb-0 text-center">
							 <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
							Report
							</button>
							</h5>
						</div>
						<div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion">
							<div class="faq-text">
								Your reports are important. By collecting data both off and on-chain we are able to determine
								the scale and effect scams have on the crypto economy and we can prevent
								scammers from using their stolen cryptocurrencies. In some cases your reports may even help
								apprehend and build a case against them and every report we receive increases our chances to do
								so, even if we already have a scam address in our databases.
								By reporting scams you also increase their visibility and may help prevent others from making
								payments and show criminals that their activities are not as hidden as they think they are.
							</div>
						</div>
					</div>
				</div>
			</div>-->

			<div id="accordion" class="accordion-container">
				<article class="content-entry">
					<h4 class="article-title"><i></i>Don't Trust Anyone</h4>
					<div class="accordion-content">
						Always make sure you know who or what you are dealing with. If someone is offering you an
							investment opportunity, check if they have a professional website and working Twitter account
							and use our address check to see if it is a known scam.
							Be especially careful with anyone asking you for money Telegram, Twitter or Facebook. If a
							  stranger is
							asking you for money, they are probably trying to scam you, but if you are not sure try to
							verify their claims and ask for proof of their identity. If you are still not sure if you are
							dealing
							with a scammer, you can send us an <a href="mailto:scamcheck@whale-alert.io">e-mail</a> and we
							will take a look as well.
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Verify</h4>
					<div class="accordion-content">
						Always be vigilant. If it sounds too good to be true, it is probably a scam and even when it
						sounds reasonable, it could be a scam. If someone claims
						to have a recording or something else belonging to you, ask for proof. Before sending money to
						an exchange or shop, make sure you are on the correct website. If someone tells you they will
						make you rich, ask them how. Scammers don't like to waste time, so they will probably move on
						once they notice you are not easily fooled.
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Protect Yourself</h4>
					<div class="accordion-content">
						Install a virus scanner and make sure it and your operating system are always up to date. Never
						click on any links or open any files sent to you by a stranger and even be careful with anything
						sent to you by a friend: their computer may be infected. Never give your private keys to anyone
						and don't leave them where others might find them: write down your keys and put them somewhere
						safe. If you use an exchange, use as many of their security measures as possible (like an
						authenticator, phone verification or others) and make sure your passwords are complex. These
						measures will not make it impossible to be hacked or scammed, but they will make it a lot
						harder!
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Don't Panic Don't Pay</h4>
					<div class="accordion-content">
						Scammers are criminals with no intention of helping you and as soon as you pay them your money
						is gone, but don't worry, because that embarrassing video of you never existed and if your
						computer was locked or your files encrypted you can probably fix it yourself by following the
						instructions on
						<a href="https://www.tomsguide.com/us/ransomware-what-to-do-next,news-25107.html" target="_blank">this website</a>. If someone claims
						to know your passwords, phone number or other personal information, you are the victim of one of
						the many data breaches. You can check if and where your personal data was leaked <a href="https://haveibeenpwned.com" target="_blank">here</a>.
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Detecting a Scam</h4>
					<div class="accordion-content">
						There are some simple checks you can perform to check if something is a scam:
						Make sure the website lists a Twitter channel and read the replies to their tweets.
						Check for spelling errors; scammers often do not speak English as their first language.
						Legitimate websites do not have reviews on their website, nor do they post certificates as proof
						of their legitimacy.
						Google the name of the website and read the top results carefully.
						If the website has a privacy policy or any other text that looks professional, try googling some
						parts;
						they have probably copied it from somewhere else.
						<b>Rich people do not give away free money to strangers.</b>
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Don't Be Greedy</h4>
					<div class="accordion-content">
						There is no such thing as free money and no reputable company will give you guaranteed returns.
						Anyone promising to double your money or offering a guaranteed daily percentage is a scammer. Be
						especially wary of fake rich celebrities or companies; they did not get rich by giving away free
						money to strangers.
						There is still a lot of opportunity for making money in crypto, but it requires effort and, most
						importantly, research.
					</div>
				</article>

				<article class="content-entry">
					<h4 class="article-title"><i></i>Report</h4>
					<div class="accordion-content">
						Your reports are important. By collecting data both off and on-chain we are able to determine
						the scale and effect scams have on the crypto economy and we can prevent
						scammers from using their stolen cryptocurrencies. In some cases your reports may even help
						apprehend and build a case against them and every report we receive increases our chances to do
						so, even if we already have a scam address in our databases.
						By reporting scams you also increase their visibility and may help prevent others from making
						payments and show criminals that their activities are not as hidden as they think they are.
					</div>
				</article>
			</div>
		</section>
	</main>

	<?php include 'includes/footer.php'; ?>
</body>
</html>