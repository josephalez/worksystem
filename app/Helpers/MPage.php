<?php namespace App\Helpers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MPage
{

  public $page;
  public $perPage;
  public $minPage;
  public $maxPage;
  public $items;
  public $itemsTotal;

  private $model;
  private $request;

  public $id;

  private $frontPages;
  private $backPages;

  /**/
  public $filters = [

  ];
  private $filtersList = [
    /*'substate'    => 'substate',
    'agendaday'   => 'agenda',
    'subordinado' => 'subordinado',
    'rut'         => 'rut'*/
  ];
  private $normalFilters = [
    /*'substate',
    'agenda',
    'rut'*/
  ];
  public $filtersKeys = [

  ];
  private $tableName = '';
  /**/

  function __construct($model,Request $request = null , $perPage = 10, $id = '', $tableName = ''){
    $this->page       = 1;
    $this->perPage    = $perPage;

    $this->minPage    = 1;
    $this->maxPage    = 1;

    $this->items      = [];
    $this->itemsTotal = 0;

    $this->request    = $request;
    $this->model      = $model;
    $this->id         = $id;

    $this->frontPages = 4;
    $this->backPages  = 4;

    $this->tableName  = $tableName;
  }

  function requestProcess(){
    if ($this->request->input($this->id.'page'))
      $this->page = (integer) $this->request->input($this->id.'page');

    return $this->getFilters();
  }

  function getTotals(){
    $modelCount = clone $this->model;

    $this->itemsTotal =
    $modelCount->distinct($this->tableName.'id')->count($this->tableName.'id');
    $this->maxPage = ceil( $this->itemsTotal / $this->perPage );

    return $this;
  }

  function processFiltersModel(){

    foreach ($this->filters as $key => $value){
      if (!empty($value) || $value == '0')
        if (in_array($key, $this->normalFilters)){
            $this->model->where($key,'=',$value);
        } else {
          switch ($key) {
            case 'subordinado':
              //uploader
              if (Auth::user()->role == 'bo general' || Auth::user()->role == 'backoffice')
                $this->model->where('supervisor','=',$value);

              if (Auth::user()->role == 'supervisor')
                $this->model->where('ejecutivo','=',$value);
            break;
          }
        }
    }

    return $this;
  }

  function getQuery(){
    $this->items =
    $this->model
    ->take($this->perPage)
    ->skip(($this->page - 1) * $this->perPage)
    ->get();

    return $this;
  }

  function pageValidate(){
    if ($this->page < $this->minPage) $this->page = (integer) $this->minPage;
    if ($this->page > $this->maxPage) $this->page = (integer) $this->maxPage;

    //var_dump($this->page);exit();

    return $this;
  }

  function execute(){
    $this->requestProcess()->processFiltersModel()->getTotals()->pageValidate()->getQuery();

    return $this;
  }

  function getFilters(){
    $filtersList = $this->filtersList;
    foreach ($filtersList as $key => $value) {
      $this->filtersKeys[$value] = $this->id.'filters_'.$key;
      if (
        !empty($this->request->input($this->id.'filters_'.$key))
        || $this->request->input($this->id.'filters_'.$key) == '0'
      )
        $this->filters[$value] = $this->request->input($this->filtersKeys[$value]);
      else
        $this->filters[$value] = null;
    }
    return $this;
  }

  function getPaginate(){

    $backPages = $this->backPages;
    $frontPages = $this->frontPages;

    $pagesArray = [];

    for ($i=1; $i <= $backPages; $i++) {
      $page = $this->page - $i;
      if (!($page < $this->minPage) && !($page > $this->maxPage))
        array_unshift ($pagesArray, $page);
      else
        $frontPages += 1;
    }

    //var_dump($pages);exit();
    $pagesArray[] = $this->page;

    //var_dump($frontPages);exit();

    for ($i=1; $i <= $frontPages; $i++) {
      $page = $this->page + $i;
      if (!($page < $this->minPage) && !($page > $this->maxPage))
        $pagesArray[] = $page;
      else
        $backPages += 1;
    }

    for ($i=1; $i <= $backPages; $i++) {
      $page = $this->page - $i;
      if (!($page < $this->minPage) && !($page > $this->maxPage) && !in_array($page, $pagesArray))
        array_unshift ($pagesArray, $page);
    }

    $resPages = [];

    $allRequest = $this->request->all();
    $keyRequest = $this->id.'page';
    $allRequestUrl = '';
    foreach ($allRequest as $key => $value) {
      if ($key != $keyRequest)
        $allRequestUrl .= '&'.$key.'='.$value;
    }

    for ($i=0; $i < sizeof($pagesArray); $i++) {
      $resPages[] = [
        'page'    => (integer) $pagesArray[$i],
        'url'     => $keyRequest.'='.$pagesArray[$i].$allRequestUrl,
        'current' => ($pagesArray[$i] == $this->page) ? true : false
      ];
    }

    $backPage = null;
    $nextPage = null;

    //var_dump($resPages[0]['current']);exit();

    if (!$resPages[0]['current'])
      foreach ($resPages as $key => $value)
        if ($value['current'])
          $backPage = $resPages[$key - 1];


    if (!$resPages[sizeof($resPages) - 1]['current'])
      foreach ($resPages as $key => $value)
        if ($value['current'])
          $nextPage = $resPages[$key + 1];

    return [
      'pages' => $resPages,
      'back'  => $backPage,
      'next'  => $nextPage
    ];
  }

  function getResult(){
    return [
      'items'       => $this->items,
      'pages'       => $this->maxPage,
      'total'       => $this->itemsTotal,
      'perpage'     => $this->perPage,
      'page'        => $this->page,
      'id'          => $this->id,
      'paginate'    => $this->getPaginate(),
      'filters'     => $this->filters,
      'filtersKeys' => $this->filtersKeys,
      'pageKey'     => $this->id.'page'
    ];
  }

  static function paginate($model, Request $request = null, $perPage = 10, $id = '', $tableName = ''){

    $OPaginator = new MPage($model, $request, $perPage, $id, $tableName);
    return $OPaginator->execute()->getResult();

  }

}

?>
