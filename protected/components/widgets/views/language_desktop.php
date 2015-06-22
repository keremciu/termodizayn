<div class="language-menu-frame">
    <div class="site-navbar_item">
        <span>
            <?php foreach($languages as $key=>$lang) { if ($key == $currentLang) { echo $lang; } } ?> <svg class="icon"><use xlink:href="#icon-arrow-drop-down"></use></svg>
        </span>
    </div>
    <ul class="language-menu">
    <?php 
        echo CHtml::form();
        foreach($languages as $key=>$lang) { 
            echo '<li>';
                echo CHtml::link(strtoupper($key),$this->getOwner()->createMultilanguageReturnUrl($key), array('class'=>'language-menu_item language-menu_item--'.$key));
            echo '</li>';
        }
        echo CHtml::endForm(); 
    ?>
    </ul>
</div>