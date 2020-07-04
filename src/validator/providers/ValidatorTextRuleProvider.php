<?php

/**
*   ValidatorTextRuleProvider
*
*   @version 200704
**/

namespace Movement\validator\providers;

use Movement\validator\AbstractValidatorRuleProvider;

class ValidatorTextRuleProvider extends AbstractValidatorRuleProvider
{
    /**
    *   {inherit}
    *
    */
    protected function setRules()
    {
        $this->rules = [
            'length' => fn($v, $p) => mb_strlen($v) == $p,
            'minLength' => fn($v, $p) => mb_strlen($v) >= $p,
            'maxLength' => fn($v, $p) => mb_strlen($v) <= $p,
            'alpha' => fn($v) => mb_ereg_match('\A[a-zA-Z]+\z', $v),
            'alnum' => fn($v) => mb_ereg_match('\A[a-zA-Z0-9]+\z', $v),
            'ascii' => fn($v) => mb_ereg_match('\A[\x21-\x7e]+\z', $v),
            'hiragana' => fn($v) => mb_ereg_match('\A[ぁ-ん]+\z', $v),
            'katakana' => fn($v) => mb_ereg_match('\A[ァ-ヶ]+\z', $v),
            'hankana' => fn($v) => mb_ereg_match('\A[｡-ﾟ]+\z', $v),
        ];
   }
}
