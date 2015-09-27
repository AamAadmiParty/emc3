<?php 
$currentpage=curPageName();
$pagingid = isset($_SESSION['pagingid']) ? $_SESSION['pagingid'] : '';

$ss=($pagingid=='')?'?':'&';
$pagingid=$pagingid.$ss;
$currentpage=$currentpage . $pagingid;
if($total_pages>1)
{
?>

<div id="paging" class="pagination pagination-centered" style="width:400px; float:left">
<ul>
               

                                                <?php                                                     if($total_pages != 0)
                                                    {
                                                                                                  }

                                                    $str="";

                                                 $diff=$total_pages-$page_per_set;

                                                 if ($diff>0)
                                                 {
                                                   $start=$page - floor($page_per_set/2);
                                                     if ($start <= 0)
                                                     {
                                                       $start=1;
                                                       $end=$start+$page_per_set-1;
                                                     }
                                                     else
                                                     {
                                                       $start=$page - floor($page_per_set/2);
                                                       $end=$start+$page_per_set-1;
                                                       if ($end > $total_pages)
                                                       {
                                                       $end=$total_pages;
                                                       $start=$end-$page_per_set+1;
                                                       }
                                                     }

                                                 }
                                                 else
                                                 {
                                                   $start=1;
                                                   $end=$total_pages;
                                                 }


if($total_pages>1&&$page>$page_per_set-1)
{
													  echo "<li> <a   href='".$currentpage."page=1'>&laquo;</a> </li>";

}

                                                      if ($page>1)
													 { 
													  $str = $str . "<li> <a href='".$currentpage."page=" . ($page-1) . "'>&lsaquo;</a> </li>";												 
															}
													 
                                                     for($x=$start;$x<=$end;$x++)
                                                     {
														 
													 
													 if($x==$page)
													 
                                                     {
                                                     
													 $str .= "<li class='active'><span class='active'>".$x."</span> </li>";
													 
													 }
														 else
														 $str .="<li> <a   href='".$currentpage."page=".$x."'>$x</a> </li>";
														 
                                                     }
													 
                                                     
                                                     if ($page < $total_pages)
													 {
                                                      $str .="<li> <a   href='".$currentpage."page=" . ($page+1) . "'>&rsaquo;</a> </li>";
													  }
													    if ($page < $total_pages && $end<$total_pages)
													 {
													  $str .="<li> <a   href='".$currentpage."page=" . ($total_pages) . "'>&raquo;</a> </li>";
													  }
													  

                                                echo $str;
												$to=$from+$record_per_page;
												if($to>$total_record)$to=$total_record;
												
													

                                            ?> </ul></div>
											
											<div  class="pull-right dataTablesInfo" >Showing <?php echo $from+1;?> to <?php echo $to;?> of <?php echo $total_record;?> entries</div> 
                                            <?php }?>