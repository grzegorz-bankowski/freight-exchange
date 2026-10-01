<?php

namespace App\Classes;

class Paginator
{
    private $pagename;
    private $totalpages;
    private $totalrecords;
    private $recordsperpage;
    private $maxpagesshown;
    private $currentstartpage;
    private $currentendpage;
    private $currentpage;
    private $nextinactive;
    private $previousinactive;
    private $firstinactive;
    private $lastinactive;
    private $firstparamname = 'offset';
    private $params;

    private $inactivespanname = 'inactive';
    private $pagedisplaydivname = 'totalpagesdisplay';
    private $divwrappername = 'paginator';

    private $strfirst = '&lt;';
    private $strnext = 'Next';
    private $strprevious = 'Previous';
    private $strlast = '&gt;';

    private $errorstring;
    public $origin;
    public $start_city;
    public $destination;
    public $end_city;
    public $trailer;
    public $weight_min;
    public $weight_max;

    public function __construct($pagename, $totalrecords, $recordsperpage, $recordoffset, $maxpagesshown = 4, $params = '', $origin = '', $start_city = '', $destination = '', $end_city = '', $weight_min = 0, $weight_max = 0, $trailer = '')
    {
        $this->pagename = $pagename;
        $this->recordsperpage = $recordsperpage;
        $this->maxpagesshown = $maxpagesshown;
        $this->params = $params;
        $this->origin  = $origin;
        $this->start_city = $start_city;
        $this->destination = $destination;
        $this->end_city = $end_city;
        $this->weight_min = $weight_min;
        $this->weight_max = $weight_max;
        $this->trailer = $trailer;
        $this->checkRecordOffset($recordoffset, $recordsperpage) or die($this->errorstring);
        $this->setTotalPages($totalrecords, $recordsperpage);
        $this->calculateCurrentPage($recordoffset, $recordsperpage);
        $this->createInactiveSpans();
        $this->calculateCurrentStartPage();
        $this->calculateCurrentEndPage();
    }

    private function checkRecordOffset($recordoffset, $recordsperpage)
    {
        $bln = true;
        if ($recordoffset % $recordsperpage != 0) {
            $this->errorstring = 'Error';
            $bln = false;
        }
        return $bln;
    }

    private function setTotalPages($totalrecords, $recordsperpage)
    {
        $this->totalpages = ceil($totalrecords / $recordsperpage);
    }

    private function calculateCurrentPage($recordoffset, $recordsperpage)
    {
        $this->currentpage = $recordoffset / $recordsperpage;
    }

    private function createInactiveSpans()
    {
        $this->nextinactive = '<span class="' . $this->inactivespanname . '">' . $this->strnext . '</span>' . "\n";
        $this->lastinactive = '<span class="' . $this->inactivespanname . '">' . $this->strlast . '</span>' . "\n";
        $this->previousinactive = '<span class="' . $this->inactivespanname . '">' . $this->strprevious . '</span>' . "\n";
        $this->firstinactive = '<span class="' . $this->inactivespanname . '">' . $this->strfirst . '</span>' . "\n";
    }

    private function calculateCurrentStartPage()
    {
        $temp = floor($this->currentpage / $this->maxpagesshown);
        $this->currentstartpage = $temp * $this->maxpagesshown;
    }

    private function calculateCurrentEndPage()
    {
        $this->currentendpage = $this->currentstartpage + $this->maxpagesshown;
        if ($this->currentendpage > $this->totalpages) {
            $this->currentendpage = $this->totalpages;
        }
    }

    public function setFirstParamName($name){
        $this->firstparamname = $name;
    }

    public function getNavigator()
    {
        $strnavigator = '<div class="' . $this->divwrappername . '">' . "\n";
        if ($this->currentpage == 0) {
            $strnavigator .= $this->firstinactive;
        } else {
            $strnavigator .= $this->createLink(0, $this->strfirst);
        }

        if ($this->currentpage == 0) {
            $strnavigator .= $this->previousinactive;
        } else {
            $strnavigator .= $this->createLink($this->currentpage - 1, $this->strprevious);
        }

        for ($x = $this->currentstartpage; $x < $this->currentendpage; $x++) {
            if ($x == $this->currentpage) {
                $strnavigator .= '<span class="' . $this->inactivespanname . ' current' . '">' . $x + 1 . '</span>' . "\n";
            } else {
                $strnavigator .= $this->createLink($x, $x + 1);
            }
        }

        if ($this->currentpage == $this->totalpages - 1) {
            $strnavigator .= $this->nextinactive;
        } else {
            $strnavigator .= $this->createLink($this->currentpage + 1, $this->strnext);
        }

        if ($this->currentpage == $this->totalpages - 1) {
            $strnavigator .= $this->lastinactive;
        } else {
            $strnavigator .= $this->createLink($this->totalpages - 1, $this->strlast);
        }

        $strnavigator .= '</div>' . "\n";
        $strnavigator .= $this->getPageNumberDisplay();
        return $strnavigator;
    }

    private function createLink($offset, $strdisplay)
    {
        $strtemp = '<a href="' . $this->pagename . '?' . $this->firstparamname . '=';
        $strtemp .= $offset;
        $strtemp .= '&origin' . '=' . $this->origin . '&start_city' . '=' . $this->start_city . '&destination' . '=' . $this->destination . '&end_city' . '=' . $this->end_city . '&weight_min' . '=' . $this->weight_min . '&weight_max' . '=' . $this->weight_max . '&trailer' . '=' . $this->trailer . '">' . $strdisplay . '</a>' . "\n";
        return $strtemp;
    }

    private function getPageNumberDisplay()
    {
        $str = '<div class="' . $this->pagedisplaydivname . '">' . "\n" . 'Page ';
        $str .= $this->currentpage + 1;
        $str .= ' of ' . $this->totalpages;
        $str .= '</div>' . "\n";
        return $str;
    }
}
