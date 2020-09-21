<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MiskitoWord;
use App\miqEspRelation;
use App\SpanishWord;

class AdminController extends Controller
{
    //
  public function index(){
    return view('app.main');
  }

  public function getmiskitowordlist(){
    return MiskitoWord::get();
  }

  // public function getSearchResult(Request $request){
  public function getSearchResult(){

    $keyword = request('keyword');


    $hitWord = array();
    $meanings = array();
    $miqwordsSet = array();
    $espwordsSet = array();
    //表示する結果の言語。デフォルトはMiskito語
    $lang = 'miq';

    //入力された言葉をMiskito語の辞書で探す
    $hitWord = MiskitoWord::where('miskitoWord', 'like', $keyword)
    ->select('id', 'miskitoWord')
    ->get();


    //入力された言語がスペイン語だと思われる（Miskito語の辞書に載っていない）場合スペイン語の辞書を探す。
    if($hitWord->isEmpty()){
      $hitWord = SpanishWord::where('spanishWord', 'like', $keyword)
      ->select('id', 'spanishWord')
      ->get();
      //スペイン語でヒットする場合、
      if(!($hitWord->isEmpty())){
        //表示言語をスペイン語に設定する
        $lang = 'esp';
        //Miskito語の対応する言葉を取得
        foreach($hitWord as $word){
          $espid = $word->id;
        }
        $meanings = miqEspRelation::where('miq_esp_relations.spanishWord', '=', $espid)
          ->leftJoin('miskito_words',  'miq_esp_relations.miskitoWord', '=', 'miskito_words.id')
          ->select('miskito_words.id', 'miskito_words.miskitoWord')
          ->get();
      }
    }else{
      //スペイン語の対応する言葉を取得する
      foreach($hitWord as $word){
        $miqid = $word->id;
      }
      $meanings = miqEspRelation::where('miq_esp_relations.miskitoWord', '=', $miqid)
        ->leftJoin('spanish_words',  'miq_esp_relations.spanishWord', '=', 'spanish_words.id')
        ->select('spanish_words.id', 'spanish_words.spanishWord')
        ->get();
    }

    //あいまい検索
    $keywordws = '%' . $keyword . '%';

    //Miskito語の候補を取得
    $miqwordsSet = MiskitoWord::where('miskitoWord', 'like',  $keywordws)
    ->select('id', 'miskitoWord')
    ->orderBy('miskitoWord', 'ASC')
    ->get();

    //スペイン語の候補を取得
    $espwordsSet = SpanishWord::where('spanishWord', 'like',  $keywordws)
    ->select('id', 'spanishWord')
    ->orderBy('spanishWord', 'ASC')
    ->get();

      $results = array();
      $results['hitword'] = $hitWord;
      $results['meanings'] = $meanings;
      $results['miqwordset'] = $miqwordsSet;
      $results['espwordset'] = $espwordsSet;
      $results['lang'] = $lang;
      return response()->json([$results]);
   // return $keyword;
    
  }
}
