<?php include("includes/app_top.php");
    
$campaign = $_SESSION['campaign'];
$pagetitle2="Registration";
if(isset($_SESSION["userid"]))
  {
    header("location:view-profile.php");
    exit();
}
if ($action=="register")
{
$email=strtolower(cleanQuery($_POST['email']));
$sql1= "select * from users where email='".$email."'";
$res1= mysqli_query($mysqli,$sql1);
    
if($email!='' && mysqli_num_rows($res1)==0)
{
$name=cleanQuery($_POST['name']);
$gender=cleanQuery($_POST['gender']);
$password=sha1(cleanQuery($_POST['password']));
$countrycode=cleanQuery($_POST['countrycode']);
$phone=cleanQuery($_POST['phone']);
$city=cleanQuery($_POST['city']);
$state=cleanQuery($_POST['state']);
$country=cleanQuery($_POST['country']);
$vcode=create_sessionid(10);

$esubject="AAP Call Campaign - New User";
$emailtext = "<div style='font-size:13px; font-family:arial; line-height:21px;'>Citizen Call Campaign Registration Details: 
<br/><br/>
Name: ".$name."
<br/>Gender: ".$gender."
<br/>Country Code: ".$countrycode."
<br/>Phone No: ".$phone."
<br/>Email Id: ".$email."
<br/>City: ".$city."
<br/>State: ".$state."
<br/>Country: ".$country."
</div>";
# Send the email to you
$ip = getenv("REMOTE_ADDR") ;
$query="insert into users (name,state_id,gender,password,phone,email,city,state,country,datecreated,countrycode,confirmation, ip_address) VALUES ('$name','$stateid','$gender','$password','$phone','$email','$city','$state','$country','$date','$countrycode','$vcode','$ip')";
$a=mysqli_query($mysqli,$query);



require 'includes/mailer.php';
//sendmail($email,$name,$adminemail,$esubject,$emailtext);
//echo $query;
$sql2= "select * from email_templates where id=5";
        $res2= mysqli_query($mysqli,$sql2);
        $row2= mysqli_fetch_assoc($res2);
		$esubject = $row2['subject'];
		$esubject = str_replace("[NAME]",$name,$esubject); 
		$emailtext = $row2['description'];
		$emailtext = str_replace("[VCODE]",$vcode."&campaign=".$campaign,$emailtext);
		$emailtext = str_replace("[NAME]",$name,$emailtext);		
		$emailtext = str_replace("[EMAIL]",$email,$emailtext);
        $emailtext = str_replace("[SITEURL]",'http://emc3.aamaadmiparty.org/delhi/',$emailtext);
		$emailtext = str_replace("[SITENAME]",$sitename,$emailtext);	
		$emailtext = str_replace("[ADMINEMAIL]",$adminemail,$emailtext);												
		$emailtext = str_replace("[SOCIAL_ICONS_MAIL]",$socialicons_mail,$emailtext);														
# Send the email to you
sendmail('','',$email,$esubject,$emailtext);
//@mail("$email", $esubject, $emailtext, "From: $adminemail\r\nReply-to: $adminemail\r\nContent-type: text/html; charset=us-ascii");
tep_redirect("registration.php?action1=success");
}
else if ($email=='')
    tep_redirect("registration.php?action1=err1");
else if (mysqli_num_rows($res1)!=0)
    tep_redirect("registration.php?action1=err2");
}
?>
<?php include("includes/styles.php");?>
<?php include("../includes/colorbox.php");?>
<script type="text/javascript" src="../js/ajax.js"></script>
<script src="../js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#signup").validate({
              rules: {
						name:"required",
						password: "required validpassword",
						password2:{required: true, equalTo: "#password"},
						email: "email required", 
						countrycode: "required", 
						phone: "required", 
						city: "required", 
						gender: "required", 
						country: "required", 
						state: "required", 
						security_code: "required",
						
                }
});
});
function check2(ptype1)
{
if(ptype1=="Others")
document.getElementById("ptype").style.display="block";	
else
document.getElementById("ptype").style.display="none"; 
}
</script>
</head>
<body>
<?php include("includes/header.php");?>
        <div class="division-1">
          <h1 class="clear_left hidden-phone"><span class="f-left"><?php echo $pagetitle2;?></span><a class="back-login" href="login.php">Back to Login</a></h1>
          <div id="messages">
            <?php if($action1=="success") { echo '<div class="success">Please check your email and confirm to activate your account. 
			</div>';
			
			}
				if($action1=="err1") { echo '<div class="error">Email not specified.</div>';}
                if($action1=="err2") { echo '<div class="error">Account already exists with that email. Try resetting your password instead.</div>';}
?>
          </div>
         
          <div class="member-registration clearfix">
            <h1 class="mem hidden-desktop hidden-tablet">Member Registration</h1>
            <div class="clearfix p5 hidden-desktop hidden-tablet"></div>
           <form name="signup" id="signup"  action="registration.php?action=register"  enctype="multipart/form-data"   method="post">
               <h3 class="details l-r-p5 red-t b-p0  mobile-t-c">Personal and Contact Details</h3>
              <div class="column-row b-p5 mobile-t-c">
                <div class="column-i">
                  <div class="l-r-p5">
                    <label class="black-t font15"> Name : <span class="red-t">*</span></label>
                    <input type="text" name="name" class="input-block-level">
                  </div>
                </div>
              </div>
              <div class="column-row b-p5 mobile-t-c">
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">Country Code : <span class="red-t">*</span></label>
                    <select name="countrycode" class="input-block-level" >
 
 <option value="213">Algeria (+213)</option> 
 <option value="376">Andorra (+376)</option> 
 <option value="244">Angola (+244)</option> 
 <option value="1264">Anguilla (+1264)</option> 
 <option value="1268">Antigua &amp; Barbuda (+1268)</option> 
 <option value="599">Antilles (Dutch) (+599)</option> 
 <option value="54">Argentina (+54)</option> 
 <option value="374">Armenia (+374)</option> 
 <option value="297">Aruba (+297)</option> 
 <option value="247">Ascension Island (+247)</option> 
 <option value="61">Australia (+61)</option> 
 <option value="43">Austria (+43)</option> 
 <option value="994">Azerbaijan (+994)</option> 
 <option value="1242">Bahamas (+1242)</option> 
 <option value="973">Bahrain (+973)</option> 
 <option value="880">Bangladesh (+880)</option> 
 <option value="1246">Barbados (+1246)</option> 
 <option value="375">Belarus (+375)</option> 
 <option value="32">Belgium (+32)</option> 
 <option value="501">Belize (+501)</option> 
 <option value="229">Benin (+229)</option> 
 <option value="1441">Bermuda (+1441)</option> 
 <option value="975">Bhutan (+975)</option> 
 <option value="591">Bolivia (+591)</option> 
 <option value="387">Bosnia Herzegovina (+387)</option> 
 <option value="267">Botswana (+267)</option> 
 <option value="55">Brazil (+55)</option> 
 <option value="673">Brunei (+673)</option> 
 <option value="359">Bulgaria (+359)</option> 
 <option value="226">Burkina Faso (+226)</option> 
 <option value="257">Burundi (+257)</option> 
 <option value="855">Cambodia (+855)</option> 
 <option value="237">Cameroon (+237)</option> 
 <option value="1">Canada/USA (+1)</option>
 <option value="238">Cape Verde Islands (+238)</option> 
 <option value="1345">Cayman Islands (+1345)</option> 
 <option value="236">Central African Republic (+236)</option> 
 <option value="56">Chile (+56)</option> 
 <option value="86">China (+86)</option> 
 <option value="57">Colombia (+57)</option> 
 <option value="269">Comoros (+269)</option> 
 <option value="242">Congo (+242)</option> 
 <option value="682">Cook Islands (+682)</option> 
 <option value="506">Costa Rica (+506)</option> 
 <option value="385">Croatia (+385)</option> 
 <option value="53">Cuba (+53)</option> 
 <option value="90392">Cyprus North (+90392)</option> 
 <option value="357">Cyprus South (+357)</option> 
 <option value="42">Czech Republic (+42)</option> 
 <option value="45">Denmark (+45)</option> 
 <option value="2463">Diego Garcia (+2463)</option> 
 <option value="253">Djibouti (+253)</option> 
 <option value="1809">Dominica (+1809)</option> 
 <option value="1809">Dominican Republic (+1809)</option> 
 <option value="593">Ecuador (+593)</option> 
 <option value="20">Egypt (+20)</option> 
 <option value="353">Eire (+353)</option> 
 <option value="503">El Salvador (+503)</option> 
 <option value="240">Equatorial Guinea (+240)</option> 
 <option value="291">Eritrea (+291)</option> 
 <option value="372">Estonia (+372)</option> 
 <option value="251">Ethiopia (+251)</option> 
 <option value="500">Falkland Islands (+500)</option> 
 <option value="298">Faroe Islands (+298)</option> 
 <option value="679">Fiji (+679)</option> 
 <option value="358">Finland (+358)</option> 
 <option value="33">France (+33)</option> 
 <option value="594">French Guiana (+594)</option> 
 <option value="689">French Polynesia (+689)</option> 
 <option value="241">Gabon (+241)</option> 
 <option value="220">Gambia (+220)</option> 
 <option value="7880">Georgia (+7880)</option> 
 <option value="49">Germany (+49)</option> 
 <option value="233">Ghana (+233)</option> 
 <option value="350">Gibraltar (+350)</option> 
 <option value="30">Greece (+30)</option> 
 <option value="299">Greenland (+299)</option> 
 <option value="1473">Grenada (+1473)</option> 
 <option value="590">Guadeloupe (+590)</option> 
 <option value="671">Guam (+671)</option> 
 <option value="502">Guatemala (+502)</option> 
 <option value="224">Guinea (+224)</option> 
 <option value="245">Guinea - Bissau (+245)</option> 
 <option value="592">Guyana (+592)</option> 
 <option value="509">Haiti (+509)</option> 
 <option value="504">Honduras (+504)</option> 
 <option value="852">Hong Kong (+852)</option> 
 <option value="36">Hungary (+36)</option> 
 <option value="354">Iceland (+354)</option> 
 <option value="91" selected="selected">India (+91)</option> 
 <option value="62">Indonesia (+62)</option> 
 <option value="98">Iran (+98)</option> 
 <option value="964">Iraq (+964)</option> 
 <option value="972">Israel (+972)</option> 
 <option value="39">Italy (+39)</option> 
 <option value="225">Ivory Coast (+225)</option> 
 <option value="1876">Jamaica (+1876)</option> 
 <option value="81">Japan (+81)</option> 
 <option value="962">Jordan (+962)</option> 
 <option value="7">Kazakhstan (+7)</option> 
 <option value="254">Kenya (+254)</option> 
 <option value="686">Kiribati (+686)</option> 
 <option value="850">Korea North (+850)</option> 
 <option value="82">Korea South (+82)</option> 
 <option value="965">Kuwait (+965)</option> 
 <option value="996">Kyrgyzstan (+996)</option> 
 <option value="856">Laos (+856)</option> 
 <option value="371">Latvia (+371)</option> 
 <option value="961">Lebanon (+961)</option> 
 <option value="266">Lesotho (+266)</option> 
 <option value="231">Liberia (+231)</option> 
 <option value="218">Libya (+218)</option> 
 <option value="417">Liechtenstein (+417)</option> 
 <option value="370">Lithuania (+370)</option> 
 <option value="352">Luxembourg (+352)</option> 
 <option value="853">Macao (+853)</option> 
 <option value="389">Macedonia (+389)</option> 
 <option value="261">Madagascar (+261)</option> 
 <option value="265">Malawi (+265)</option> 
 <option value="60">Malaysia (+60)</option> 
 <option value="960">Maldives (+960)</option> 
 <option value="223">Mali (+223)</option> 
 <option value="356">Malta (+356)</option> 
 <option value="692">Marshall Islands (+692)</option> 
 <option value="596">Martinique (+596)</option> 
 <option value="222">Mauritania (+222)</option> 
 <option value="269">Mayotte (+269)</option> 
 <option value="52">Mexico (+52)</option> 
 <option value="691">Micronesia (+691)</option> 
 <option value="373">Moldova (+373)</option> 
 <option value="377">Monaco (+377)</option> 
 <option value="976">Mongolia (+976)</option> 
 <option value="1664">Montserrat (+1664)</option> 
 <option value="212">Morocco (+212)</option> 
 <option value="258">Mozambique (+258)</option> 
 <option value="95">Myanmar (+95)</option> 
 <option value="264">Namibia (+264)</option> 
 <option value="674">Nauru (+674)</option> 
 <option value="977">Nepal (+977)</option> 
 <option value="31">Netherlands (+31)</option> 
 <option value="687">New Caledonia (+687)</option> 
 <option value="64">New Zealand (+64)</option> 
 <option value="505">Nicaragua (+505)</option> 
 <option value="227">Niger (+227)</option> 
 <option value="234">Nigeria (+234)</option> 
 <option value="683">Niue (+683)</option> 
 <option value="672">Norfolk Islands (+672)</option> 
 <option value="670">Northern Marianas (+670)</option> 
 <option value="47">Norway (+47)</option> 
 <option value="968">Oman (+968)</option> 
 <option value="92">Pakistan (+92)</option> 
 <option value="680">Palau (+680)</option> 
 <option value="507">Panama (+507)</option> 
 <option value="675">Papua New Guinea (+675)</option> 
 <option value="595">Paraguay (+595)</option> 
 <option value="51">Peru (+51)</option> 
 <option value="63">Philippines (+63)</option> 
 <option value="48">Poland (+48)</option> 
 <option value="351">Portugal (+351)</option> 
 <option value="1787">Puerto Rico (+1787)</option> 
 <option value="974">Qatar (+974)</option> 
 <option value="262">Reunion (+262)</option> 
 <option value="40">Romania (+40)</option> 
 <option value="7">Russia (+7)</option> 
 <option value="250">Rwanda (+250)</option> 
 <option value="378">San Marino (+378)</option> 
 <option value="239">Sao Tome &amp; Principe (+239)</option> 
 <option value="966">Saudi Arabia (+966)</option> 
 <option value="221">Senegal (+221)</option> 
 <option value="381">Serbia (+381)</option> 
 <option value="248">Seychelles (+248)</option> 
 <option value="232">Sierra Leone (+232)</option> 
 <option value="65">Singapore (+65)</option> 
 <option value="421">Slovak Republic (+421)</option> 
 <option value="386">Slovenia (+386)</option> 
 <option value="677">Solomon Islands (+677)</option> 
 <option value="252">Somalia (+252)</option> 
 <option value="27">South Africa (+27)</option> 
 <option value="34">Spain (+34)</option> 
 <option value="94">Sri Lanka (+94)</option> 
 <option value="290">St. Helena (+290)</option> 
 <option value="1869">St. Kitts (+1869)</option> 
 <option value="1758">St. Lucia (+1758)</option> 
 <option value="249">Sudan (+249)</option> 
 <option value="597">Suriname (+597)</option> 
 <option value="268">Swaziland (+268)</option> 
 <option value="46">Sweden (+46)</option> 
 <option value="41">Switzerland (+41)</option> 
 <option value="963">Syria (+963)</option> 
 <option value="886">Taiwan (+886)</option> 
 <option value="7">Tajikstan (+7)</option> 
 <option value="66">Thailand (+66)</option> 
 <option value="228">Togo (+228)</option> 
 <option value="676">Tonga (+676)</option> 
 <option value="1868">Trinidad &amp; Tobago (+1868)</option> 
 <option value="216">Tunisia (+216)</option> 
 <option value="90">Turkey (+90)</option> 
 <option value="7">Turkmenistan (+7)</option> 
 <option value="993">Turkmenistan (+993)</option> 
 <option value="1649">Turks &amp; Caicos Islands (+1649)</option> 
 <option value="688">Tuvalu (+688)</option> 
 <option value="256">Uganda (+256)</option> 
 <option value="44">UK (+44)</option> 
 <option value="380">Ukraine (+380)</option> 
 <option value="971">United Arab Emirates (+971)</option> 
 <option value="598">Uruguay (+598)</option> 
 <option value="1">USA/Canada (+1)</option>
 <option value="7">Uzbekistan (+7)</option> 
 <option value="678">Vanuatu (+678)</option> 
 <option value="379">Vatican City (+379)</option> 
 <option value="58">Venezuela (+58)</option> 
 <option value="84">Vietnam (+84)</option> 
 <option value="1284">Virgin Islands - British (+1284)</option> 
 <option value="1340">Virgin Islands - US (+1340)</option> 
 <option value="681">Wallis &amp; Futuna (+681)</option> 
 <option value="969">Yemen (North)(+969)</option> 
 <option value="967">Yemen (South)(+967)</option> 
 <option value="381">Yugoslavia (+381)</option> 
 <option value="243">Zaire (+243)</option> 
 <option value="260">Zambia (+260)</option> 
 <option value="263">Zimbabwe (+263)</option>
  </select>
                  </div>
                </div>
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">Contact No : <span class="red-t">*</span></label>
                    <input type="text" name="phone" class="input-block-level">
                  </div>
                </div>
              </div>
              <div class="column-row b-p5 mobile-t-c">
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">State : <span class="red-t">*</span></label>
                    <input type="text" name="state" class="input-block-level">
                  </div>
                </div>
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">City : <span class="red-t">*</span></label>
                    <input type="text" name="city" class="input-block-level">
                  </div>
                </div>
              </div>
              <div class="column-row b-p5 mobile-t-c">
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">Country : <span class="red-t">*</span></label>
                    <input type="text" name="country" class="input-block-level">
                  </div>
                </div>
                <div class="column-2">
                  <div class="l-r-p5">
                    <label class="black-t font15">Gender : <span class="red-t">*</span></label>
                    <select class="input-block-level" name="gender">
                      <option value="">Select</option>
                      <option value="Female">Female</option>
                      <option value="Male">Male</option>
                      <option value="Other">Other</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="clearfix p4"></div>
              <h3 class="details l-r-p5 red-t b-p0  mobile-t-c">Login Details</h3>
              <div class="column-row b-p5 clear mobile-t-c">
                <div class="l-r-p5">
                  <label class="black-t font15">Email Id : <span class="red-t">*</span></label>
                  <input name="email" id="email" type="text" class="input-block-level" autocomplete="off" onChange="checkmail()" value=""/>                  
                </div>
                <div id="email_response" ></div>
              </div>
              <div class="column-row b-p5 clear mobile-t-c">
                <div class="l-r-p5">
                  <label class="black-t font15">Password : <span class="red-t">*</span></label>
                  <input type="password" class="input-block-level" autocomplete="off" id="password" name="password">
                </div>
              </div>
              <div class="column-row b-p5 bor-b clear mobile-t-c">
                <div class="l-r-p5">
                  <label class="black-t font15">Retype Password : <span class="red-t">*</span></label>
                  <input type="password" class="input-block-level" name="password2">
                </div>
              </div>
                <div class="column-row b-p5 clear mobile-t-c">
                <div id="captcha_response"></div></div>
              <div class="clearfix p5  l-r-m5 b-m10" style="overflow:hidden"> </div>
              <label class="black-t font15 l-r-p5 mobile-t-c">Security Code : <span class="red-t">*</span></label>
              <div class="column-row b-p5 mobile-t-c">
                <div class="column-S">
                  <div class="l-r-p5">
                    <input type="text" style="TEXT-TRANSFORM: lowercase; float:left;" maxlength="10" 
 size="10" name="security_code" id="security_code" onChange="checkcaptcha()" class="input-block-level"  />
                  </div>
                </div>
                <div class="column-2">
                  <div class="l-r-p5 t-l"> <img src="CaptchaSecurityImages.php?characters=5" alt="" id='captchaimg'  height="35" ><a href="javascript: refreshCaptcha();"><img src="../images/refresh.jpg" alt="Refresh" /></a> </div>
                </div>                
              </div>
            
              <div class="box-row b-p5 mobile-t-c" style="overflow:hidden;">
                <div class="box-6">
                  <div class="l-r-p5 t-r">
                    <input type="submit" value="Submit" class="button-s button2" style="margin-top:10px;" />
                  </div>
                </div>
                <div class="box-6">
                  <div class="l-r-p5 t-l">
                    <input type="reset" value="Reset" class="button-r button2" style="margin-top:10px;" />
                  </div>
                </div>
              </div>
            </form>
            <div class="notice2" style="margin:0px 0px 10px 0;" ><span class="maroon">WARNING:</span> Please note that registration does not guarantee access into the system. You would need to get activated after being verified by an admin. Any misuse of this system against the Aam Aadmi Party will be legally dealt with in the strongest possible manner. Your IP address has been recorded for security purposes.</div>
          </div>
          <p align="center" ><br />
<strong class="red">NOTE: </strong>Please also join the <strong><a href="https://www.facebook.com/aapcalldelhi" target="_blank">AAP - Call Delhi</a></strong> Facebook group to get the latest information about the call campaign.</p>
        </div>
           <div style="clear:both"></div>
        <div class="clearfix l-r-p10 t-c" align="center"> <img src="../images/aap-logo.png" /> </div>
      </div>
     
    <?php include("includes/footer.php");?>
    <script type="text/javascript">
function popup()
{
	alert("Thank you for registering. Please wait to hear back from an admin about activation." );
	}
	<?php
		if($action1=="success")
		{
			?>
			
			popup();
	<?php
		}
	 ?>    
    </script>
</body>
</html>
