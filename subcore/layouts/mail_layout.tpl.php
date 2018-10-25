<?php header("Content-Type: text/html; charset=utf-8"); ?> 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
 	<head>
    	<title><?php echo PROJECT . " - " . $Data->__page_name; ?></title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, user-scalable=no" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />  
	    <meta name="description" content="" />
		<meta name="HandheldFriendly" content="True" />
	  	
	  	<style type="text/css">
         /* Client-specific Styles */
         #outlook a {padding:0;} /* Force Outlook to provide a "view in browser" menu link. */
         body{font-family:Helvetica; min-height: 500px; background:#DDDDDD;width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0;}
         /* Prevent Webkit and Windows Mobile platforms from changing default font sizes, while not breaking desktop design. */
         .ExternalClass {width:100%;} /* Force Hotmail to display emails at full width */
         .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;} 
         .ExternalClass h1{} .ExternalClass h2{} .ExternalClass h3{ color: #FFF;} /* 
         Force Hotmail to display normal line spacing. */
         #backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
         img {outline:none; text-decoration:none;border:none; -ms-interpolation-mode: bicubic;}
         a img {border:none;}
         .image_fix {display:block;}
         p {margin: 0px 0px !important;}
         table td {border-collapse: collapse;}
         table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; }
         a {color: #33b9ff;text-decoration: none;text-decoration:none!important;}
         /*STYLES*/
         table[class=full] { width: 100%; clear: both; }
         /*IPAD STYLES*/
         @media only screen and (max-width: 640px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #209DE5;
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #209DE5 !important;
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 440px!important;text-align:center!important;}
         table[class=devicewidthmob] {width: 420px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 420px!important;text-align:center!important;}
         img[class=banner] {width: 440px!important;height:157px!important;}
         img[class=col2img] {width: 440px!important;height:330px!important;}
         table[class="cols3inner"] {width: 100px!important;}
         table[class="col3img"] {width: 131px!important;}
         img[class="col3img"] {width: 131px!important;height: 82px!important;}
         table[class='removeMobile']{width:10px!important;}
         img[class="blog"] {width: 420px!important;height: 162px!important;}
         }

         /*IPHONE STYLES*/
         @media only screen and (max-width: 480px) {
         a[href^="tel"], a[href^="sms"] {
         text-decoration: none;
         color: #0a8cce; /* or whatever your want */
         pointer-events: none;
         cursor: default;
         }
         .mobile_link a[href^="tel"], .mobile_link a[href^="sms"] {
         text-decoration: default;
         color: #0a8cce !important; 
         pointer-events: auto;
         cursor: default;
         }
         table[class=devicewidth] {width: 280px!important;text-align:center!important;}
         table[class=devicewidthmob] {width: 260px!important;text-align:center!important;}
         table[class=devicewidthinner] {width: 260px!important;text-align:center!important;}
         img[class=banner] {width: 280px!important;height:100px!important;}
         img[class=col2img] {width: 280px!important;height:210px!important;}
         table[class="cols3inner"] {width: 260px!important;}
         img[class="col3img"] {width: 280px!important;height: 175px!important;}
         table[class="col3img"] {width: 280px!important;}
         img[class="blog"] {width: 260px!important;height: 100px!important;}
         td[class="padding-top-right15"]{padding:15px 15px 0 0 !important;}
         td[class="padding-right15"]{padding-right:15px !important;}
         }
         .imgpop { }
         .center { text-align: center; }
      </style>
	</head>
  	<body>
		<!-- Layout -->
		<table style="font-family:Helvetica; color:#4D4D4D;" width="100%" bgcolor="#DDDDDD" cellpadding="0" cellspacing="0" border="0" id="backgroundTable" st-sortable="header">
		   <tbody>
		      <tr>
		         <td>
		            <table width="560" cellpadding="0" cellspacing="0" border="0" align="center" class="devicewidth">
	                	<!-- header -->
	                	<tr width="100%" bgcolor="#000000" style="border-left:1px solid #CCC;border-right:1px solid #CCC;border-top:1px solid #CCC;" cellpadding="0" cellspacing="0" border="0" class="devicewidth">
	                        <!-- logo -->
                        	<td style="padding-left:12px; padding-top:4px;" colspan="5" height="60" align="left">
                              <div class="imgpop">
                                 <a target="_blank" href="http://hikis.com/">
                                    <img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/app-icon-white.png" border="0" style="display:block; border:none; outline:none; text-decoration:none; width:100px;" alt="HIKIS PARTHNER">
                                 </a>
                              </div>
                           </td>
                           <!-- logo -->
	                	</tr>
	                	<!-- header -->

							<!-- content -->
							<tr width="100%" bgcolor="#FFFFFF" style="" cellpadding="0" cellspacing="0" border="0"  class="devicewidth" >
							   <td style="padding:30px 32px;" colspan="5" height="60" align="left">
									<div style="padding:12px; margin-top: 80px; margin-bottom: 220px; -webkit-border-radius: 5px; -moz-border-radius:5px;border-radius: 5px;border-collapse: separate; border:1px solid #fff;">
										<div class="imgpop">
                                 <img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/logo-small-black.png" border="0" style="display:block; border:none; outline:none; text-decoration:none; width:50px;" alt="HIKIS">
                              </div>
                              <?php 
										     /* This is actually very important but you know, sometimes important
			   							   * things are ignored because they are small. */ 
			   								echo $_content
										?>	
									</div>

								</td>
							</tr>
							<!-- content -->

	                	<!-- footer -->
	                	<tr height="60" width="100%" bgcolor="#FFFFFF" style="-webkit-box-shadow: inset 0 10px 10px -10px #999;-moz-box-shadow: inset 0 6px 6px -6px #999; box-shadow: inset 0 10px 10px -10px #999; border-top:1px solid #CCC"  cellpadding="0" cellspacing="0" border="0" class="devicewidth">
	                	 	<!-- company data -->
	                	 	<td	width="60%" style="font-size:12px; padding-left:12px; line-height:12px; mso-line-height-rule: exactly; color: #999;">
                            	JUAN DE DIOS ROBLEDO 23 C.P. 44419 Gdl. Jal, MEX
                              <br />Whatsapp (+521) 33·4593·7065
							   </td>
	                	 	<!-- company data -->

	                	 	<!-- social webs -->
	                	 	<td width="10%">
								   <div class="imgpops">
									   <a target="_blank" href="https://www.instagram.com/hikis.official/">
                           	  <img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/logo-instagram.jpg" style="float:left; width:32px; margin:7px;"  alt="instagram">
	                           </a>
                           </div>
							   </td>

   	                	<td width="10%">
   								<div class="imgpop2">
   								   <a target="_blank" href="https://www.facebook.com/hikis">
                              	<img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/logo-facebook.jpg" style="float:left; width:32px; margin:7px;" alt="facebook">
                              </a>
                           </div>
   							</td>

   	                	<td width="10%">
                           <div class="imgpops">
                          		<a target="_blank" href="https://www.twitter.com/hikis">
                          			<img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/logo-twitter.jpg" style="float:left; width:32px; margin:7px;" alt="twitter">
                          		</a>
                          	</div>
   							</td>

   	                	<td width="10%">
                           <div class="imgpos">
                             	<a target="_blank" href="#">
                             		<img src="http://api.estilosfrescos.xyz/hikis/subcore/assets/images/logo-whatsapp.jpg" style="float:left; width:32px; margin:7px;" alt="whatsapp">
                              </a>
                           </div>
   							</td>
	                	   <!-- social webs -->

   							<!-- supporting -->
                        	<?php if(!empty($Data->link)){ ?>
                           	<tr>
                             	<td colspan="5" height="40" style="padding-top:12px; line-height:12px; mso-line-height-rule: exactly;">
                                 	<p style="font-size:12px;color:#999;text-align:center;">	
   							   		      <?php echo Functions::__Translate("If cannot see this mail correctly") ?><a href="http://<?php echo WEB_SITE . $Data->link ?>"> <?php echo Functions::__Translate("click here") ?> 
                                 	</p>
                              	</td>
                           	</tr>
                        	<?php } ?>
   	                  <!-- supporting -->
						   </tr>
	                  <!-- footer -->
		            </table>
		         </td>
		      </tr>
		   </tbody>
		</table>
		<!-- Layout -->
  	</body>
</html>