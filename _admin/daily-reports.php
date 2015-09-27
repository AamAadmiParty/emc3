<?php
include("includes/app_top.php");
$pcat="Miscellaneous";
$pagetitle="Daily Reports";
$getid = getid('id');
checkAdminLogin();
checkState();
?>
<?php include("includes/styles.php");?> 
<?php include("includes/colorbox.php");?> 
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>
 <div class="pageHeadingBlock ">
        	<div class="grayBackground">
             
        	<h3 class="title">Daily Reports</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
        <div class="grayBackground nobL nobR">
        
        <div id="filterReg" class="ui-accordion">
	    <h4><b>Filter Registrations</b></h4>
	    <div>
		<div class="filedsetInner clearfix">
               
                    <div class="row-fluid">
                    <form name="search" method="post" action="daily-reports.php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
                        	
                            <div class="span3">
                            	<label for="from" >Date of Registration </label>
									<div class="row-fluid">
                                    <span class="span5">
                                    <?php if($action=="show")
						  { $date1=$_POST['date1'];$date2=$_POST['date2'];  } else { 
$date1=date("Y-m-d",strtotime("-9 days", strtotime($date2)));}
						  ?>
                                    <input type="text" name="date1" id="date1" class="span12 datepicker" placeholder="From" value="<?php echo $date1;?>"></span>
                                    <span class="span2"><div class="tC p_b sml">to</div></span>
                                    <span class="span5"><input type="text" name="date2" id="date2" class="span12 datepicker" placeholder="To" value="<?php echo $date2;?>"> </span>
                                    </div>
                            </div>
                             
                            
                        <div class="clearfix span5"><button class="btn btn-primary filterAction">Search</button> <a class="btn btn-inverse filterAction wC" href="<?php echo $pagename;?>">Clear</a> </div></form>
                    </div>
               </div>
	</div>
</div>
        </div>
        <div class="clearfix sepH_b"></div>
     <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    
    
   <td width="33%">
<?php 
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1  and date(contactdate) ='".$date2. "' and userid !=0"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and date(contactdate) ='".$date2. "' and userid !=0 and iscalled=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and date(contactdate) ='".$date2. "' and userid !=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=2 and date(contactdate) ='".$date2. "'"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=3 and date(contactdate) ='".$date2. "'"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=4 and date(contactdate) ='".$date2. "'"));
$r7=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=5 and date(contactdate) ='".$date2. "'"));

?></td>
  </tr>
</table>
   
<br />
 <?php 
 
$datediffno=datediff($date2,$date1);
if($datediffno<=0)
{?>
                  <p class="norecords">No Contacts <?php if($action=="show")echo ' with this filter.';?></p>

<?php }
else
{
?>
<table class="table table-hover  table_vam table-black" width="400">
    	<thead>
        <tr>
        <th width="50">S.no</th>
        <th width="100">Date</th>
        <th >Vote - Yes</th>
        <th>Vote - No</th>
        <th >Vote - Undecided</th>        
        <th>Wrong Calls</th>
          <th >Not Reached Calls</th>
        <th >Calls Contacted </th>        
        <th>Call Later</th>
         
		</tr>
        </thead>
        <?php 
$contactdate=$date2;
for($i=0;$i<=$datediffno;$i++)
{
$contactdate2=date("Y-m-d",strtotime("-$i days", strtotime($contactdate)));
$r1=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=1  and date(contactdate) ='".$contactdate2. "' and userid !=0"));
$r2=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=0 and date(contactdate) ='".$contactdate2. "' and userid !=0 and iscalled=1"));
$r3=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where vote=2 and date(contactdate) ='".$contactdate2. "' and userid !=0"));
$r4=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=2 and date(contactdate) ='".$contactdate2. "'"));
$r5=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=3 and date(contactdate) ='".$contactdate2. "'"));
$r6=mysqli_fetch_assoc(mysqli_query($mysqli, "SELECT count(id) as cnt from ".$tablename." where iscalled=4 and date(contactdate) ='".$contactdate2. "'")); 
                               ?> 
        <tr>
        	<td ><?php echo $i+1; ?></td>
        	<td ><?php echo $contactdate2;?></td>
            <td ><?php echo $r1['cnt'];?></td>
            <td ><?php echo $r2['cnt']; ?></td>
              <td ><?php echo $r3['cnt']; ?></td>
            <td ><?php echo $r4['cnt']; ?></td>
            <td ><?php echo $r6['cnt']; ?></td> 
            <td><?php echo number_format($r1['cnt']+$r2['cnt']+$r3['cnt']+$r4['cnt']+$r6['cnt']+$r7['cnt']);?></td>
<td ><?php echo $r5['cnt'];?></td>			           
        </tr> 
        <?php } ?>
    </table>
 
<?php } ?>



	<?php include("includes/footer.php");?>
</body>
</html>
