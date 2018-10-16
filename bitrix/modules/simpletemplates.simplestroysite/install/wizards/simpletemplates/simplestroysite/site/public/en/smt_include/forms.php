<div class="smt-popup mfp-hide" id="smt-popup-phone">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_callback_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_callback.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>
<div class="smt-popup mfp-hide" id="smt-popup-question">
    <section class="smt-widget smt-widget_no-margin">
        <header>
            <div class="smt-header smt-header-underline-left h4"><?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/form_question_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?></div>
        </header>
        <div class="smt-widget__content">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_question.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER"=>false)
            );?>
        </div>
    </section>
</div>