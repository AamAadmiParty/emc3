<?php
include("includes/app_top.php");
$pcat="Website";
$pagetitle="Inner Pages";
$getid = getid('id');
$stateid = getid('stateid');
if($stateid!='')
$_SESSION['stateid']=$stateid;
checkAdminLogin();
checkState();
?>
<?php include("includes/styles.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>

        
        <div class="pageHeadingBlock ">
        	<div class="grayBackground">
            <div class="fR t-r spcT_c">
            <a href="manage-innerpage.php" class="btn btn-primary coursesMenu">Add  Page</a>
            </div>
        	<h3 class="title">Inner Pages</h3>
            <div class="sectionTabNav">
            	<?php echo $tab_website;?>
            </div>
        	</div>
        </div>
        
        <div class="clearfix sepH_b"></div>
       
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="text12">
          <tr>
                    <td><div id="messages"> 
                        <?php
if($action1=="err") { echo '<div class="alert alert-error">Something Error. </div>';}?></div></td>
                  </tr>
         <tr>
            <td height="50"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                
                <td ><form name="search" method="post" action="innerpages.php?action=filter" onSubmit="return validate4(this)"><strong>Keyword :</strong>
                <input type="text" name="keyword" id="keyword" class="input coursesMenu" style="width:150px"  value="<?php if($action=='filter')echo $_POST['keyword'];?>"/>
                 &nbsp; <input type="submit" name="register" value="Search" id="Button1" class="btn btn-primary" />
                  <a href="<?php echo $pagename;?>" class="btn btn-inverse" >Clear</a>
                </form></td>
                
              </tr>
            </table></td>
          </tr> <tr>
           
                    <td><table width="100%"  class="table table-hover  table_vam table-black">
                                <thead>
                                <tr>
                                  <th width="34" align="center" >No.</th>
                                  <th  >Page  Name</th>
                                  
                                  <th width="60">View</th>
                                  <th width="66">Action</th>
                                </tr>
                                </thead>
			                                <?php         
                                             $sql="SELECT  * FROM  `innerpages` where state_id=".$stateid;  
											 if($action=="filter")
	{
	$keyword=cleanQuery($_POST['keyword']);
	$sql= $sql." and innerpages.heading like '%".$keyword."%'"; 
	}
	else
	
	$sql=$sql." order by innerpages.heading"; 
											  include("includes/paging2.php"); 
                                            $result=mysqli_query($mysqli, $sql);	 
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                                <tr>
                                  <td  class="norecords" colspan="5">No Innerpages</td>
                                </tr >
                                <?php  }
								  
                                         
                                           while($row=mysqli_fetch_assoc($result))
                                           {    $cnt++;
                                       ?>
                                <tr>
                                  <td ><?php  echo $cnt; ?></td>
                                  <td style="text-align:left"><?php echo $row['heading']; ?></td>
                                  
                                  <td><a href="../loksabha2014/<?php echo ($row['filename']!="")?$row['filename']:'#.php'; ?>?campaign=<?php echo $sitename;?>" target="_blank"><i class="icon-eye-open"></i></a></td>
                                  <td><a href="manage-innerpage.php?id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
								  <a href="#" class="pagedelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
								  </td>
                                </tr>
                                <?php  } 										  
                                       ?>
            </table></td>
                  </tr>
                
                  <tr>
                    <td style="padding:12px 0"><?php
include("includes/paging.php"); ?>                    </td>
                  </tr> 
                </table> 
                
	<?php include("includes/footer.php");?>
</body>
</html>
