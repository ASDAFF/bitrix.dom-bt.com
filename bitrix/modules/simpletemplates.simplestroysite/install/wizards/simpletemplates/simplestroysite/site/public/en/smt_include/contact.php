<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
        <section class="smt-widget smt-widget_margin">
            <?$APPLICATION->IncludeFile(
                    SITE_DIR."smt_include/contact_address_header.php",
                    Array(),
                    Array("MODE"=>"html")
                );?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/contact_address_top.php",
                Array(),
                Array("MODE"=>"html")
            );?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/contact_address.php",
                Array(),
                Array("MODE"=>"html")
            );?>
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/contact_address_bottom.php",
                Array(),
                Array("MODE"=>"html")
            );?>
        </section>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-8">
        <section class="smt-widget smt-widget_margin">
            <?$APPLICATION->IncludeFile(
                SITE_DIR."smt_include/contact_form.php",
                Array(),
                Array("MODE"=>"html")
            );?>
        </section>
    </div>
</div>