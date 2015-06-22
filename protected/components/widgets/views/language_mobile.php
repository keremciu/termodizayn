<select id="mobile-language-selectbox" name="language-select" class="mobile-navbar-selectbox needsclick select-redirect">
<?php 
    foreach($languages as $key=>$lang) {
        $item = '<option value="'.$this->getOwner()->createMultilanguageReturnUrl($key).'"';
        if ($key == $currentLang)
            $item .= 'selected="selected"';
        $item .= '>'.strtoupper($key).'</option>';
        echo $item;
    }
?>
</select>