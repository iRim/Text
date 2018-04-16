<?php

namespace irim\Text;

class Text extends \yii\base\Component
{

    const toLower = MB_CASE_LOWER,
        toUpper = MB_CASE_UPPER,
        toTitle = MB_CASE_TITLE;

    protected $enc = 'UTF-8',
        $text = NULL;

    public function __construct($enc = NULL)
    {
        if($enc){$this->enc = $enc;}
    }

    private function substr($text,$start,$len){
        return mb_substr($text,$start,$len,$this->enc);
    }

    private function convert($text,$convert){
        return mb_convert_case($text,$convert,$this->enc);
    }

    public function text($text){
        $this->text = $text;
        return $this;
    }

    public function toUpper(){
        $this->text = $this->convert($this->text,self::toUpper);
        return $this;
    }
    public function toLower(){
        $this->text = $this->convert($this->text,self::toLower);
        return $this;
    }
    public function toTitle(){
        $this->text = $this->convert($this->text,self::toTitle);
        return $this;
    }

    public function uppercase($start = 0,$len = 1){
        $count = mb_strlen($this->text,$this->enc);
        if($count>=$start+$len-1 and $start+1<$count){
            $text = [];
            if($start>0){
                $text[] = $this->substr($this->text,0,$start);
            }
            $text[] = mb_strtoupper($this->substr($this->text,$start,$len));
            $text[] = $this->substr($this->text,($start+$len),$count);
            $this->text = implode('',$text);
        }
        return $this;
    }

    public function ucFirst(){
        $this->uppercase();
        return $this;
    }

    public function find($find,$convert,$divider = ';'){
        if(!is_array($find)){
            $find = explode($divider,$find);
        }
        foreach ($find AS $f){
            $this->text = preg_replace('/'.addslashes($f).'/u',$this->convert($f,$convert),$this->text);
        }
        return $this;
    }

    public function end(){
        return $this->text;
    }

    static function ucFirstLetter($text){
        return (new self())->text($text)->ucFirst()->end();
    }

}