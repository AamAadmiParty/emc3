<?php
include("includes/app_top.php");
$getid = getid('id');
$stcat='Admin';
checkAdminLogin();
$pagetitle="States";

?>
<?php include("includes/styles.php");?>
</head>
<body>
<?php include("includes/header.php");?>
<?php include("includes/side-bar.php");?>

        
        <div class="pageHeadingBlock ">
        	<div class="grayBackground">
            <div class="fR t-r clearfix">
              <a href="manage-state.php" class="btn btn-primary coursesMenu">Add  State</a>
            </div>
        	<h3 class="title">States</h3>
            
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
                
                <td ><form name="search" method="post" action="states.php?action=filter" onSubmit="return validate4(this)"><strong>Keyword :</strong>
                <input type="text" name="keyword" id="keyword" class="input coursesMenu" value="<?php if($action=='filter')echo $_POST['keyword'];?>"/>
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
                                  <th  >State  Name</th>
                                  
                                  <th width="60">View</th>
                                  <th width="66">Action</th>
                                </tr>
                                </thead>
			                                <?php         
                                             $sql="SELECT  * FROM  `states` where 1";  
											 if($action=="filter")
	{
	$keyword=cleanQuery($_POST['keyword']);
	$sql= $sql." and name like '%".$keyword."%'"; 
	}
	$sql=$sql." order by name"; 
                      $result=mysqli_query($mysqli, $sql);
					 
					  if(mysqli_num_rows($result) == 0)
                                           {
                                       ?>
                                <tr>
                                  <td  class="norecords" colspan="5">No States</td>
                                </tr >
                                <?php  }								  
                                        $cnt=0; 
                                           while($row=mysqli_fetch_assoc($result))
                                           {    $cnt++;
                                       ?>
                                <tr>
                                  <td ><?php  echo $cnt; ?></td>
                                  <td><a href="innerpages.php?stateid=<?php echo $row['id'];?>"><?php echo $row['name']; ?></a></td>
                                  
                                  <td><a href="../loksabha2014/?campaign=<?php echo ($row['sitename']!="")?$row['sitename']:'#'; ?>" target="_blank"><i class="icon-eye-open"></i></a></td>
                                  <td><a href="manage-state.php?id=<?php  echo $row['id'];?>" title="Edit"><i class="icon-pencil"></i></a>
								  <a href="#" class="statedelete" id="<?php echo $row['id'];?>" title="Delete"><i class="icon-trash"></i></a>
								  </td>
                                </tr>
                                <?php  } 										  
                                       ?>
            </table></td>
                  </tr>
                
                
                </table> 
               
	<?php include("includes/footer.php");?>
</body>
</html>
