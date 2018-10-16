<section class="smt-widget smt-widget_no-margin">
    <header>
        <div class="smt-widget__header smt-widget__header_normal"><?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/order_header.php",
                Array(),
                Array("MODE"=>"html")
            );?></div>
    </header>
    <div class="smt-widget__content">
        <div class="smt-form">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/form_order_main.php",
                Array(),
                Array("MODE"=>"html", "SHOW_BORDER" => false)
            );?>
        </div>
    </div>
</section>