<?php 
$currentpage=curPageName();
$pagingid = isset($_SESSION['pagingid']) ? $_SESSION['pagingid'] : '';

$ss=($pagingid=='')?'?':'&';
$pagingid=$pagingid.$ss;
$currentpage=$currentpage . $pagingid;

if($total_pages>1)
{
?>

<div id="paging" style="width:400px; float:left">

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
													  echo " <a   href='".$currentpage."page=1'>&lt;&lt;</a>";

}

                                                      if ($page>1)
													 { 
													  $str = $str . "<a href='".$currentpage."page=" . ($page-1) . "'>&lt;</a>";												 
															}
													 
                                                     for($x=$start;$x<=$end;$x++)
                                                     {
													 if($x==$page)
													 $str .= "<span class='active'>".$x."</span> ";
														 else
														 $str .="<a   href='".$currentpage."page=".$x."'>$x</a> ";
                                                     }
                                                     if ($page < $total_pages)
													 {
                                                      $str .=" <a   href='".$currentpage."page=" . ($page+1) . "'>&gt;</a>";
													  }
													    if ($page < $total_pages && $end<$total_pages)
													 {
													  $str .=" <a   href='".$currentpage."page=" . ($total_pages) . "'>&gt;&gt;</a>";
													  }

                                                echo $str;
												$to=$from+$record_per_page;
												if($to>$total_record)$to=$total_record;

                                            ?> </div>
											
											<div style="float:right; width:150px; text-align:right" >View <?php echo $from+1;?>-<?php echo $to;?> of <?php echo $total_record;?></div> 
                                            <?php }?>