<?php
include ("includes/app_top.php");
checkAdminLogin();
checkState();
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=contacts.xls");
header("Pragma: no-cache");
header("Expires: 0");

$sql=$_SESSION['sql'];  
                $result=mysqli_query($mysqli, $sql);
			  if(mysqli_num_rows($result) == 0)
                                           {
										   echo "No Contacts"; 
										   exit();
										   } 
// Install the DB module using 'pear install DB'
$csv_fields = array("UserName","UserID","Contact","Vote","Date Called","Comments");
$csv_fields2 = array("name","userid","contact","vote","contactdate","comments");
$csv_fieldsizes=array(150,100,100,100,150,300);

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
    <LastAuthor>Mission c3</LastAuthor>
    <Created>2005-08-02T04:06:26Z</Created>
    <LastSaved>2005-08-02T04:30:11Z</LastSaved>
    <Company>Aam Aadmi Party USA</Company>
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
  <Worksheet ss:Name="Contacts">
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
if($ss=='vote')
$csv_output_r[$i]=$vote4aap[$row['vote']];
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
