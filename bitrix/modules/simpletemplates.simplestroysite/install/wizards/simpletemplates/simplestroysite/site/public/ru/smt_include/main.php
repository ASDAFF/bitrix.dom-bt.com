<?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_main_blocks', '', SITE_ID)):?>
    <?
    $arBlocks = explode(',', COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_main_blocks', 'slider,benefits,about,projects,gallery,info1,action,info2,banner', SITE_ID));
    foreach($arBlocks as $block):?>
        <?if($block == 'slider' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_slider', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_slider.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'benefits' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_benefits', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_benefits.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'about' && (COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_about', 'Y', SITE_ID) == "Y" ||
            COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_services', '', SITE_ID) == "Y")
        ):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_services.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'projects' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_projects', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_projects.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'gallery' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_gallery', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_gallery.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'info1' && (COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_responses', 'Y', SITE_ID) == "Y" ||
            COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_form', 'Y', SITE_ID) == "Y")
        ):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_info1.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'action' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_action', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_action.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'info2' && (COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_article', 'Y', SITE_ID) == "Y" ||
            COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_news', 'Y', SITE_ID) == "Y")
        ):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_info2.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
        <?if($block == 'banner' && COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_banner', 'Y', SITE_ID) == "Y"):?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/main_banner.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        <?endif?>
    <?endforeach?>
<?else:?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_slider', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_slider.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_benefits', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_benefits.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_about', 'Y', SITE_ID) == "Y" ||
        COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_services', 'Y', SITE_ID) == "Y"
    ):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_services.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_projects', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_projects.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_gallery', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_gallery.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_responses', 'Y', SITE_ID) == "Y" ||
        COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_form', 'Y', SITE_ID) == "Y"
    ):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_info1.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_action', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_action.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_article', 'Y', SITE_ID) == "Y" ||
        COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_news', 'Y', SITE_ID) == "Y"
    ):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_info2.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_banner', 'Y', SITE_ID) == "Y"):?>
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/main_banner.php",
            Array(),
            Array("MODE"=>"html", "SHOW_BORDER"=>false)
        );?>
    <?endif?>
<?endif?>