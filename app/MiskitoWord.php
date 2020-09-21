<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MiskitoWord extends Model
{
	// 絶対に変更しないカラム
	protected $guarded = ['id'];
	public function miqEspRelation()
	{
		return $this->hasMany('miqEspRelation');
	}
	public function Note()
	{
		return $this->hasMany('Note');
	}
	public function Tag()
	{
		return $this->hasMany('Tag');
	}
	public function MiskitoWordClassification()
	{
		return $this->hasMany('MiskitoWordClassification');
	}
	public function Wordmeta()
	{
		return $this->hasMany('Wordmeta');
	}
	public function Expresionrelation()
	{
		return $this->belongsTo('Expresionrelation');
	}
}
