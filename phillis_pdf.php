<?php
// ***************************************************************
// *
// * 	Uses fpdf library for PHP.  A fabulous utility for creating
// *     pdf documents without having to have the pdf libraries
// *		installed on the server.  visit www.fpdf.org for details
// *
// ***************************************************************
// Location of font files and get the fpdf library
/*
    METHOD 1
    ImageMagick: identify -density 12 -format "%p" image.pdf
    METHOD 2
    FPDI (when setting the source file you get back the page count):
    http://www.setasign.de/products/pdf-php-solutions/fpdi/demos/thumbnails/
    METHOD 3
    Open the pdf as a text file and count the number of times "/Page" occurs.
    function count_pages($pdfname) {
    $pdftext = file_get_contents($pdfname);
    $num = preg_match_all("/\/Page\W/", $pdftext, $dummy);
    return $num;
    }
*/    
require_once("../../class2.php");
$arr = explode('.', e_QUERY);
if(!e107::isInstalled('pdf') || !e_QUERY || $arr[0]=="")
{
//
//	header('Location: '.e_BASE.'index.php');	
	e107::redirect();
	exit;
}

//define('K_PATH_FONTS', e_PLUGIN.'pdf/fonts/');
/////////////////////////define('FPDF_FONTPATH', '../pdf/font/');
////////include_once(e_PLUGIN.'phil_lis/phillis_func.php');
//    $arr = explode('.', e_QUERY);
//if ($arr[0] == "") {
//	header("location:".e_BASE."index.php");
//	 exit;
//}
/*
if (($arr[0] == "") || 
{
	e107::redirect();
	exit;
}
*/
//    $phillis_temp = explode(".", $arr[1]);
//    $phillis_from = intval($phillis_temp[0]);
    define('K_PATH_FONTS', e_PLUGIN.'pdf/fonts/');
    $phllist_Action = $arr[0];
    $phillis_userid = intval($arr[1]);
//$phillis_purl= "http://".$_SERVER['HTTP_HOST'].e_HTTP.e_PLUGIN."phil_lis/phillis.php?".e_QUERY;
require_once(e_PLUGIN.'pdf/e107pdf.php');	//require the e107pdf class
/////////////////////$pdf = new e107PDF();

/*
require(e_PLUGIN . "pdf/fpdf.php");
require(e_PLUGIN . "pdf/ufpdf.php");
require(e_PLUGIN . 'pdf/e107pdf.php');
require (e_PLUGIN . "phil/fpdi/fpdi.php");
*/
/////include_lan(e_PLUGIN . "phil_lis/languages/" . e_LANGUAGE . ".php");
e107::lan('phil_lis',"front", true);
require_once (e_PLUGIN . "phil/pdf_class_string_tags.php");
if (!defined("PARAGRAPH_STRING"))
    define("PARAGRAPH_STRING", "~~~");
//$phalbuns_pdfbookid = e_QUERY;
if (class_exists("e107PDF"))
{
//UPDATE STATS
/*- FICA DESLIGADO, AINDA NAO EXISTE TABELA PARA ISTO NAS LISTAS
    $sql->db_Update("pa_book", "pa_book_pdfs=pa_book_pdfs+1 where pa_book_id=$phillis_pdfbookid", false);
    if (USER)
    {
        $phillis_pdfvlist = USERID ;
    }
    else
    {
        $phillis_pdfvlist = $e107->getip() ;
    }
    $phillis_pdfvlisting = $phillis_pdfvlist . ",";
    $sql->db_Update("pa_book", "pa_book_uniquepdf=pa_book_uniquepdf+1,
	pa_book_pdfrs=if(pa_book_pdfrs,concat(pa_book_pdfrs,'{$phillis_pdfvlisting}'),'{$phillis_pdfvlisting}')
	where (isnull(pa_book_pdfrs) or not find_in_set('{$phillis_pdfvlist}',pa_book_pdfrs))  and pa_book_id=$phillis_pdfbookid", false);
-*/
    class phillis_PDF extends e107PDF
    {
    var $stampline = array();
    var $stamplineY;
    var $wt_Current_Tag;
    var $wt_FontInfo;      //tags font info
    var $wt_DataInfo;      //parsed string data info
    var $wt_DataExtraInfo; //data extra INFO
    var $wt_TempData;      //some temporary info
    var $titulo_Y;
    var $titulo_font;
    var $titulo_size;
    var $titulo_text;
    var $extgstates;
    // ################################# Initialization
    var $wLine; // Maximum width of the line
    var $hLine; // Height of the line
    var $Text;  // Text to display
    var $border;
    var $align; // Justification of the text
    var $fill;
    var $Padding;
    var $lPadding;
    var $tPadding;
    var $bPadding;
    var $rPadding;
    var $TagStyle;      // Style for each tag
    var $Indent;
    var $Space;         // Minimum space between words
    var $PileStyle;
    var $Line2Print;    // Line to display
    var $NextLineBegin; // Buffer between lines
    var $TagName;
    var $Delta;         // Maximum width minus width
    var $StringLength;
    var $LineLength;
    var $wTextLine; // Width minus paddings
    var $nbSpace;   // Number of spaces in the line
    var $Xini;      // Initial position
    var $href;      // Current URL
    var $TagHref;   // URL for a cell
		var $sLeft;
		var $sTop;
		var $sRight;
		var $sBottom;
    // ################################# Public Functions
/*
    function PDF($orientation = 'P', $unit = 'mm', $format = 'A4')
        {
        parent::FPDI($orientation, $unit, $format);
    // ################################# Public Functions
*/
    function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false)
        {
//  var_dump(class_exists('FPDI', false));

//      parent::FPDI($orientation, $unit, $format);
      parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache);

/*        $this->$sLeft = 2;
        $this->$sTop = 2;
        $this->$sRight = 2;
        $this->$sBottom = 1;*/
        $this->extgstates=array();

//        $this->titulo_font="arial";

        $this->titulo_font="Helvetica";

        $this->titulo_size="10";
        $this->titulo_text="";
        $this->SetDisplayMode('default', 'default');
        }
/*
    function AddPage($orientation = 'P', $format = 'A4', $template = 'blank')
        {
        parent::AddPage($orientation, $format);
        $this->setSourceFile(e_PLUGIN . 'phil_alb/templates/' . $template . '.pdf');
//        $this->setSourceFile('/tmplt/' . $template . '.pdf');
        switch ($template) {
          case "reiper1d" :
            if($this->PageNo()==1)
              {
                //First page
                $this->useTemplate($this->importPage(1), 0, 0, $this->w, $this->h);
              }
            else
              {
                //Other pages
                $this->useTemplate($this->importPage(2), 0, 0, $this->w, $this->h);
              }        
            break;
          default:
            $this->useTemplate($this->importPage(1), 0, 0, $this->w, $this->h);
        }
        }
*/
function Header()
{
////    $cab = $plpdf->cab_faltas(pdf);
////    $cab = $this->cab_faltas(pdf);
//    global $phillis_caption, $phillis_username, $datam;
    global $phillis_pdfcaption, $datam;
//    global $cab;
    //Logo
//    $this->Image('logo_pb.png',10,8,33);
    //Arial bold 15
//    $this->SetFont('Arial','B',13);
//    $margin = $this->getMargins();
//    $this->SetY($margin['top']);
    $this->SetFont('Helvetica','B',13);
    $this->SetTextColor( 100, 50, 50);
    //Move to the right
//    $this->Cell(40);
    //Title
//    $this->WriteHTML($plpdf->cab_faltas(pdf)."<hr>", $html);
//    $temp = $cab[0]."\n".$cab[1];
//    $this->Cell(0,5,$phillis_caption.LAN_PLUGIN_PHILLIS_37.strip_tags($phillis_username),0,1,'C');
    $this->Cell(0,5,strip_tags($phillis_pdfcaption),0,1,'C');
//    $this->Cell(0,5,$cab[0].LAN_PLUGIN_PHILLIS_37.$cab[1],0,1,'C');
//    $this->Ln();
//    $this->SetFont('Arial','',11);
    $this->SetFont('Helvetica','',11);
//    $this->Cell(0,5,$cab[2],0,1,'C');
    $this->Cell(0,5,($datam>0?"(".LAN_PLUGIN_PHILLIS_100 ." ".$datam.")":""),0,1,'C');
//    $this->Write( 4, $cab[0]);
//    $this->Ln();
//    $this->Write( 4, $cab[1]);
//    $this->Ln();
//    $this->SetFont('Arial','B',11);
    $this->SetFont('Helvetica','B',11);
    $this->SetFillColor(255,255,0);
    $this->Cell(0, 6, utf8_encode("NUMERA��O AFINSA"), 0, 0, 'C', true);
    $this->WriteHTML("<hr>");
//    $this->Cell(30,10,'Title',1,0,'C');
    //Line break
//    $this->Ln();
}
//Page footer
function Footer()
{
    global $phllist_Action;
//    $this->SetTextColor( 100, 50, 50);
    //Position at 1.5 cm from bottom
//////    $this->SetY(-20);
    //Arial italic 8
//    $this->SetFont( 'Arial', '', 8);
    $this->SetFont( 'Helvetica', '', 8);
    $this->SetTextColor( 0, 0, 0);
    if ($this->lastpage) {
    $phillis_purl= "http://".$_SERVER['HTTP_HOST'].e_HTTP.e_PLUGIN."phil_lis/phillis.php?".e_QUERY;
    $this->WriteHTML(LAN_PLUGIN_PHILLIS_02." ".SITENAME.' :<A HREF="'.$phillis_purl.'">'.$phillis_purl.'</A>', true);
//    $this->Ln();
//    } else {
//    $this->Ln();
    }
    $this->Ln();
    $this->WriteHTML("<hr>");
//    $this->Ln();
if ($phllist_Action=="u" || $phllist_Action=="n"){
//    $this->SetFont( 'Arial', '', 10);
    $this->SetFont( 'Helvetica', '', 10);
    $this->SetTextColor( 0, 0, 0);
    $this->Cell(20,6,LAN_PLUGIN_PHILLIS_94.": ",0,0,'L');
    $this->SetTextColor(0, 255, 255);
    $this->Cell(35,6,LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92,0,0,'L');
    $this->SetTextColor( 0, 0, 0);
    $this->Cell(30,6,LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_91,0,0,'L');
    $this->SetTextColor( 255, 0, 0);
    $this->Cell(90,6,LAN_PLUGIN_PHILLIS_90." ".LAN_PLUGIN_PHILLIS_92." ".LAN_PLUGIN_PHILLIS_93,0,0,'L');
//    $pagina_cell = 15;
//    $this->Ln();
} 
//else {
//$pagina_cell = 190;}
//    $this->SetFont('Arial','I',8);
    $this->Ln();
    $this->SetFont('Helvetica','I',8);
    //Page number
    $this->SetTextColor( 100, 50, 50);
    $this->Cell(190,6,LAN_PLUGIN_PHILLIS_26." ".$this->getAliasNumPage().' / '.$this->getAliasNbPages(),0,0,'R');
//}//    $this->SetTextColor( 0, 0, 0);
//    $this->WriteHTML($plpdf->leg_faltas(pdf));
}
// Fun��o cell para acomodar texto em v�rias cores....
function CCell($w,$h=0,$txt='',$border=0,$ln=0,$align='',$fill=0,$link='')
{
	//Output a cell
	$k=$this->k;
	if($this->y+$h>$this->PageBreakTrigger && !$this->InFooter && $this->AcceptPageBreak())
	{
		//Automatic page break
		$x=$this->x;
		$ws=$this->ws;
		if($ws>0)
		{
			$this->ws=0;
			$this->_out('0 Tw');
		}
		$this->AddPage($this->CurOrientation);
		$this->x=$x+$this->lMargin;
		if($ws>0)
		{
			$this->ws=$ws;
			$this->_out(sprintf('%.3f Tw',$ws*$k));
		}
	}
	if($w==0)
		$w=$this->w-$this->rMargin-$this->x;
	$s='';
	if($fill==1 || $border==1)
	{
		if($fill==1)
			$op=($border==1) ? 'B' : 'f';
		else
			$op='S';
		$s=sprintf('%.2f %.2f %.2f %.2f re %s ',$this->x*$k,($this->h-$this->y)*$k,$w*$k,-$h*$k,$op);
	}
	if(is_string($border))
	{
		$x=$this->x;
		$y=$this->y;
		if(strpos($border,'L')!==false)
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,$x*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'T')!==false)
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-$y)*$k);
		if(strpos($border,'R')!==false)
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',($x+$w)*$k,($this->h-$y)*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
		if(strpos($border,'B')!==false)
			$s.=sprintf('%.2f %.2f m %.2f %.2f l S ',$x*$k,($this->h-($y+$h))*$k,($x+$w)*$k,($this->h-($y+$h))*$k);
	}
	if($txt!=='')
	{
		if($align=='R')
			$dx=$w-$this->cMargin-$this->GetStringWidth($txt);
		elseif($align=='C')
			$dx=($w-$this->GetStringWidth($txt))/2;
		else
			$dx=$this->cMargin;
		if($this->ColorFlag)
			$s.='q '.$this->TextColor.' ';
			$txt2=str_replace(')','\\)',str_replace('(','\\(',str_replace('\\','\\\\',$txt)));
			$s.=sprintf('BT %.2f %.2f Td (%s) Tj ET',($this->x+$dx)*$k,($this->h-($this->y+.5*$h+.3*$this->FontSize))*$k,$txt2);
		if($this->underline)
			$s.=' '.$this->_dounderline($this->x+$dx,$this->y+.5*$h+.3*$this->FontSize,$txt);
		if($this->ColorFlag)
			$s.=' Q';
		if($link)
			$this->Link($this->x+$dx,$this->y+.5*$h-.5*$this->FontSize,$this->GetStringWidth($txt),$this->FontSize,$link);
	}
	if($s)
		$this->_out($s);
	$this->lasth=$h;
	if($ln>0)
	{
		//Go to next line
		$this->y+=$h;
		if($ln==1)
			$this->x=$this->lMargin;
	}
	else
		$this->x+=$w;
}
// FUN��O PARA CONVERTER PIXELS PARA MM, PARA POSICIONAR AS IMAGENS
    function pixelsToMM($val) {
        return $val * 34 / 96;
    }
    } // FIM DA CLASS
} // FIM DA VERIFICA��O DA CLASS E107PDF
// ...
ini_set('display_errors', 'On');
ini_set('memory_limit','1600M');
require_once(e_HANDLER . "date_handler.php");
//$phillis_conv = new convert;
$pdf = new phillis_PDF();
//////////////////$pdf = new e107PDF();

$pdfpref = $pdf->getPDFPrefs();
// ANTIGO $pdf->SetMargins($pdfpref['pdf_margin_left'], $pdfpref['pdf_margin_top'], $pdfpref['pdf_margin_right']);
////////$pdf->SetMargins($pdfpref['pdf_margin_left'], $pdfpref['pdf_margin_top'], $pdfpref['pdf_margin_right']);
/*
    $margins = $pdf->getMargins();
    var_dump ($margins);
    exit;
*/
$pdf->SetMargins(15, 27.5, 5, 10);
$pdf->SetHeaderMargin(10);
$pdf->SetFooterMargin(25);

$pdf->SetCompression(true);
$pdf->SetCreator(SITENAME);
//$pdf->SetAuthor(SITENAME);
$pdf->getAliasNbPages();
$pdf->getNumPages();
//----------------------------$cab = cab_listas($action, $phillis_userid, pdf);
//////////$phillis_whatdo = 'pdf';
$pdf->SetFont($pdfpref['pdf_font_family'] , '', $pdfpref['pdf_font_size']);

include_once(e_PLUGIN.'phil_lis/phillis_view.php');

//################################################################################
//##### TENTAR USAR A ROTINA CAB, QUE J� TEM ESTAS VARI�VEIS....
/*
    $sql->db_Select("user", "user_name", "user_id = ".$phillis_userid);
    extract($sql->db_Fetch());
switch ($action) {
    case "u":
    case "n":
      $text_string .= phillis_34;
      break;
    case "s":
    case "o":
      $text_string .= phillis_35;
      break;
}
      $title = $text_string;
      $text_string .= phillis_33.LAN_PLUGIN_PHILLIS_110." ";
switch ($action) {
    case "n":
    case "o":
      $text_string .= phillis_19;
      $text_title = phillis_82;
      break;
    case "u":
    case "s":
      $text_string .= phillis_18;
      $text_title = phillis_83;
      break;
}
//################################################################################
*/
//$pdf->SetTitle($tp->toHTML(ucfirst($title)." ".(($action == "u")?phillis_83:(($action == "n")?phillis_82:""))." (".$user_name.")"));
//$pdf->SetTitle($tp->toHTML(ucfirst($title)." ".$text_title." (".$cab[1].")"));
//----------------------------$pdf->SetTitle($tp->toHTML(ucfirst($cab[3])." (".$cab[1].")"));
//$pdf->SetKeywords(phalbuns_P02);
//$pdf->SetSubject($tp->toHTML(phillis_01.LAN_PLUGIN_PHILLIS_33.$text_string));
//----------------------------$pdf->SetSubject($tp->toHTML($cab[0]));
//$pdf->SetSubject($tp->toHTML(phillis_01.LAN_PLUGIN_PHILLIS_33.LAN_PLUGIN_PHILLIS_110." ".(($action == "u")?phillis_18:(($action == "n")?phillis_19:""))));
//$pdf->SetAuthor($user_name);
//----------------------------$pdf->SetAuthor($cab[1]);
//----------------------------$pdf->AliasNbPages();
//----------------------------$pdf->SetFont($pdfpref['pdf_font_family'] , '', $pdfpref['pdf_font_size']);
// *
// * Generate the cover page
// *
// GRAB ALBUM DATA FROM MYSQL
/*
$phllist_Arg = "
	select * from #philalb_book
	left join #philalb_category on pa_book_category = pa_category_id
	left join #philalb_genre on pa_book_genre=pa_genre_id
	left join #philalb_biography on substring_index(pa_book_author,'.',1) = pa_bio_id
	where pa_book_id={$phillis_pdfbookid}";
echo "<hr>SQL: ".$phllist_Arg.">>>";
$sql->db_Select_gen($phllist_Arg, false);
$phillis_row = $sql->db_Fetch();
$data=$phillis_row['pa_book_characters'];
echo "<hr>DATA: ".$data.">>>";
if (!$data)
    {
    die ("Invalid data input");
    }
*/
//$texto="";
//    $plpdf = new phillis_class();
//    $text = "<b>".LAN_PLUGIN_PHILLIS_01.LAN_PLUGIN_PHILLIS_33.$plpdf->cab_faltas(pdf)."</b><br><hr>".$plpdf->faltas(pdf)."<br><hr>".$plpdf->leg_faltas(pdf)."<br><hr>".LAN_PLUGIN_PHILLIS_02." ".SITENAME." (<a href=$phillis_purl>$phillis_purl</a>)";
////    $text = "<b>".LAN_PLUGIN_PHILLIS_01.LAN_PLUGIN_PHILLIS_33.$plpdf->cab_faltas(pdf)."</b><br><hr>";
//    $cab = $plpdf->cab_faltas(pdf);
//    $cab = cab_listas($action, $phillis_userid, pdf);
//----------------------------$pdf->AddPage();
//$pdf->SetTextColor( 100, 50, 50);
//$pdf->SetFont( 'Arial', 'B', 13 );
//$pdf->Cell( 0, 10, phillis_01.LAN_PLUGIN_PHILLIS_33.$plpdf->cab_faltas(pdf), 0, 0, 'C' );
//    $text = $plpdf->faltas(pdf);
//echo $text;
//  $data = $plpdf->faltas(pdf);
//                        var_dump($data);
//                        die();
//    if (preg_match_all('/^(.*)\(([^)]+)\)/m', $data, $m, PREG_SET_ORDER))
//        {
//                        echo "<hr>".$i[0]."<hr>";
//                        var_dump($m);
//                        var_dump($n[1]);
//        foreach ($plpdf->faltas(pdf) as $dt)
// echo "�������������������������<hr>";
//                        var_dump(listas(pdf));
//                        die();
//        foreach (listas(pdf) as $dt)
//----------------------------        foreach ((($action=="u" || $action=="n")?lista_num(pdf):lista_img(pdf)) as $dt)
//        foreach ($data as $key => $value)
//----------------------------            {
//                        var_dump($dt);
//                        echo "<hr>".key($dt)."<hr>";
//                        echo "<hr>".$dt[cab]."<hr>";
//                        die();
//                        echo "<hr>";
//                        echo "<hr>".(preg_match_all('/"(.*?)"/', $i, $n, PREG_PATTERN_ORDER))."<hr>";
//            if (preg_match_all('/"(.*?)"/', $i[2], $n, PREG_PATTERN_ORDER))
//                {
//                        echo "<hr>".$key."<hr>";
//                        echo "<hr>".$value."<hr>";
//                        var_dump($i);
//                        echo "<hr>";
//                        echo "::".$i[1];
//                        var_dump($n);
//----------------------------                switch (key($dt))
//----------------------------                    {
//----------------------------                    case "cab":
//                      echo "<br>";
//                      $text .= "<br>";
//                      foreach ($n[1] as $t)
//                      {
//                        $text .= "<b>".$t." >> </b>";
//                      }
//                        $text .= "<br>";
//----------------------------                        $pdf->Ln(4);
//----------------------------                        $pdf->SetFont( 'Arial', 'BI', 10 );
//----------------------------                        $pdf->SetTextColor( 0, 100, 0);
//----------------------------                        $pdf->SetFillColor(230, 230, 230); // Set background colour to black
//----------------------------                        $pdf->Cell(0, 4, $dt[cab], 0, 0, 'L', TRUE);
//                        $pdf->Write( 5, $dt[cab]);
//----------------------------                        $pdf->Ln(5);
                        ////$text .= "<br>".$dt[cab]."<br>";
//                        die();
//                        $pdf->album_format($n[1]);
//----------------------------                        break;
//----------------------------                    case "img":
//                        var_dump($n);
//----------------------------                        $pdf->SetFont( 'Arial', '', 10 );
//----------------------------                        $pdf->SetTextColor( 0, 0, 0);
//                        $pdf->Write( 4, $dt[img][0]." ");
//                        $pdf->Image("../../e107_plugins/phil/images/miss.jpg", 80 ,22);
//                        $pdf->Write( 4, gettype("../../e107_plugins/phil/images/miss.jpg")." ");
//                        $pdf->Write( 4, gettype($dt[img][0])." ");
// ############ AS IMAGENS FICAM DESLIGADAS POR ENQUANTO....
/*
                        if ($dt[img][0]) {
                            //$pdf->Image($dt[img][0], $pdf->GetX() ,$pdf->GetY());
                            $img_size = getimagesize($dt[img][0]);
                            $W_Src = $img_size[0]; // largeur source
                            $H_Src = $img_size[1]; // hauteur source
//                            $pdf->SetX($pdf->GetX()+$img_size[0]);                            
//                            $pdf->SetX($img_size[0]);                            
// Set font
//$pdf->SetFont('Arial','B',16);
// Centered text in a framed 20*10 mm cell and line break
//$pdf->Cell($pdf->GetX(),$pdf->GetY(),$pdf->Image($dt[img][0],$pdf->GetX() ,$pdf->GetY()),'LR',0,'C');
                            $pdf->Image($dt[img][0],$pdf->GetX() ,$pdf->GetY());
//$pdf->WriteHTML("This is a <img src=".$dt[img][0]."> test");
                            $pdf->Write(1,"         ");
                        }
*/
//                        $pdf->Write( 4, $pdf->GetX()." ");
//                        $pdf->Write( 4, $pdf->GetY()." ");
//                        $pdf->Write($H_Src-10, $dt[img][1]."  ");
//----------------------------                        $pdf->Write(4, $dt[img][1]."  ");
                        ////$text .= "<span style='color:#ADD8E6 '>".$dt[c]."</span> ";
//                        $text .= "<span style='color:cyan'>".$n[1][0]."</span> ";
//                        $pdf->album_format($n[1]);
//----------------------------                        break;
//----------------------------                    case "c":
//                        var_dump($n);
//----------------------------                        $pdf->SetFont( 'Arial', '', 10 );
//----------------------------                        $pdf->SetTextColor( 0, 255, 255);
//----------------------------                        $pdf->Write( 4, $dt[c]." " );
                        ////$text .= "<span style='color:#ADD8E6 '>".$dt[c]."</span> ";
//                        $text .= "<span style='color:cyan'>".$n[1][0]."</span> ";
//                        $pdf->album_format($n[1]);
//----------------------------                        break;
//----------------------------                    case "t":
//                        var_dump($n);
//----------------------------                        $pdf->SetFont( 'Arial', '', 10 );
//----------------------------                        $pdf->SetTextColor( 255, 0, 0);
//----------------------------                        $pdf->Write( 4, $dt[t]." " );
////                        $text .= "<span style='color:red '>".$dt[t]."</span> ";
//                        $text .= "<span style='color:cyan'>".$n[1][0]."</span> ";
//                        $pdf->album_format($n[1]);
//----------------------------                        break;
//----------------------------                    default:
//                        var_dump($n);
//----------------------------                        $pdf->SetFont( 'Arial', '', 10 );
//----------------------------                        $pdf->SetTextColor( 0, 0, 0);
//----------------------------                        $pdf->Write( 4, $dt[l]." " );
////                        $text .= $dt[l]." ";
//                        $text .= $n[1][0]." ";
//                        $pdf->album_format($n[1]);
/*
                    case "titulo":
                        $pdf->titulo($n[1]);
                        print "Titulo: ".$n[1]."\n";
                        break;
*/
//----------------------------                    }
//----------------------------                }
//       }
//       }
//echo $text;
//die();
//$pdf->AddPage();
////$pdf->Output( "report.pdf", "I" );
//$pdf->SetFont( 'Arial', '', 10);
//$pdf->SetTextColor( 0, 0, 0);
//$pdf->WriteHTML($tp->toHTML("<br><hr>".$plpdf->leg_faltas(pdf)."<br><hr>"));
/*
$pdf->SetY(-75);
$pdf->SetFont( 'Arial', '', 8);
$temp = $pdf->AliasNbPages;
$pdf->WriteHTML($temp, true);
$pdf->WriteHTML(phillis_02." ".SITENAME." (<a href=$phillis_purl>$phillis_purl</a>)", true);
*/
//DEBUG
//$pdf->AddPage();
//$pdf->MultiCellTag(0, 5, $data);
//$pdf->AddPage();
//$data2=str_replace ( "&quot;", "\"", $data ) ;
//$pdf->MultiCellTag(0, 5, "DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 DATA 2 ");
//$pdf->MultiCellTag(0, 5, $data2);
//$pdf->AddPage();
/*
    if (preg_match_all('/^(.*)\(([^)]+)\)/m', $data, $m, PREG_SET_ORDER))
        {
//DEBUG
//$pdf->MultiCellTag(0, 5, "LINHAS§§§§§§§§§§§§§§§§§§§§§§§§§§§§§");
//$textoo1 = print_r($m, true);
//$pdf->MultiCellTag(0, 5, $textoo1);
        foreach ($m as $i)
            {
//DEBUG
//$pdf->MultiCellTag(0, 5, "CÓDIGO##############################");
//$textoo2 = print_r($i, true);
//$pdf->MultiCellTag(0, 5, $textoo2);
            //echo $i[1]."\n";
            if (preg_match_all('/"(.*?)"/', $i[2], $n, PREG_PATTERN_ORDER))
                {
                switch ($i[1] ? $i[1] : "ERRO")
                    {
                    case "album_formato":
                    case "album_format":
                        $pdf->album_format($n[1]);
                        break;
                    case "titulo":
                        $pdf->titulo($n[1]);
                        print "Titulo: ".$n[1]."\n";
                        break;
                    case "rect_cntr":
                        $pdf->rect_cntr($n[1]);
                        break;
                    case "pagina_formato":
                        if (count($n[1]) == 3)
                            {
                            list($orientation, $format, $template)=$n[1];
                            $pdf->AddPage($orientation, $format, $template);
                            }
                        elseif (count($n[1]) == 2)
                            {
                            list($orientation, $format)=$n[1];
                            $pdf->AddPage($orientation, $format);
                            }
                        break;
                    case "stamp_space":
                          	$pdf->stampspace($n[1]);
                          	break;
                    case "album_margem":
                    case "album_margin":
                    case "pagina_margem":
                    case "page_margin":
                        if (count($n[1]) == 3)
                            {
                            list($left, $top, $right)=$n[1];
                            }
                        elseif (count($n[1]) == 4)
                            {
                            list($left, $top, $right, $bottom)=$n[1];
                            }
                        $pdf->SetMargins((int)$left, (int)$top, (int)$right);
                        $pdf->SetAutoPageBreak(true, (int)$bottom ? (int)$bottom : 20);
                        break;
                    case "imagem":
                    case "image":
                        list($x, $y, $longueur, $hauteur, $image)=$n[1];
                        $pdf->Image($image, $x, $y, $longueur, $hauteur);
                        break;
                    case "texto":
                        list($allign)=$n[1];
                        $n[1]=array_slice($n[1], 1);
                        if (is_array($n[1]))
                            {
                            $pdf->MultiCellTag(0, 5, stripcslashes(implode('', $n[1])), 0, $allign);
                            print "Texto: ".stripcslashes(implode('', $n[1]))."\n";
                            $texto = stripcslashes(implode('', $n[1]));
                            }
                        break;
                    case "selo":
                    case "stamp":
                        list($longueur, $hauteur, $text, $image)=$n[1];
                        array_push($pdf->stampline, $longueur, $hauteur, $text, $image);
                        break;
                    case "linha_selos":
//DEBUG
//$pdf->MultiCellTag(0, 5, "LINHA    §§§§§§§§§§§§§§§§§§§§§§§§§§§§§ELOS");
                        $pdf->Linha_Selos($n[1]);
                        break;
                    case "setstyle":
                        list($tag, $family, $style, $size, $color)=$n[1];
                        $pdf->SetStyle($tag, $family, $style, $size, $color);
                        break;
                    case "Index ":
                        list($text)=$n[1];
                        print "Index ".$text."\n";
                        $pdf->Bookmark($text);
                        break;
                    case "indexpage":
                        list($text)=$n[1];
                        print "Bookmark: ".$text."\n";
                        $pdf->Bookmark($text);
                        break;
                    }
                }
            }
        }
*/        
//# $pdf->cover_page($phillis_row);
//# $pdf->fly_sheet($phillis_row);
//# $pdf->TOC_Entry("Preface", 0);
// *
// * Generate the chapters
// *
//# $pdf->startPageNums();
//# $sql->db_Select("pa_chapters", "*", "where pa_chapter_book=$phillis_pdfbookid order by pa_chapter_number", "nowhere", false);
//# while ($phillis_row = $sql->db_Fetch())
//# {
//#     extract($phillis_row);
//#     phalbuns_chapter($pa_chapter_number, $pa_chapter_title, $pa_chapter_body);
//# }
//# $pdf->stopPageNums();
// Instert the table of contents
//# $pdf->insertTOC(2);
$pdf->lastpage = 1;
while (@ob_end_clean());
// can be i or d
$pdf->Output("book.pdf", "i");
//# function phalbuns_chapter($phillis_chapno, $phillis_chap_tit, $phillis_chapter_text)
//# {
//#     global $pdf, $tp;
//#     $pdf->chap = phalbuns_P27 . " " . $phillis_chapno . " - " . $phillis_chap_tit;
//#     $pdf->AddPage();
//#     $pdf->TOC_Entry($phillis_chapno . " " . $phillis_chap_tit, 0);
//#     $pdf->WriteHTML($tp->toHTML($phillis_chapter_text, true));
//# }
?>