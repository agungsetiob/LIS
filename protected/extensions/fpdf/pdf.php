<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class pdf extends fpdf
{
  public $title='';
  public $subtitle='';
  public $isheader=true;
  public $iscustomborder=false;
  public $isneedpage=false;
  public $colheader;
  public $colalign;
  public $coldetailalign;
  var $widths;
  var $aligns;
  var $border = false;
  var $bordercell;
  var $legends;
  var $wLegend;
  var $sum;
  var $NbVal;

  function SetWidths($w)
  {
      //Set the array of column widths
      $this->widths=$w;
  }

  function SetAligns($a)
  {
      //Set the array of column alignments
      $this->aligns=$a;
  }

  function SetBorder($a)
  {
      //Set the array of column alignments
      $this->border=$a;
  }

    function SetBorderCell($a)
  {
      //Set the array of column alignments
      $this->bordercell=$a;
  }

  function SetTableHeader()
  {
    //Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B');
  }

  function SetTableData()
  {
    //Color and font restoration
    $this->SetFillColor(224,235,255);
    $this->SetTextColor(0);
    $this->SetFont('');
  }

  function RowHeader()
	{
		$this->setaligns($this->colalign);
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($this->colheader);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $this->colheader[$i]));
		$h=5*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		$k = 0;
		//Draw the cells of the row
		//$this->setFont('Arial','',8);
		for($i=0;$i<count($this->colheader);$i++)
		{
			$w = $this->widths[$i];
			$a = $this->aligns[$i];
			$x = $this->GetX();
			$y = $this->GetY();
      $c = $this->bordercell[$i];
      if ($c == '')
      {
        $c = 'LRTB';
      }

			if ($this->iscustomborder == false)
			{
				$this->Rect($x, $y, $w, $h);
				$this->MultiCell($w, 5, $this->colheader[$i], 0, $a);
			}
			if ($this->iscustomborder == true)
			{
				//$this->Rect($x, $y, $w, $h);
				$this->MultiCell($w, 5, $this->colheader[$i], $c, $a);
			}
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
		$this->setaligns($this->coldetailalign);
	}


	function Row($data)
	{
		$this->setaligns($this->coldetailalign);
		//Calculate the height of the row
		$nb=0;
		for($i=0;$i<count($data);$i++)
			$nb=max($nb, $this->NbLines($this->widths[$i], $data[$i]));
		$h=10*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		$k = 0;
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w = $this->widths[$i];
			$a = $this->aligns[$i];
			$x = $this->GetX();
			$y = $this->GetY();
			$c = $this->bordercell[$i];
			if ($c == '')
			{
				$c = 'TB';
			}
			if ($this->iscustomborder == false)
			{
				$this->Rect($x, $y, $w, $h);
				$this->MultiCell($w, 10, $data[$i], 0, $a);
			}
			if ($this->iscustomborder == true)
			{
				//$this->Rect($x, $y, $w, $h);
				$this->MultiCell($w, 10, $data[$i], $c, $a);
			}
			$this->SetXY($x+$w, $y);
		}
		//Go to the next line
		$this->Ln($h);
  }

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
		{
			$this->AddPage($this->CurOrientation);
		  	//$this->ln(30);
			$this->RowHeader($this->colheader);
		}
	}

	function CheckNewPage($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
		{
			$this->AddPage($this->CurOrientation);
		}
	}

  function NbLines($w, $txt)
  {
      //Computes the number of lines a MultiCell of width w will take
      $cw=&$this->CurrentFont['cw'];
      if($w==0)
          $w=$this->w-$this->rMargin-$this->x;
      $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
      $s=str_replace("\r", '', $txt);
      $nb=strlen($s);
      if($nb>0 and $s[$nb-1]=="\n")
          $nb--;
      $sep=-1;
      $i=0;
      $j=0;
      $l=0;
      $nl=1;
      while($i<$nb)
      {
          $c=$s[$i];
          if($c=="\n")
          {
              $i++;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
              continue;
          }
          if($c==' ')
              $sep=$i;
          $l+=$cw[$c];
          if($l>$wmax)
          {
              if($sep==-1)
              {
                  if($i==$j)
                      $i++;
              }
              else
                  $i=$sep+1;
              $sep=-1;
              $j=$i;
              $l=0;
              $nl++;
          }
          else
              $i++;
      }
      return $nl;
  }
}

?>
