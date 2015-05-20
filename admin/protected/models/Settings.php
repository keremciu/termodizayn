<?php

class Settings extends CFormModel
{
 
    public $system = array(
        'name' => '',
        'googleAPIKey' => '',
        'defaultLanguage' => '',
        'defaultCurrency' => '',
    );
    public $seo = array(
        'mainTitle' => '',
        'mainKwrds' => '',
        'mainDescr' => ''
    );
    public $mail = array(
        'adminEmail' => '',
        'fromReply' => '',
        'fromNoReply' => '',
        'server' => '',
        'port' => '',
        'user' => '',
        'password' => '',
        'ssl' => '',
    );
    public $contact = array(
        'email'=>'',
        'phone'=>'',
        'fax'=>'',
        'googleMapCoordinate'=>'',
        'country'=>'',
        'region'=>'',
        'locality'=>'',
        'address'=>'',
        'address2'=>'',
        'address3'=>'',
        'postCode'=>'',
        'additionalInfo'=>'',
    );
    public $social = array(
        'facebook'=>'',
        'twitter'=>'',
        'googleplus'=>'',
        'youtube'=>'',
    );
 
    /**
     * Declares customized attribute labels.
     * If not declared here, an attribute would have a label that is
     * the same as its name with the first letter in upper case.
     */
    public function getAttributesLabels($key)
    {
        $keys = array(
        	'name' => 'Firma Adı',
            'googleAPIKey' => 'Google API Key',
            'defaultLanguage' => 'Varsayılan Dil',
            'defaultCurrency' => 'Varsayılan Para Birimi',
            'mainTitle' => 'Sayfa Başlığı',
            'mainKwrds' => 'Varsayılan Anahtar Kelimeler (Meta Keywords)',
            'mainDescr' => 'Varsayılan Site Açıklaması (Meta Description)',
        );
 
        if(array_key_exists($key, $keys))
            return $keys[$key];
 
        $label = trim(strtolower(str_replace(array('-', '_'), ' ', preg_replace('/(?<![A-Z])[A-Z]/', ' \0', $key))));
        $label = preg_replace('/\s+/', ' ', $label);
 
        if (strcasecmp(substr($label, -3), ' id') === 0)
            $label = substr($label, 0, -3);
 
        return ucwords($label);
    }

    /**
     * Sets attribues values
     * @param array $values
     * @param boolean $safeOnly
     */
    public function setAttributes($values,$safeOnly=true) 
    { 
        if(!is_array($values)) 
            return; 
 
        foreach($values as $category=>$values) 
        { 
            if(isset($this->$category)) {
                $cat = $this->$category;
                foreach ($values as $key => $value) {
                    if(isset($cat[$key])){
                        $cat[$key] = $value;
                    }
                }
                $this->$category = $cat;
            }
        } 
    }
}