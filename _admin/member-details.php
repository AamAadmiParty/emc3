<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Members";
checkAdminLogin();
checkState();

$getid = get('id');
if($action=="delete")  
{
$query="update contacts set iscalled=6  where userid=".$getid;
 mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=update2&id='.$getid));
}
if($action =="change")
{
	$imgsrc=return_field('users','id',$getid,'imgsrc');
  if($_FILES['ufile']['name']!="")
{
$source=$_FILES['ufile']['name'];
$ext = explode(".", $source);
$ext = strtolower(array_pop($ext));
if ($ext == "jpg" || $ext == "gif" || $ext == "png") {        
$path1 = "../pictures/members/ra_".$getid.".".$ext;
$path1a = "../pictures/members/ra_".$getid.".jpg";
$a=copy($_FILES['ufile']['tmp_name'], $path1);
if ($ext == "png") 
{
      $image = ImageCreateFromPNG($path1);
      ImageJpeg($image, $path1a);
      ImageDestroy($image);
}
if ($ext == "gif") 
{
      $image = ImageCreateFromGIF($path1);
      ImageJpeg($image, $path1a);
      ImageDestroy($image);
}
$imgsrc="ra_".$getid.".jpg";
if(!$a)
tep_redirect(tep_href_link($pagename,'action1=err5'));
}}
$query="update users set  name='" . cleanQuery($_POST['name']). "',city='" . cleanQuery($_POST['city']). "', gender='" . cleanQuery($_POST['gender']). "', state='" . cleanQuery($_POST['state']). "', email='" . cleanQuery($_POST['email']). "',country='" . cleanQuery($_POST['country']). "', status2=" . cleanQuery($_POST['pstatus']). ",phone='" . cleanQuery($_POST['phone']). "',countrycode='" . cleanQuery($_POST['countrycode']). "',imgsrc='".$imgsrc."',comments='" . cleanQuery($_POST['comments']). "' where id=".$getid;
 mysqli_query($mysqli, $query);
 
$password=cleanQuery($_POST['password2']);
if($password!='')
{
$password2=sha1($password);
$query2="update users set password='".$password2."' where id=".$getid;
mysqli_query($mysqli, $query2);
}

//echo $query;
tep_redirect(tep_href_link($pagename,'action1=update&id='.$getid));
}
if($action=="dphoto")
{
$query="update users set imgsrc='' where id=".$getid;
mysqli_query($mysqli, $query);
tep_redirect(tep_href_link($pagename,'action1=success2&id='.$getid));
}
?>
<?php include("includes/styles.php");?>
<?php include("includes/colorbox.php");?>
<script type="text/javascript">
function confirm2()
{
var1=confirm("Do you want Revert back the contacts of this member?");
    if(var1)
	{
 var2=confirm("Contacts cannot recover. Are you sure?");
    if(var2)
{
window.location="member-details.php?action=delete&id=<?php echo $getid;?>";
}}
} 
</script>
</head>
<body>
<?php include("includes/side-bar.php");?>
<?php include("includes/header.php");?> 
<div class="pageHeadingBlock ">
        	<div class="grayBackground">
            <div class="fR t-r">
           		<a href="members.php" class="clearfix">&larr; back to members list</a>
            </div>
        	<h3 class="title">Member Details</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
            </div>
        </div>
        <div class="clearfix sepH_b"></div>
                                  
                                  
                                           <div id="messages"><?php
if($action1=="update") { echo '<div class="alert alert-success">Updated details.</div>';}
if($action1=="success") { echo '<div class="alert alert-success">Reverted all contacts of this member successfully.</div>';}
if($action1=="success2") { echo '<div class="alert alert-success">Deleted Member Picture</div>';} 
if($action1=="err5") { echo '<div class="alert alert-error">Error in Uploading file. </div>';}
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}
?></div>                                     </td>
                <?php $query="select * from users where id='". $getid."'"; 								 
				$res=mysqli_query($mysqli, $query);
              $row=mysqli_fetch_assoc($res);?>
        <form action="<?php echo $pagename;?>?action=change&amp;id=<?php echo $getid;?>" method="post" name="frmadd" id="frmadd" enctype="multipart/form-data">
        <div class="custom-adn grayBackground nobL nobR">    
    <div class="ui-accordion">
	<h3><b>Personal Details</b></h3>
	<div class="form-horizontal">
		<div class="filedsetInner clearfix">
        	
            <div class="row-fluid">
            
              <div class="span5 printlist sepV_d">
                
                <div class="control-group">
                    <div class="control-label"><label>Name:</label></div>
					<div class="controls"><input name="name" type="text" class="input" value="<?php echo $row['name'];?>"   /></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><label>Gender:</label></div>
					<div class="controls">
                    	<select name="gender" >
                        	<option value="">Select</option>	
                        	<option value="Female">Female</option>
                            <option value="Male">Male</option>
                        </select>
                        <script language="javascript">
							document.frmadd.gender.value = "<?php echo $row['gender'];?>";											
						</script>
                    </div>
                </div>
              </div>
              
                <div class="control-group">
                    <div class="control-label"><label>Picture:</label></div>
					<div class="controls"><input name="ufile" type="file" id="ufile" />
                    <div class="control-label">&nbsp;</div>
<?php  
$photosrc = "../pictures/members/th_". $row['imgsrc'];	
										  if (!file_exists($photosrc)) 
										     $photosrc = "../pictures/members/". $row['imgsrc'];	
												 	if (file_exists($photosrc)&&($row['imgsrc']!="")) 
													{ 
													?>
                                                    <div class="controls coursesMenu">
                                                    <a href="member-picture.php?id=<?php echo $getid;?>" class="profile" rel="colorbox2">Edit  Picture</a>&nbsp;|&nbsp;
                                                    <a href="<?php echo $photosrc;?>" class="col" rel="col">View Picture</a>&nbsp;|&nbsp;<a href="<?php echo $pagename;?>?action=dphoto&id=<?php echo $getid;?>">Delete Picture</a><?php }?></div>
                </div>
              
            </div>
                
        </div>
	</div>
	
	
	</div><!-- end personal info form -->
    </div>
     
    <hr class="mN"> 
      <div class="custom-adn grayBackground nobL nobR">   
    <div class="ui-accordion">
	<h3><b>Contact Details</b></h3>
	<div class="form-horizontal">
		<div class="filedsetInner clearfix">
        	
            <div class="row-fluid">
            
              <div class="span5 sepV_d">
                <div class="control-group">
                    <div class="control-label"><label>Email Id:</label></div>
					<div class="controls"><input name="email" type="text" class="input" value="<?php echo $row['email'];?>"   /></div>
                </div>
                  
                <div class="control-group">
                    <div class="control-label"><label>Country Code:</label></div>
					<div class="controls">
                    <select name="countrycode" class="input-block-level" >
                    <option value="">Select</option>
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
 <option value="1">Canada (+1)</option> 
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
 <option value="91">India (+91)</option> 
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
 <option value="1">USA (+1)</option> 
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
  					<script language="javascript">
							document.frmadd.countrycode.value = "<?php echo $row['countrycode'];?>";											
						</script>
                    </div>
                </div>
                  <div class="control-group">
                    <div class="control-label"><label>Phone:</label></div>
					<div class="controls"><input name="phone" type="text" class="input" value="<?php echo $row['phone'];?>"   /></div>
                </div>
				<div class="control-group">
                    <div class="control-label"><label>Password :</label></div>
					<div class="controls"><input name="password2" type="text" class="input" value=""   /></div>
                </div>
             
               <div class="control-group"> <div class="control-label12">(Enter new password to change. Else leave blank)<br /><br />

<a href="#" style="color:#FF6600"  onClick="confirm2()" ><b>Revert Total Contacts of this Member</b></a> </div></div>
                
              </div>
              
              <div class="span5">
              	<div class="control-group">
                    <div class="control-label"><label>Country </label></div>
					<div class="controls"><input name="country" type="text" class="input" value="<?php echo $row['country'];?>"   /></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><label>City </label></div>
					<div class="controls"><input name="city" type="text" class="input" value="<?php echo $row['city'];?>"   /></div>
                </div>
                <div class="control-group">
                    <div class="control-label"><label>State </label></div>
					<div class="controls"><input name="state" type="text" class="input" value="<?php echo $row['state'];?>"   /></div>
                </div>
                 <div class="control-group">
                    <div class="control-label"><label>Status </label></div>
					<div class="controls"><select name="pstatus" class="input">
                                  <option value="" selected="">Select</option>
                                  <option  value="0" <?php if($row['status2']=="0")echo 'selected="selected"';?>>Inactive</option>
                                  <option  value="1" <?php if($row['status2']=="1")echo 'selected="selected"';?>>Active</option>
                                  <option  value="2" <?php if($row['status2']=="2")echo 'selected="selected"';?>>Blocked</option>
                             </select></div>
                </div>
                 <div class="control-group">
                    <div class="control-label"><label>Total Contacts </label></div>
					<div class="controls"><?php echo contactscount($row['id']);?></div>
                </div>
                 
                
              </div>  
              
            </div>
                
        </div>
	</div>
	
	
	</div><!-- end contact details form -->
    </div>
   	
    
    	<hr class="mN"> 
    <div class="custom-adn grayBackground nobL nobR">   
    <div class="ui-accordion">
	<h3><b>Comments</b></h3> 
    <div class="form-horizontal">
		<div class="filedsetInner clearfix">
        	
            <div class="row-fluid">
    
     <div class="control-group">
                    <div class="control-label">
                      <label>Admin Comments :</label></div>
					<div class="controls"><textarea name="comments"  class="input" cols="20" rows="4"  style="WIDTH: 350px;"><?php echo $row['comments'];?></textarea></div>
                </div>	
                </div></div></div></div></div>
       <div class="form-actions">
				
                <div class="actionButtons">
                <input class="button2 btn btn-primary" name="send" type="submit"   value=" Update " />
				<a href="members.php" class="btn btn-inverse" >Cancel</a>
                </div>
			</div> 
            </form>
            
									   
									    </td>
                                     </tr>
                                   </table>
                                   <?php include("includes/footer.php");?> 
</body>
</html>