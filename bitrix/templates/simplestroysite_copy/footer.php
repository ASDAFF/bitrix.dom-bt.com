<?if ($curPage == SITE_DIR."index.php"):?>
    <div class="smt-widget-content">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <?if(COption::GetOptionString('simpletemplates.simplestroysite', 'smt_main_show_text', 'Y', SITE_ID) == "Y"):?>
                    <h1 class="smt-header h2 smt-header-underline-center"><?=$APPLICATION->ShowTitle(false)?></h1>
                    <?$APPLICATION->IncludeFile(
                        SITE_DIR."smt_include/content_main.php",
                        Array(),
                        Array("MODE"=>"html")
                    );?>
                    <?endif?>
<?endif?>
                    <div class="clearfix"></div>
                    <?if($APPLICATION->GetProperty("smt_show_content_bottom")):?>
                        <?$APPLICATION->IncludeFile(
                            SITE_DIR."smt_include/content_bottom.php",
                            Array(),
                            Array("MODE"=>"html")
                        );?>
                    <?endif?>
                </div>
                <?if($APPLICATION->GetProperty("smt_sidebar_right")):?>
                    <div class="smt-widget-content__sidebar smt-widget-content__sidebar_right col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <?$APPLICATION->IncludeFile(
                            SITE_DIR."smt_include/sidebar.php",
                            Array(),
                            Array("MODE"=>"html")
                        );?>
                    </div>
                <?endif?>
            </div>
        </div>
    </div>
    <?$APPLICATION->ShowViewContent('smt_content_after');?>
</div>
<footer class="smt-footer-wrapper">
    <div class="smt-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-2 col-lg-4">
                    <div class="smt-logo-footer">
                        <div class="smt-logo-footer__image">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR."smt_include/footer_logo.php",
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        </div>
                        <div class="smt-logo-footer__label">
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR."smt_include/footer_text.php",
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-10 col-lg-8">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="h4 smt-header smt-header-underline-left"><?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/footer_header1.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?></div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "smt_list_arrow_footer", Array(
                                    "ROOT_MENU_TYPE"	=>	"smt_footer",
                                    "MAX_LEVEL"	=>	"1",
                                    "CHILD_MENU_TYPE"	=>	"",
                                    "USE_EXT"	=>	"N",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => Array()
                                )
                            );?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="h4 smt-header smt-header-underline-left"><?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/footer_header2.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?></div>
                            <?$APPLICATION->IncludeComponent("bitrix:menu", "smt_list_arrow_footer", Array(
                                    "ROOT_MENU_TYPE"	=>	"smt_popular",
                                    "MAX_LEVEL"	=>	"1",
                                    "CHILD_MENU_TYPE"	=>	"",
                                    "USE_EXT"	=>	"N",
                                    "MENU_CACHE_TYPE" => "A",
                                    "MENU_CACHE_TIME" => "3600",
                                    "MENU_CACHE_USE_GROUPS" => "Y",
                                    "MENU_CACHE_GET_VARS" => Array()
                                )
                            );?>
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-6">
                            <div class="h4 smt-header smt-header-underline-left"><?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/footer_header3.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?></div>
                            <div class="smt-footer-contact">
                                <?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/footer_address.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?>
                            </div>
                            <div class="h4 smt-header smt-header-underline-left"><?$APPLICATION->IncludeFile(
                                    SITE_DIR."smt_include/footer_header4.php",
                                    Array(),
                                    Array("MODE"=>"html")
                                );?></div>
                            <?$APPLICATION->IncludeFile(
                                SITE_DIR."smt_include/footer_social.php",
                                Array(),
                                Array("MODE"=>"html")
                            );?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="smt-copyright" itemscope itemtype="http://schema.org/WPFooter">
        <?$APPLICATION->IncludeFile(
            SITE_DIR."smt_include/footer_copyright.php",
            Array(),
            Array("MODE"=>"html")
        );?>
        <div id="bx-composite-banner"></div>
    </div>
</footer>
<?if($APPLICATION->GetProperty("smt_show_button_up")):?><div class="smt-go-up-arrow smt-go-up-arrow-js"><span class="fa fa-chevron-up"></span></div><?endif?>
<?$APPLICATION->IncludeFile(
    SITE_DIR."smt_include/forms.php",
    Array(),
    Array("MODE"=>"html", "SHOW_BORDER" => false)
);?>
<?$APPLICATION->ShowViewContent('smt_footer');?>
<?$APPLICATION->IncludeFile(
    SITE_DIR."smt_include/footer_counters.php",
    Array(),
    Array("MODE"=>"html", "SHOW_BORDER" => false)
);?>
</body>
</html>