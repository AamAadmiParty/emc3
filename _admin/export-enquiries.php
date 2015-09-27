<?php
include ("includes/app_top.php");
checkAdminLogin();
checkState();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=enquiries.xls");
header("Pragma: no-cache");
header("Expires: 0");
// Install the DB module using 'pear install DB'
$sql="select * from enquiries order by id desc";  
                $result=mysqli_query($mysqli, $sql);
			  if(mysqli_num_rows($result) == 0)
                                           {
										   echo "No Enquiries"; 
										   exit();
										   } 
$csv_fields = array("Name","Email","Message","Date Came","Status","Admin Comments");
$csv_fields2 = array("name","email","comments","datesent","status2","admincomments");
$csv_fieldsizes=array(100,150,250,100,80,250);

$rows = array();
while ($row = mysqli_fetch_assoc($result))
{
  $rows[] = $row;
}
$no=sizeof($csv_fields);
print "<?xml version=\"1.0\"?>\n";
print "<?mso-application progid=\"Excel.Sheet\"?>\n";
?>

<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet"
  xmlns:o="urn:schemas-microsoft-com:office:office"
  xmlns:x="urn:schemas-microsoft-com:office:excel"
  xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet"
  xmlns:html="http://www.w3.org/TR/REC-html40">
  <DocumentProperties    xmlns="urn:schemas-microsoft-com:office:office">
    <Author><?php echo $sitename;?></Author>
    <LastAuthor>TAGC</LastAuthor>
    <Created>2005-08-02T04:06:26Z</Created>
    <LastSaved>2005-08-02T04:30:11Z</LastSaved>
    <Company>TAGC</Company>
    <Version>11.6360</Version>
  </DocumentProperties>
  <ExcelWorkbook  xmlns="urn:schemas-microsoft-com:office:excel">
    <WindowHeight>8535</WindowHeight>
    <WindowWidth>12345</WindowWidth>
    <WindowTopX>480</WindowTopX>
    <WindowTopY>90</WindowTopY>
    <ProtectStructure>False</ProtectStructure>
    <ProtectWindows>False</ProtectWindows>
  </ExcelWorkbook>
  <Styles>
    <Style ss:ID="Default" ss:Name="Normal">
  <Alignment ss:Vertical="Bottom"/>
  <Borders/>
  <Font/>
  <Interior/>
  <NumberFormat/>
  <Protection/>
  </Style>
    <Style ss:ID="s22" ss:Name="Hyperlink">
   <Font ss:FontName="Calibri" x:Family="Swiss" ss:Size="11" ss:Color="#0000FF"
    ss:Underline="Single"/>
  </Style>
    <Style ss:ID="s23">
  <Font x:Family="Swiss" ss:Color="#000000" ss:Bold="1"/>
  <Interior ss:Color="#cccccc" ss:Pattern="Solid"/>
  </Style>
  </Styles>
  <Worksheet ss:Name="Enquiries">
    <Table ss:ExpandedColumnCount="<?php echo $no;?>"  ss:ExpandedRowCount="<?php echo count($rows) + 1;?>"  x:FullColumns="1" x:FullRows="1">
       <?php
	   foreach ($csv_fieldsizes as $key => $value) { ?>
      <Column ss:Index="<?php echo $key+1;?>" ss:AutoFitWidth="0" ss:Width="<?php echo $value;?>"/>
<?php }	   ?>      
      <Row ss:StyleID="s23">
       <?php
	   foreach ($csv_fields as $key => $value) { ?>
        <Cell>
          <Data ss:Type="String" ><?php echo $value;?></Data>
        </Cell>
<?php }
	   ?>
      </Row>
    
      <?php
	  $cnt=0;
	   foreach ($rows as $row) {?>
      <Row>
        <?php
		$cnt++; 
	  $csv_output_r = array();
for($i=0;$i<$no;$i++)
{
$ss=$csv_fields2[$i];
if($ss=='status2')
$csv_output_r[$i] = ($row[$ss]==1)?'Yes':'No';
else 
$csv_output_r[$i] = preg_replace('/[^@#\*$a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $row[$ss]);
}

		foreach ($csv_output_r as $key => $value) { ?>
        <Cell>
          <Data ss:Type="String"><?php echo $value;?></Data>
        </Cell>
<?php } ?>       
      </Row><?php }?>
    </Table>
    <WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
      <Print>
        <ValidPrinterInfo/>
        <HorizontalResolution>300</HorizontalResolution>
        <VerticalResolution>300</VerticalResolution>
      </Print>
      <Selected/>
      <Panes>
        <Pane>
          <Number>3</Number>
          <ActiveRow>1</ActiveRow>
        </Pane>
      </Panes>
      <ProtectObjects>False</ProtectObjects>
      <ProtectScenarios>False</ProtectScenarios>
    </WorksheetOptions>
  </Worksheet>
</Workbook>
