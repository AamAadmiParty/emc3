<?php 
$_SESSION['pagingid']="";
 if(isset($_GET['page'])=="")									 
											$page=1;
                                           else
										   $page=$_GET['page'];
											
                                            $from=($page-1)*$record_per_page;
											$cnt=$from;
											$total_pages=0;
											$total_record=numrows($sql);
											 
									if($total_record>0)
									{     
                                            $total_pages=($total_record/$record_per_page);
                                            $total_pages=Ceil($total_pages);
                                            $total_page_set=($total_pages/$page_per_set);
                                            $total_page_set=Ceil($total_page_set);
											 $sql=$sql . " limit ".$from.",".$record_per_page;
											 }
?>