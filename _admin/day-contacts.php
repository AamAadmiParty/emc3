<?php
include("includes/app_top.php");
$pcat="Members";
$pagetitle="Day Contacts";
$getid = getid('id');
$mid = getid('mid');
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
            <div class="fR t-r p_b">
            <a href="export-members.php">Export Details to Excel</a>
            </div>
        	<h3 class="title">Day Contacts</h3>
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
                    <form name="search" method="post" action="day-".$tablename.".php?action=show" onSubmit="return validatefilter(this)" class="coursesMenu">
              <div class="span3"><?php if($action=="show")
						  { $keyword=cleanQuery($_POST['keyword']);$date1=cleanQuery($_POST['date1']);} else { $keyword="";$date1=$date2;}?>
                <label>Keyword </label>
                <input type="text" name="keyword" id="keyword" placeholder="City / Phone No"   value="<?php echo $keyword;?>"/></div>
                <div class="span2">
                    <label>Date</label>
                     <input type="text" name="date1" id="date1" class="datepicker" style="width:70px"  value="<?php echo $date1;?>"/>
                     </div>
                     <div class="clearfix">
                   <button class="btn btn-primary filterAction">Search</button> <a href="<?php echo $pagename;?>" class="btn btn-inverse filterAction wC">Clear</a></button> </div>
                  </form>
                    </div>
               </div>
	</div>
</div>
        </div>
        <div>

        <?php 
				  if($page=="")
						  {
				$sql="
				SELECT
  `users`.`name`, ".$tablename.".*, `categories`.`catname`
FROM
  ".$tablename." INNER JOIN
  `users` ON `users`.`id` = ".$tablename.".`userid` INNER JOIN
  `categories` ON ".$tablename.".`catid` = `categories`.`id`  where ".$tablename.".userid!=0";
						    if($action=="show")
						  {
						  if($keyword!="")
						  $sql=$sql . " and (".$tablename.".contact='".$keyword."' or  users.name='".$keyword."')";
						 }						 
						   if($mid!='')
                       $sql = $sql." and ".$tablename.".userid=".$mid;
						else if($date1!='')						   
                       $sql = $sql." and date(".$tablename.".contactdate)='".$date1."'";
						  $_SESSION['sql']=$sql;
						 }						 
						 else
						 $sql=$_SESSION['sql'];
						 $sql=$sql." order by ".$tablename.".contactdate desc, users.name";
						 
							 
				include("includes/paging2.php");  
			 
				$res=mysqli_query($mysqli, $sql); 
			
              ?>
        <table width="100%"  class="table table-hover  table_vam table-black">
                           <thead>
                           <tr>
                           	<th>No.</th>
                            <th>User Name</th>
                            <th> Date Taken</th>
                             <th>Contact No</th>
                             <th>Is Called</th>
                             <th>Vote?</th>
                             <th>Comments</th>
                             <th>Action</th>
                             </tr>
                           </thead>
                           <?php 
                           if(mysqli_num_rows($res) == 0)
                                           {
                                       ?>
                                <tr>
                                  <td  class="norecords" colspan="7">No Contacts <?php if($action=="show")echo " with this filter";?></td>
                                </tr >
                                <?php  }  
								 while($row=mysqli_fetch_assoc($res))
                                           {  $cnt++;
                                       ?>
                           <tr>
                              
                             <td><?php  echo $cnt; ?></td>
                             <td > <a href="view-member-details.php?id=<?php echo $row['userid'];?>"  class="details" rel="colorbox2"><?php echo $row['name']; ?></a></td>
                             <td ><?php echo $row['contactdate']; ?></td>
                             <td ><?php  echo $row['contact']; ?></td>
                             <td><?php  echo $getconnected[$row['iscalled']];?></td>
                             <td><?php  echo $row['vote'];?></td>

                             <td ><?php echo $row['comments'];?></td>
                                                     <td><a href="view-contact-details.php?id=<?php echo $row['id'];?>"  class="details" rel="colorbox"><i class="icon-eye-open"></i></a>&nbsp;&nbsp;
                             <?php if($mid!='') {?>
                             <a href="edit-contact-details.php?id=<?php  echo $row['id'];?>" title="Edit" class="details" rel="colorbox3"><i class="icon-pencil"></i></a>&nbsp;&nbsp;
                             	<a href="#" class="ucdelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
							 <?php }?>
                             </td>
                             
                           </tr>
                           <?php    } 										  
                                       ?>
                                       </table>    
									  <?php
include("includes/paging.php"); ?>             
	<?php include("includes/footer.php");?>
</body>
</html>
